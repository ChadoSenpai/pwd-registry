@extends('layouts.app')
@section('page_title', 'PWD Registrants')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-2">
        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle" style="width: 32px; height: 32px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>
        <h3 class="mb-0">Registry Directory</h3>
    </div>
    <a href="{{ route('registrants.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <line x1="12" y1="5" x2="12" y2="19"/>
            <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Register New PWD
    </a>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title mb-0">PWD Registrants List</h3>
    </div>
<div class="card-body"><form class="row g-2 mb-4" method="GET"><div class="col-md-5"><input name="search" value="{{ request('search') }}" class="form-control" placeholder="Search name or PWD ID number"></div><div class="col-auto"><button class="btn btn-outline-secondary d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg> Search</button></div></form>
<div class="table-responsive"><table class="table table-hover align-middle"><thead><tr><th>PWD ID</th><th>Registrant</th><th>Disability Type</th><th>Barangay</th><th>Card Status</th><th></th></tr></thead><tbody>@forelse($registrants as $registrant)<tr><td class="fw-semibold">{{ $registrant->pwd_id_number }}</td><td>{{ $registrant->last_name }}, {{ $registrant->first_name }} {{ $registrant->middle_name }}</td><td>{{ $registrant->disabilityType->name }}</td><td>{{ $registrant->barangay->name }}</td><td><span class="badge text-bg-{{ $registrant->card_status === 'active' ? 'success' : 'secondary' }} text-capitalize">{{ $registrant->card_status }}</span></td><td><a href="{{ route('registrants.show', $registrant) }}" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-2"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg> View</a></td></tr>@empty<tr><td colspan="6" class="text-center text-muted py-4">No registrants found. <a href="{{ route('registrants.create') }}" class="text-primary">Create the first record.</a></td></tr>@endforelse</tbody></table></div>{{ $registrants->links() }}</div></div>
@endsection
