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
        Schema::create('appointmentslots', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('availability', ['available', 'booked'])->default('available');
            $table->timestamps();
            $table->foreignId('department_id')->constrained();
            $table->foreignId('hospital_id')->constrained();
            $table->integer('slotalotted')->default(0);
            $table->integer('slotused')->default(0);
            $table->unique(['department_id', 'hospital_id','date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointmentslots');
    }
};
