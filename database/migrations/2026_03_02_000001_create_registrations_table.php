<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('confirmation_code', 10)->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('license_number');
            $table->string('license_country');
            $table->date('license_expiry');
            $table->string('license_front_photo')->nullable();
            $table->string('license_back_photo')->nullable();
            $table->string('passport_photo')->nullable();
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->date('pickup_date');
            $table->date('return_date');
            $table->enum('vehicle_preference', ['economy', 'compact', 'suv', 'luxury']);
            $table->string('hotel_name');
            $table->string('flight_number')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'expired'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
