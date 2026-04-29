<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::dropIfExists('attendances');
        
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('date'); // La date du jour
            $table->time('check_in')->nullable(); // Heure arrivée
            $table->time('check_out')->nullable(); // Heure départ
            $table->string('status')->default('Present'); // Present, Late, Absent
            $table->text('note')->nullable();
            $table->timestamps();
            
            // Un employé ne peut avoir qu'une ligne par jour
            $table->unique(['employee_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
