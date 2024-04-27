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
            $table->string('card_number'); 
            $table->date('referral_date');
            $table->unsignedBigInteger('referring_hospital_id'); // ID of the referring hospital
            $table->unsignedBigInteger('receiving_hospital_id'); // ID of the receiving hospital
            $table->foreignId('referrtype_id')->nullable()->constrained()->cascadeOnUpdate();
            $table->foreignId('doctor_id')->nullable()->constrained();
            $table->foreignId('department_id')->nullable()->constrained();
            $table->foreignId('statustype_id')->default(1)->constrained();

            $table->text('history'); // Reason for the referral
            $table->text('findings'); // Additional notes
            $table->text('treatment'); // Additional notes
            $table->text('reason'); // Additional notes
            $table->string('file_path')->nullable();
            $table->foreign('referring_hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('receiving_hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
            $table->foreign('card_number')->references('card_number')->on('patients')->onDelete('cascade');
            $table->timestamps();

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
