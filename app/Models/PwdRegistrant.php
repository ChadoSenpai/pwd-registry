<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PwdRegistrant extends Model
{
    protected $fillable = ['pwd_id_number', 'first_name', 'middle_name', 'last_name', 'suffix', 'birth_date', 'sex', 'civil_status', 'address_line', 'contact_number', 'email', 'barangay_id', 'disability_type_id', 'disability_cause', 'guardian_name', 'emergency_contact_name', 'emergency_contact_number', 'photo_path', 'card_issued_date', 'card_expiry_date', 'card_status', 'remarks'];

    protected function casts(): array
    {
        return ['birth_date' => 'date', 'card_issued_date' => 'date', 'card_expiry_date' => 'date'];
    }

    public function barangay(): BelongsTo { return $this->belongsTo(Barangay::class); }
    public function disabilityType(): BelongsTo { return $this->belongsTo(DisabilityType::class); }
    public function applications(): HasMany { return $this->hasMany(PwdApplication::class); }

    public function getProvinceAttribute()
    {
        return $this->barangay?->municipality?->province;
    }

    public function getMunicipalityAttribute()
    {
        return $this->barangay?->municipality;
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name} {$this->suffix}");
    }
}
