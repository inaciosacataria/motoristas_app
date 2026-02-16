<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('🚀 INICIANDO SEEDERS DO SISTEMA');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('');

        // 1. Criar usuários de teste (admin, empregador, candidato)
        $this->command->info('📝 Passo 1/4: Criando usuários de teste...');
        $this->call(TestUsersSeeder::class);
        $this->command->info('');

        // 2. Criar vagas de exemplo
        $this->command->info('📝 Passo 2/4: Criando vagas de exemplo...');
        $this->call(AnunciosSeeder::class);
        $this->command->info('');

        // 3. Criar candidatos adicionais e candidaturas
        $this->command->info('📝 Passo 3/4: Criando candidatos e candidaturas...');
        $this->call(CandidaturasSeeder::class);
        $this->command->info('');

        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('✅ TODOS OS SEEDERS EXECUTADOS COM SUCESSO!');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('');
        $this->command->info('📋 Resumo:');
        $this->command->info('   ✅ Usuários criados (Admin, Empregador, Candidatos)');
        $this->command->info('   ✅ Vagas criadas');
        $this->command->info('   ✅ Candidaturas criadas');
        $this->command->info('');
        $this->command->info('🔗 Acesse o sistema em: http://127.0.0.1:8000');
        $this->command->info('');
    }
}
