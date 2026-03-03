<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar usuário ADMIN
        $adminUser = DB::table('users')->where('email', 'admin@motoristas.co.mz')->first();
        
        if (!$adminUser) {
            DB::table('users')->insert([
                'name' => 'Administrador Sistema',
                'email' => 'admin@motoristas.co.mz',
                'celular' => '840000001',
                'password' => Hash::make('admin123'),
                'privilegio' => 'admin',
                'active' => 'Activo',
                'is_premium' => 'yes',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('✅ Usuário ADMIN criado!');
        } else {
            $this->command->info('ℹ️  Usuário ADMIN já existe.');
        }

        // Criar usuário EMPREGADOR
        $empregadorUser = DB::table('users')->where('email', 'empresa@teste.com')->first();
        
        if (!$empregadorUser) {
            $userId = DB::table('users')->insertGetId([
                'name' => 'Empresa de Transportes Teste',
                'email' => 'empresa@teste.com',
                'celular' => '840000000',
                'password' => Hash::make('password123'),
                'privilegio' => 'empregador',
                'active' => 'Activo',
                'is_premium' => 'no',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('empregadors')->insert([
                'user_id' => $userId,
                'empresa' => 'Transportes Moçambique Lda',
                'documento_nuit' => '400123456',
                'sector_actividade' => 'transporte',
                'representante' => 'João Silva',
                'telefone' => '840000000',
                'telefone_alt' => '841111111',
                'website' => 'https://transportes.co.mz',
                'endereco' => 'Av. Julius Nyerere, 1234',
                'provincia_id' => 1, // Maputo
                'sobre' => 'Empresa líder em transportes e logística em Moçambique',
                'estado' => 'activo',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('✅ Usuário EMPREGADOR criado!');
        } else {
            $this->command->info('ℹ️  Usuário EMPREGADOR já existe.');
        }

        // Criar usuário CANDIDATO e perfil em candidatos (necessário para /meu-cv)
        $candidatoUser = DB::table('users')->where('email', '840000002@motoristas.co.mz')->first();
        $candidatoUserId = null;

        if (!$candidatoUser) {
            $candidatoUserId = DB::table('users')->insertGetId([
                'name' => 'João Motorista Teste',
                'email' => '840000002@motoristas.co.mz',
                'celular' => '840000002',
                'password' => Hash::make('candidato123'),
                'privilegio' => 'candidato',
                'active' => 'Activo',
                'is_premium' => 'no',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('✅ Usuário CANDIDATO criado!');
        } else {
            $candidatoUserId = $candidatoUser->id;
            $this->command->info('ℹ️  Usuário CANDIDATO já existe.');
        }

        // Garantir que existe registo em candidatos para este user (evita erro "id on null" em /meu-cv)
        $perfilCandidato = DB::table('candidatos')->where('user_id', $candidatoUserId)->first();
        if (!$perfilCandidato) {
            $categoria = DB::table('categorias')->first();
            $provincia = DB::table('provincias')->first();
            DB::table('candidatos')->insert([
                'user_id' => $candidatoUserId,
                'datanascimento' => now()->subYears(30),
                'telefone_alt' => null,
                'endereco' => 'A preencher',
                'provincia_id' => $provincia ? $provincia->id : 1,
                'sexo' => 'Masculino',
                'categoria_id' => $categoria ? $categoria->id : 1,
                'numero_carta_conducao' => null,
                'validade_conducao' => null,
                'inibicao_anterior' => null,
                'inibicao_motivo' => null,
                'envolvimento_acidente' => null,
                'acidente_descricao' => null,
                'grau_academico' => null,
                'nacionalidade' => 'Moçambicana',
                'cv' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('✅ Perfil CANDIDATO (tabela candidatos) criado para 840000002!');
        }

        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('📋 CREDENCIAIS DE TESTE CRIADAS:');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('');
        $this->command->info('👤 ADMIN:');
        $this->command->info('   Email: admin@motoristas.co.mz');
        $this->command->info('   Senha: admin123');
        $this->command->info('');
        $this->command->info('🏢 EMPREGADOR:');
        $this->command->info('   Email: empresa@teste.com');
        $this->command->info('   Senha: password123');
        $this->command->info('');
        $this->command->info('👨‍💼 CANDIDATO:');
        $this->command->info('   Celular: 840000002');
        $this->command->info('   Senha: candidato123');
        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
    }
}

