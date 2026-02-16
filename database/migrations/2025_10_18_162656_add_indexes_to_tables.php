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
        // Adicionar índices para users
        Schema::table('users', function (Blueprint $table) {
            $table->index('celular');
            $table->index('privilegio');
            $table->index('active');
            $table->index('is_premium');
            $table->index(['privilegio', 'active']); // Índice composto
        });

        // Adicionar índices para anuncios
        Schema::table('anuncios', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('categoria_id');
            $table->index('estado_anuncio');
            $table->index('validade');
            $table->index(['estado_anuncio', 'validade']); // Índice composto
            $table->index('created_at'); // Para ordenação
        });

        // Adicionar índices para candidatos
        Schema::table('candidatos', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('provincia_id');
            $table->index('categoria_id');
            $table->index(['provincia_id', 'categoria_id']); // Índice composto
        });

        // Adicionar índices para candidaturas_anuncios
        Schema::table('candidaturas_anuncios', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('anuncio_id');
            $table->unique(['user_id', 'anuncio_id']); // Evita candidaturas duplicadas
            $table->index('created_at');
        });

        // Adicionar índices para experiencias
        if (Schema::hasTable('experiencias')) {
            Schema::table('experiencias', function (Blueprint $table) {
                $table->index('candidato_id');
            });
        }

        // Adicionar índices para idiomas
        if (Schema::hasTable('idiomas')) {
            Schema::table('idiomas', function (Blueprint $table) {
                $table->index('candidato_id');
            });
        }

        // Adicionar índices para documentos
        if (Schema::hasTable('documentos')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->index('candidato_id');
            });
        }

        // Adicionar índices para empregadors
        if (Schema::hasTable('empregadors')) {
            Schema::table('empregadors', function (Blueprint $table) {
                $table->index('user_id');
                $table->index('provincia_id');
            });
        }

        // Adicionar índices para anuncios_provincias
        if (Schema::hasTable('anuncios_provincias')) {
            Schema::table('anuncios_provincias', function (Blueprint $table) {
                $table->index('anuncio_id');
                $table->index('provincia_id');
                $table->index(['anuncio_id', 'provincia_id']); // Índice composto
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
        // Remover índices de users
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['celular']);
            $table->dropIndex(['privilegio']);
            $table->dropIndex(['active']);
            $table->dropIndex(['is_premium']);
            $table->dropIndex(['privilegio', 'active']);
        });

        // Remover índices de anuncios
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['categoria_id']);
            $table->dropIndex(['estado_anuncio']);
            $table->dropIndex(['validade']);
            $table->dropIndex(['estado_anuncio', 'validade']);
            $table->dropIndex(['created_at']);
        });

        // Remover índices de candidatos
        Schema::table('candidatos', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['provincia_id']);
            $table->dropIndex(['categoria_id']);
            $table->dropIndex(['provincia_id', 'categoria_id']);
        });

        // Remover índices de candidaturas_anuncios
        Schema::table('candidaturas_anuncios', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['anuncio_id']);
            $table->dropUnique(['user_id', 'anuncio_id']);
            $table->dropIndex(['created_at']);
        });

        // Remover índices das outras tabelas se existirem
        if (Schema::hasTable('experiencias')) {
            Schema::table('experiencias', function (Blueprint $table) {
                $table->dropIndex(['candidato_id']);
            });
        }

        if (Schema::hasTable('idiomas')) {
            Schema::table('idiomas', function (Blueprint $table) {
                $table->dropIndex(['candidato_id']);
            });
        }

        if (Schema::hasTable('documentos')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->dropIndex(['candidato_id']);
            });
        }

        if (Schema::hasTable('empregadors')) {
            Schema::table('empregadors', function (Blueprint $table) {
                $table->dropIndex(['user_id']);
                $table->dropIndex(['provincia_id']);
            });
        }

        if (Schema::hasTable('anuncios_provincias')) {
            Schema::table('anuncios_provincias', function (Blueprint $table) {
                $table->dropIndex(['anuncio_id']);
                $table->dropIndex(['provincia_id']);
                $table->dropIndex(['anuncio_id', 'provincia_id']);
            });
        }
    }
};
