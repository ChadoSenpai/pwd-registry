<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DisabilityType extends Model
{
    protected $fillable = ['code', 'name', 'description', 'is_active'];

    public function registrants(): HasMany
    {
        return $this->hasMany(PwdRegistrant::class);
    }
}
