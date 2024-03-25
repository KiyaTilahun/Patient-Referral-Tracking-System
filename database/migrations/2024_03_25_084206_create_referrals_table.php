<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('referring_hospital_id'); // ID of the referring hospital
            $table->unsignedBigInteger('receiving_hospital_id'); // ID of the receiving hospital
            $table->date('referral_date');
            $table->text('reason'); // Reason for the referral
            $table->text('notes')->nullable(); // Additional notes
            $table->date('appointment');
            $table->string('file_path');
            $table->timestamps();
            //  foreign key constraints
            $table->foreign('referring_hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('receiving_hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreignId('department_id')->constrained();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('doctor_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
