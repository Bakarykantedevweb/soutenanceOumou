<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->boolean('stage_remunere')->nullable()->after('type_contrat');
            $table->decimal('salaire_base', 15, 2)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('stage_remunere');
            $table->decimal('salaire_base', 15, 2)->nullable(false)->change();
        });
    }
};
