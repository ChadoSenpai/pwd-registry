<?php

namespace Tests\Feature;

use App\Models\Barangay;
use App\Models\DisabilityType;
use App\Models\PwdApplication;
use App\Models\PwdRegistrant;
use App\Models\User;
use Database\Seeders\PwdRegistrySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApplicationsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_seeded_registrants_each_create_an_application(): void
    {
        $this->artisan('db:seed', ['--class' => PwdRegistrySeeder::class]);

        $this->assertCount(3, PwdApplication::all());
    }

    public function test_applications_page_lists_all_registrants(): void
    {
        $user = User::factory()->create();
        $barangay = Barangay::create(['code' => 'B001', 'name' => 'Barangay 1']);
        $disabilityType = DisabilityType::create(['code' => 'D001', 'name' => 'Visual Impairment']);

        $registrantOne = PwdRegistrant::create([
            'pwd_id_number' => 'PWD-001',
            'first_name' => 'Maria',
            'last_name' => 'Dela Cruz',
            'birth_date' => now()->subYears(30)->toDateString(),
            'sex' => 'female',
            'address_line' => 'Sample address 1',
            'barangay_id' => $barangay->id,
            'disability_type_id' => $disabilityType->id,
        ]);

        $registrantTwo = PwdRegistrant::create([
            'pwd_id_number' => 'PWD-002',
            'first_name' => 'Jose',
            'last_name' => 'Ramos',
            'birth_date' => now()->subYears(45)->toDateString(),
            'sex' => 'male',
            'address_line' => 'Sample address 2',
            'barangay_id' => $barangay->id,
            'disability_type_id' => $disabilityType->id,
        ]);

        $this->actingAs($user)
            ->get('/applications')
            ->assertOk()
            ->assertSee('All Registrants')
            ->assertSee($registrantOne->first_name)
            ->assertSee($registrantTwo->first_name);
    }

    public function test_archived_application_can_be_restored(): void
    {
        $user = User::factory()->create();
        $barangay = Barangay::create(['code' => 'B002', 'name' => 'Barangay 2']);
        $disabilityType = DisabilityType::create(['code' => 'D002', 'name' => 'Hearing Impairment']);

        $registrant = PwdRegistrant::create([
            'pwd_id_number' => 'PWD-003',
            'first_name' => 'Ana',
            'last_name' => 'Lopez',
            'birth_date' => now()->subYears(28)->toDateString(),
            'sex' => 'female',
            'address_line' => 'Sample address 3',
            'barangay_id' => $barangay->id,
            'disability_type_id' => $disabilityType->id,
        ]);

        $application = PwdApplication::create([
            'pwd_registrant_id' => $registrant->id,
            'application_number' => 'APP-003',
            'type' => 'renewal',
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        $application->delete();

        $this->withSession(['_token' => 'test-token'])
            ->actingAs($user)
            ->post("/applications/{$application->id}/restore", ['_token' => 'test-token'])
            ->assertRedirect(route('applications.archive'));

        $restored = PwdApplication::withTrashed()->find($application->id);

        $this->assertNotNull($restored);
        $this->assertFalse($restored->trashed());
    }

    public function test_google_authenticator_page_renders_a_qr_code(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/settings/google-authenticator')
            ->assertOk()
            ->assertSee('api.qrserver.com/v1/create-qr-code', false)
            ->assertSee('Manual setup code');
    }

    public function test_user_can_change_their_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword123!'),
        ]);

        $this->withSession(['_token' => 'test-token'])
            ->actingAs($user)
            ->post('/settings/password', [
                '_token' => 'test-token',
                'current_password' => 'OldPassword123!',
                'password' => 'NewPassword123!',
                'password_confirmation' => 'NewPassword123!',
            ])
            ->assertRedirect(route('settings.password'));

        $this->assertTrue(Hash::check('NewPassword123!', $user->fresh()->password));
    }
}
