<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('empregadors', 'nuit')) {
            Schema::table('empregadors', function (Blueprint $table) {
                $table->string('nuit', 50)->nullable()->after('empresa');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('empregadors', 'nuit')) {
            Schema::table('empregadors', function (Blueprint $table) {
                $table->dropColumn('nuit');
            });
        }
    }
};

