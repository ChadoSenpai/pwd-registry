@extends('layouts.app')
@section('page_title', 'Register New PWD')
@section('content')
<form method="POST" action="{{ route('registrants.store') }}">@csrf
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.querySelector('select[name="province_id"]');
    const municipalitySelect = document.querySelector('select[name="municipality_id"]');
    const barangaySelect = document.querySelector('select[name="barangay_id"]');
    
    // Store original options
    const originalMunicipalities = Array.from(municipalitySelect.options).filter(opt => opt.value !== '');
    const originalBarangays = Array.from(barangaySelect.options).filter(opt => opt.value !== '');
    
    // Province change handler
    provinceSelect.addEventListener('change', function() {
        const provinceId = this.value;
        
        // Reset municipality and barangay
        municipalitySelect.value = '';
        barangaySelect.value = '';
        
        // Filter municipalities by province
        municipalitySelect.innerHTML = '<option value="">Select municipality</option>';
        originalMunicipalities.forEach(option => {
            const municipalityData = JSON.parse(option.dataset.municipality || '{}');
            if (!provinceId || municipalityData.province_id == provinceId) {
                municipalitySelect.appendChild(option.cloneNode(true));
            }
        });
        
        // Reset barangay options
        barangaySelect.innerHTML = '<option value="">Select barangay</option>';
        originalBarangays.forEach(option => barangaySelect.appendChild(option.cloneNode(true)));
    });
    
    // Municipality change handler
    municipalitySelect.addEventListener('change', function() {
        const municipalityId = this.value;
        
        // Reset barangay
        barangaySelect.value = '';
        
        // Filter barangays by municipality
        barangaySelect.innerHTML = '<option value="">Select barangay</option>';
        originalBarangays.forEach(option => {
            const barangayData = JSON.parse(option.dataset.barangay || '{}');
            if (!municipalityId || barangayData.municipality_id == municipalityId) {
                barangaySelect.appendChild(option.cloneNode(true));
            }
        });
    });
});
</script>
@endpush
<div class="card"><div class="card-header"><h3 class="card-title">Personal Information</h3></div><div class="card-body"><div class="row g-3">
@foreach(['pwd_id_number' => 'PWD ID Number', 'first_name' => 'First Name', 'middle_name' => 'Middle Name', 'last_name' => 'Last Name', 'suffix' => 'Suffix'] as $field => $label)<div class="col-md-{{ $field === 'pwd_id_number' ? '4' : '2' }}"><label class="form-label">{{ $label }}@if(in_array($field, ['pwd_id_number','first_name','last_name'])) * @endif</label><input name="{{ $field }}" value="{{ old($field) }}" class="form-control @error($field) is-invalid @enderror" placeholder="Enter {{ strtolower($label) }}" @if(in_array($field, ['pwd_id_number','first_name','last_name'])) required @endif>@error($field)<div class="invalid-feedback">{{ $message }}</div>@enderror</div>@endforeach
<div class="col-md-3"><label class="form-label">Birth Date *</label><input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control" required></div><div class="col-md-3"><label class="form-label">Sex *</label><select name="sex" class="form-select" required><option value="">Select sex</option><option value="male">Male</option><option value="female">Female</option><option value="prefer_not_to_say">Prefer not to say</option></select></div><div class="col-md-3"><label class="form-label">Civil Status</label><input name="civil_status" value="{{ old('civil_status') }}" class="form-control" placeholder="Enter civil status"></div><div class="col-md-3"><label class="form-label">Contact Number</label><input name="contact_number" value="{{ old('contact_number') }}" class="form-control" placeholder="Enter contact number"></div><div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email address"></div><div class="col-md-6"></div>
<div class="col-md-4"><label class="form-label">Province *</label><select name="province_id" class="form-select" required><option value="">Select province</option>@foreach($provinces as $province)<option value="{{ $province->id }}" @selected(old('province_id') == $province->id)>{{ $province->name }}</option>@endforeach</select></div><div class="col-md-4"><label class="form-label">Municipality *</label><select name="municipality_id" class="form-select" required><option value="">Select municipality</option>@foreach($municipalities as $municipality)<option value="{{ $municipality->id }}" data-municipality='{"province_id":"{{ $municipality->province_id }}"}' @selected(old('municipality_id') == $municipality->id)>{{ $municipality->name }}</option>@endforeach</select></div><div class="col-md-4"><label class="form-label">Barangay *</label><select name="barangay_id" class="form-select" required><option value="">Select barangay</option>@foreach($barangays as $barangay)<option value="{{ $barangay->id }}" data-barangay='{"municipality_id":"{{ $barangay->municipality_id }}"}' @selected(old('barangay_id') == $barangay->id)>{{ $barangay->name }}</option>@endforeach</select></div>
<div class="col-12"><label class="form-label">Address *</label><textarea name="address_line" class="form-control" rows="2" required placeholder="Enter complete address">{{ old('address_line') }}</textarea></div>
</div></div></div>
<div class="card"><div class="card-header"><h3 class="card-title">Disability and Card Details</h3></div><div class="card-body"><div class="row g-3"><div class="col-md-4"><label class="form-label">Disability Type *</label><select name="disability_type_id" class="form-select" required><option value="">Select disability type</option>@foreach($disabilityTypes as $type)<option value="{{ $type->id }}">{{ $type->name }}</option>@endforeach</select></div><div class="col-md-4"><label class="form-label">Cause of Disability</label><input name="disability_cause" class="form-control" placeholder="Enter cause if known"></div><div class="col-md-4"><label class="form-label">Guardian Name</label><input name="guardian_name" class="form-control" placeholder="Enter guardian name"></div><div class="col-md-4"><label class="form-label">Card Issued Date</label><input type="date" name="card_issued_date" class="form-control"></div><div class="col-md-4"><label class="form-label">Card Expiry Date</label><input type="date" name="card_expiry_date" class="form-control"></div><div class="col-md-4"><label class="form-label">Emergency Contact</label><input name="emergency_contact_name" class="form-control" placeholder="Enter contact name"></div><div class="col-md-4"><label class="form-label">Emergency Number</label><input name="emergency_contact_number" class="form-control" placeholder="Enter contact number"></div><div class="col-12"><label class="form-label">Remarks</label><textarea name="remarks" class="form-control" rows="2" placeholder="Enter any additional remarks"></textarea></div></div></div><div class="card-footer text-end"><a href="{{ route('registrants.index') }}" class="btn btn-light">Cancel</a><button class="btn btn-primary">Save Registrant</button></div></div>
</form>
@endsection
