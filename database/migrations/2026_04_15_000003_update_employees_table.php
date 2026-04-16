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
        Schema::table('employees', function (Blueprint $table) {
            $table->string('matricule')->unique()->after('id');
            $table->date('date_naissance')->nullable()->after('email');
            $table->dropColumn(['status', 'salary']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('status')->default('Actif')->after('position');
            $table->decimal('salary', 15, 2)->nullable()->after('hired_at');
            $table->dropColumn(['matricule', 'date_naissance']);
        });
    }
};
