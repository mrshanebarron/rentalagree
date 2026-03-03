<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('agreement_number', 20)->unique();
            $table->date('pickup_date');
            $table->date('return_date');
            $table->decimal('daily_rate', 8, 2);
            $table->decimal('total_cost', 10, 2);
            $table->decimal('deposit_amount', 8, 2)->default(0);
            $table->enum('insurance_option', ['basic', 'premium', 'none'])->default('basic');
            $table->decimal('insurance_cost', 8, 2)->default(0);
            $table->unsignedTinyInteger('current_step')->default(1);
            $table->boolean('section_1_confirmed')->default(false);
            $table->boolean('section_2_confirmed')->default(false);
            $table->boolean('section_3_confirmed')->default(false);
            $table->boolean('section_4_confirmed')->default(false);
            $table->boolean('section_5_confirmed')->default(false);
            $table->boolean('section_6_confirmed')->default(false);
            $table->boolean('section_7_confirmed')->default(false);
            $table->string('section_3_initials')->nullable();
            $table->string('section_4_initials')->nullable();
            $table->string('section_5_initials')->nullable();
            $table->string('section_6_initials')->nullable();
            $table->string('section_7_initials')->nullable();
            $table->json('additional_drivers')->nullable();
            $table->boolean('sole_driver')->default(false);
            $table->longText('signature')->nullable();
            $table->timestamp('signed_at')->nullable();
            $table->enum('status', ['draft', 'in_progress', 'signed', 'expired'])->default('draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
