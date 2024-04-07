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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('gender')->unsigned();
            $table->date('dob');
            $table->string('card_number');
            // $table->string('treatment');
            // $table->text('medical_history')->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->timestamps();
            $table->foreignId('hospital_id')->constrained();
            // $table->foreignId('doctor_id')->constrained();
            $table->unique(['card_number', 'hospital_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
