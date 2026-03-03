<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'confirmation_code',
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'license_number',
        'license_country',
        'license_expiry',
        'license_front_photo',
        'license_back_photo',
        'passport_photo',
        'emergency_contact_name',
        'emergency_contact_phone',
        'pickup_date',
        'return_date',
        'vehicle_preference',
        'hotel_name',
        'flight_number',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'license_expiry' => 'date',
            'pickup_date' => 'date',
            'return_date' => 'date',
        ];
    }

    public static function generateConfirmationCode(): string
    {
        do {
            $code = 'CUR-' . strtoupper(Str::random(4));
        } while (static::where('confirmation_code', $code)->exists());

        return $code;
    }

    public function agreements(): HasMany
    {
        return $this->hasMany(Agreement::class);
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match ($this->status) {
            'pending' => 'yellow',
            'in_progress' => 'blue',
            'completed' => 'green',
            'expired' => 'red',
            default => 'gray',
        };
    }

    public function getRentalDaysAttribute(): int
    {
        return $this->pickup_date->diffInDays($this->return_date);
    }
}
