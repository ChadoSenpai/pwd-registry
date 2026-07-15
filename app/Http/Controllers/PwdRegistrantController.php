<?php

namespace App\Http\Controllers;

use App\Models\Barangay;
use App\Models\DisabilityType;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\PwdRegistrant;
use App\Models\PwdApplication;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PwdRegistrantController extends Controller
{
    public function index(Request $request): View
    {
        $registrants = PwdRegistrant::with(['barangay', 'disabilityType'])
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search');
                $query->where(fn ($q) => $q->where('pwd_id_number', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%"));
            })->latest()->paginate(10)->withQueryString();

        return view('registrants.index', compact('registrants'));
    }

    public function create(): View
    {
        return view('registrants.create', [
            'provinces' => Province::orderBy('name')->get(),
            'municipalities' => Municipality::orderBy('name')->get(),
            'barangays' => Barangay::orderBy('name')->get(),
            'disabilityTypes' => DisabilityType::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function createPublic(): View
    {
        return view('public-registration', [
            'provinces' => Province::orderBy('name')->get(),
            'municipalities' => Municipality::orderBy('name')->get(),
            'barangays' => Barangay::orderBy('name')->get(),
            'disabilityTypes' => DisabilityType::where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function storePublic(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'], 'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'], 'birth_date' => ['required', 'date', 'before:today'],
            'sex' => ['required', 'in:male,female,prefer_not_to_say'], 'address_line' => ['required', 'string'],
            'contact_number' => ['nullable', 'string', 'max:30'], 'email' => ['nullable', 'email', 'max:255'],
            'barangay_id' => ['required', 'exists:barangays,id'], 'disability_type_id' => ['required', 'exists:disability_types,id'],
            'disability_cause' => ['nullable', 'string', 'max:255'], 'guardian_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'], 'emergency_contact_number' => ['nullable', 'string', 'max:30'],
        ]);

        $registrant = PwdRegistrant::create(array_merge($data, [
            'pwd_id_number' => 'PENDING-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
            'remarks' => 'Submitted through the public registration form.',
        ]));

        PwdApplication::create([
            'pwd_registrant_id' => $registrant->id,
            'application_number' => 'APP-'.now()->format('Y').'-'.str_pad((string) (PwdApplication::withTrashed()->count() + 1), 5, '0', STR_PAD_LEFT),
            'type' => 'new', 'submitted_at' => now(), 'status' => 'pending',
            'notes' => 'Public PWD registration submission.',
        ]);

        return to_route('public.registration.create')->with('success', 'Your registration has been submitted. The PWD affairs office will review your details.');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'pwd_id_number' => ['required', 'string', 'max:40', 'unique:pwd_registrants'],
            'first_name' => ['required', 'string', 'max:255'], 'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'], 'suffix' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['required', 'date', 'before:today'], 'sex' => ['required', 'in:male,female,prefer_not_to_say'],
            'civil_status' => ['nullable', 'string', 'max:50'], 'address_line' => ['required', 'string'],
            'contact_number' => ['nullable', 'string', 'max:30'], 'email' => ['nullable', 'email', 'max:255'],
            'barangay_id' => ['required', 'exists:barangays,id'], 'disability_type_id' => ['required', 'exists:disability_types,id'],
            'disability_cause' => ['nullable', 'string', 'max:255'], 'guardian_name' => ['nullable', 'string', 'max:255'],
            'emergency_contact_name' => ['nullable', 'string', 'max:255'], 'emergency_contact_number' => ['nullable', 'string', 'max:30'],
            'card_issued_date' => ['nullable', 'date'], 'card_expiry_date' => ['nullable', 'date', 'after_or_equal:card_issued_date'],
            'remarks' => ['nullable', 'string'],
        ]);

        $registrant = PwdRegistrant::create($data);

        return to_route('registrants.show', $registrant)->with('success', 'PWD registrant saved successfully.');
    }

    public function show(PwdRegistrant $registrant): View
    {
        return view('registrants.show', ['registrant' => $registrant->load(['barangay', 'disabilityType', 'applications'])]);
    }
}
