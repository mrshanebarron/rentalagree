<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->year('year');
            $table->string('license_plate')->unique();
            $table->string('color');
            $table->string('vin')->nullable();
            $table->enum('category', ['economy', 'compact', 'suv', 'luxury']);
            $table->decimal('daily_rate', 8, 2);
            $table->enum('status', ['available', 'rented', 'maintenance'])->default('available');
            $table->unsignedInteger('current_mileage')->default(0);
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
