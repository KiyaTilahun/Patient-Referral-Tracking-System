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
        Schema::create('day_department', function (Blueprint $table) {
            $table->id();
            $table->foreignId('day_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('department_hospital_id')->constrained('department_hospital')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('hospital_id')->constrained('hospitals');
            // Additional columns if needed
            $table->timestamps();
            
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_department');
    }
};
