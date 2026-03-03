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
        // Ajustar tabela experiencias para alinhar com o formulário actual:
        // permitir que inicio, trabalha_ate_agora e tipo_de_contrato sejam opcionais
        DB::statement('ALTER TABLE experiencias MODIFY inicio DATE NULL');
        DB::statement('ALTER TABLE experiencias MODIFY trabalha_ate_agora VARCHAR(255) NULL');
        DB::statement('ALTER TABLE experiencias MODIFY tipo_de_contrato VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE experiencias MODIFY inicio DATE NOT NULL');
        DB::statement('ALTER TABLE experiencias MODIFY trabalha_ate_agora VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE experiencias MODIFY tipo_de_contrato VARCHAR(255) NOT NULL');
    }
};

