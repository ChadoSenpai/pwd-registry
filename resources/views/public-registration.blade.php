<!doctype html>
<html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>PWD Registration | PWD Registry</title>@vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body data-bs-theme="light" class="bg-body-tertiary"><header class="bg-white border-bottom shadow-sm sticky-top"><div class="container py-3"><div class="d-flex align-items-center justify-content-between"><a href="{{ route('home') }}" class="text-decoration-none text-dark fw-semibold fs-5 d-flex align-items-center"><span class="brand-mark text-white d-flex align-items-center justify-content-center">PR</span><span class="ms-2">PWD Registry</span></a><a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">Back to Home</a></div></div></header><main class="container py-5"><div class="row justify-content-center"><div class="col-lg-9"><div class="mb-4"><h1 class="h2 fw-bold">PWD Registration</h1><p class="text-muted mb-0">Complete this form to submit your registration to the PWD affairs office for review.</p></div>@if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.querySelector('select[name="province_id"]');
    const municipalitySelect = document.querySelector('select[name="municipality_id"]');
    const barangaySelect = document.querySelector('select[name="barangay_id"]');
    
    if (provinceSelect && municipalitySelect && barangaySelect) {
        const originalMunicipalities = Array.from(municipalitySelect.options).filter(opt => opt.value !== '');
        const originalBarangays = Array.from(barangaySelect.options).filter(opt => opt.value !== '');
        
        provinceSelect.addEventListener('change', function() {
            const provinceId = this.value;
            municipalitySelect.value = '';
            barangaySelect.value = '';
            municipalitySelect.innerHTML = '<option value="">Select municipality</option>';
            originalMunicipalities.forEach(option => {
                const municipalityData = JSON.parse(option.dataset.municipality || '{}');
                if (!provinceId || municipalityData.province_id == provinceId) {
                    municipalitySelect.appendChild(option.cloneNode(true));
                }
            });
            barangaySelect.innerHTML = '<option value="">Select barangay</option>';
            originalBarangays.forEach(option => barangaySelect.appendChild(option.cloneNode(true)));
        });
        
        municipalitySelect.addEventListener('change', function() {
            const municipalityId = this.value;
            barangaySelect.value = '';
            barangaySelect.innerHTML = '<option value="">Select barangay</option>';
            originalBarangays.forEach(option => {
                const barangayData = JSON.parse(option.dataset.barangay || '{}');
                if (!municipalityId || barangayData.municipality_id == municipalityId) {
                    barangaySelect.appendChild(option.cloneNode(true));
                }
            });
        });
    }
});
</script>
<form method="POST" action="{{ route('public.registration.store') }}">@csrf<div class="card shadow-sm border-0 mb-4"><div class="card-header bg-white"><h2 class="h5 mb-0">Personal Information</h2></div><div class="card-body"><div class="row g-3"><div class="col-md-4"><label class="form-label">First Name *</label><input name="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" placeholder="Enter first name" required>@error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div><div class="col-md-4"><label class="form-label">Middle Name</label><input name="middle_name" value="{{ old('middle_name') }}" class="form-control" placeholder="Enter middle name"></div><div class="col-md-4"><label class="form-label">Last Name *</label><input name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Enter last name" required></div><div class="col-md-4"><label class="form-label">Birth Date *</label><input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control" required></div><div class="col-md-4"><label class="form-label">Sex *</label><select name="sex" class="form-select" required><option value="">Select sex</option><option value="male">Male</option><option value="female">Female</option><option value="prefer_not_to_say">Prefer not to say</option></select></div><div class="col-md-4"><label class="form-label">Contact Number</label><input name="contact_number" value="{{ old('contact_number') }}" class="form-control" placeholder="Enter contact number"></div><div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter email address"></div><div class="col-md-4"><label class="form-label">Province *</label><select name="province_id" class="form-select" required><option value="">Select province</option>@foreach($provinces as $province)<option value="{{ $province->id }}" @selected(old('province_id') == $province->id)>{{ $province->name }}</option>@endforeach</select></div><div class="col-md-4"><label class="form-label">Municipality *</label><select name="municipality_id" class="form-select" required><option value="">Select municipality</option>@foreach($municipalities as $municipality)<option value="{{ $municipality->id }}" data-municipality='{"province_id":"{{ $municipality->province_id }}"}' @selected(old('municipality_id') == $municipality->id)>{{ $municipality->name }}</option>@endforeach</select></div><div class="col-md-4"><label class="form-label">Barangay *</label><select name="barangay_id" class="form-select" required><option value="">Select barangay</option>@foreach($barangays as $barangay)<option value="{{ $barangay->id }}" data-barangay='{"municipality_id":"{{ $barangay->municipality_id }}"}' @selected(old('barangay_id') == $barangay->id)>{{ $barangay->name }}</option>@endforeach</select></div><div class="col-12"><label class="form-label">Home Address *</label><textarea name="address_line" class="form-control" rows="2" required placeholder="Enter complete home address">{{ old('address_line') }}</textarea></div></div></div></div>
<div class="card shadow-sm border-0"><div class="card-header bg-white"><h2 class="h5 mb-0">Disability and Emergency Contact</h2></div><div class="card-body"><div class="row g-3"><div class="col-md-6"><label class="form-label">Disability Type *</label><select name="disability_type_id" class="form-select" required><option value="">Select disability type</option>@foreach($disabilityTypes as $type)<option value="{{ $type->id }}">{{ $type->name }}</option>@endforeach</select></div><div class="col-md-6"><label class="form-label">Cause of Disability</label><input name="disability_cause" class="form-control" placeholder="Enter cause if known"></div><div class="col-md-6"><label class="form-label">Guardian Name</label><input name="guardian_name" class="form-control" placeholder="Enter guardian name"></div><div class="col-md-6"><label class="form-label">Emergency Contact Name</label><input name="emergency_contact_name" class="form-control" placeholder="Enter emergency contact name"></div><div class="col-md-6"><label class="form-label">Emergency Contact Number</label><input name="emergency_contact_number" class="form-control" placeholder="Enter emergency contact number"></div></div></div><div class="card-footer bg-white text-end"><a href="{{ route('home') }}" class="btn btn-light">Cancel</a><button class="btn btn-primary">Submit Registration</button></div></div></form></div></div></main></body></html>
