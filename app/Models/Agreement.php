<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agreement extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'vehicle_id',
        'user_id',
        'agreement_number',
        'pickup_date',
        'return_date',
        'daily_rate',
        'total_cost',
        'deposit_amount',
        'insurance_option',
        'insurance_cost',
        'current_step',
        'section_1_confirmed',
        'section_2_confirmed',
        'section_3_confirmed',
        'section_4_confirmed',
        'section_5_confirmed',
        'section_6_confirmed',
        'section_7_confirmed',
        'section_3_initials',
        'section_4_initials',
        'section_5_initials',
        'section_6_initials',
        'section_7_initials',
        'additional_drivers',
        'sole_driver',
        'signature',
        'signed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'pickup_date' => 'date',
            'return_date' => 'date',
            'daily_rate' => 'decimal:2',
            'total_cost' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
            'insurance_cost' => 'decimal:2',
            'current_step' => 'integer',
            'section_1_confirmed' => 'boolean',
            'section_2_confirmed' => 'boolean',
            'section_3_confirmed' => 'boolean',
            'section_4_confirmed' => 'boolean',
            'section_5_confirmed' => 'boolean',
            'section_6_confirmed' => 'boolean',
            'section_7_confirmed' => 'boolean',
            'additional_drivers' => 'array',
            'sole_driver' => 'boolean',
            'signed_at' => 'datetime',
        ];
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function damageRecords(): HasMany
    {
        return $this->hasMany(DamageRecord::class);
    }

    public static function generateAgreementNumber(): string
    {
        $year = date('Y');
        $lastAgreement = static::where('agreement_number', 'like', "AGR-{$year}-%")
            ->orderByDesc('agreement_number')
            ->first();

        if ($lastAgreement) {
            $lastNumber = (int) substr($lastAgreement->agreement_number, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        return sprintf('AGR-%s-%04d', $year, $nextNumber);
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'draft' => 'gray',
            'in_progress' => 'blue',
            'signed' => 'green',
            'expired' => 'red',
            default => 'gray',
        };
    }

    public function getRentalDaysAttribute(): int
    {
        return $this->pickup_date->diffInDays($this->return_date);
    }

    public function getCompletedSectionsAttribute(): int
    {
        $count = 0;
        for ($i = 1; $i <= 7; $i++) {
            if ($this->{"section_{$i}_confirmed"}) {
                $count++;
            }
        }
        if ($this->signature) {
            $count++;
        }
        return $count;
    }

    public function isSigned(): bool
    {
        return $this->status === 'signed' && $this->signature !== null;
    }
}
