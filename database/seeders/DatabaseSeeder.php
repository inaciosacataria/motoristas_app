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
        $this->command->info('📝 Passo 1/5: Criando usuários de teste...');
        $this->call(TestUsersSeeder::class);
        $this->command->info('');

        // 2. Criar províncias e categorias (se não existirem)
        $this->command->info('📝 Passo 2/5: Províncias e categorias...');
        $this->call(ProvinciasCategoriasSeeder::class);
        $this->command->info('');

        // 3. Criar vagas de exemplo
        $this->command->info('📝 Passo 3/5: Criando vagas de exemplo...');
        $this->call(AnunciosSeeder::class);
        $this->command->info('');

        // 4. Criar candidatos adicionais e candidaturas
        $this->command->info('📝 Passo 4/5: Criando candidatos e candidaturas...');
        $this->call(CandidaturasSeeder::class);
        $this->command->info('');

        // 5. Criar banners de publicidade (página empregador)
        $this->command->info('📝 Passo 5/5: Banners de publicidade...');
        $this->call(SmartAdsSeeder::class);
        $this->command->info('');

        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('✅ TODOS OS SEEDERS EXECUTADOS COM SUCESSO!');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('');
        $this->command->info('📋 Resumo:');
        $this->command->info('   ✅ Usuários (Admin, Empregador, Candidatos)');
        $this->command->info('   ✅ Províncias e categorias');
        $this->command->info('   ✅ Vagas de exemplo');
        $this->command->info('   ✅ Candidaturas');
        $this->command->info('   ✅ Banners de publicidade');
        $this->command->info('');
        $this->command->info('🔗 Acesse: http://127.0.0.1:8000');
        $this->command->info('   Admin: admin@motoristas.co.mz / admin123');
        $this->command->info('   Empregador: empresa@teste.com / password123');
        $this->command->info('');
    }
}
