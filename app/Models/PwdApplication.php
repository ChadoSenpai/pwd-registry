<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PwdApplication extends Model
{
    use SoftDeletes;

    protected $fillable = ['pwd_registrant_id', 'application_number', 'type', 'submitted_at', 'reviewed_at', 'approved_at', 'status', 'reviewed_by', 'notes'];

    protected function casts(): array
    {
        return ['submitted_at' => 'datetime', 'reviewed_at' => 'datetime', 'approved_at' => 'datetime'];
    }

    public function registrant(): BelongsTo { return $this->belongsTo(PwdRegistrant::class, 'pwd_registrant_id'); }
    public function reviewer(): BelongsTo { return $this->belongsTo(User::class, 'reviewed_by'); }
}
