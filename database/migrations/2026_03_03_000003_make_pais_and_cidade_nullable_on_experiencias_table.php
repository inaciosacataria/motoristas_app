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
        // Tornar pais e cidade opcionais para evitar erros quando o formulário não envia esses campos
        DB::statement('ALTER TABLE experiencias MODIFY pais VARCHAR(255) NULL');
        DB::statement('ALTER TABLE experiencias MODIFY cidade VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE experiencias MODIFY pais VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE experiencias MODIFY cidade VARCHAR(255) NOT NULL');
    }
};

