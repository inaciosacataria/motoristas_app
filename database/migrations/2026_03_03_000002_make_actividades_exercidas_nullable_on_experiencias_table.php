<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tornar actividades_exercidas opcional sem depender do Doctrine DBAL
        DB::statement('ALTER TABLE experiencias MODIFY actividades_exercidas TEXT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE experiencias MODIFY actividades_exercidas TEXT NOT NULL');
    }
};

