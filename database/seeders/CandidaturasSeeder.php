<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CandidaturasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Verificar se existem vagas e candidatos
        $anuncios = DB::table('anuncios')->get();
        $candidatosExistentes = DB::table('candidatos')
            ->join('users', 'candidatos.user_id', '=', 'users.id')
            ->where('users.privilegio', 'candidato')
            ->select('candidatos.*', 'users.id as user_id')
            ->get();

        if ($anuncios->isEmpty()) {
            $this->command->warn('⚠️  Nenhuma vaga encontrada. Execute primeiro o AnunciosSeeder.');
            return;
        }

        // Criar candidatos adicionais se necessário
        $candidatosCriados = [];
        
        // Criar 5 candidatos de teste se não existirem candidatos suficientes
        if ($candidatosExistentes->count() < 5) {
            $categorias = DB::table('categorias')->get();
            $provincias = DB::table('provincias')->get();
            
            if ($categorias->isEmpty() || $provincias->isEmpty()) {
                $this->command->warn('⚠️  Categorias ou Províncias não encontradas. Execute os seeders básicos primeiro.');
                return;
            }

            $nomesCandidatos = [
                'Carlos Alberto Mussa',
                'Maria José Santos',
                'Pedro Manuel Nhaca',
                'Ana Paula Macamo',
                'José António Tembe',
                'Fatima Hassan Ali',
                'Manuel João Cossa',
                'Isabela Fernanda',
            ];

            $sexos = ['Masculino', 'Feminino'];
            $nacionalidades = ['Moçambicana', 'Moçambicana', 'Moçambicana', 'Angolana', 'Sul-Africana'];
            $grausAcademicos = ['12ª Classe', 'Técnico Médio', 'Bacharelato', 'Licenciatura', null];

            for ($i = 0; $i < 8; $i++) {
                $celular = '84000' . str_pad(100 + $i, 3, '0', STR_PAD_LEFT);
                $email = $celular . '@motoristas.co.mz';
                
                // Verificar se já existe
                $userExistente = DB::table('users')->where('email', $email)->first();
                if ($userExistente) {
                    continue;
                }

                // Criar usuário
                $userId = DB::table('users')->insertGetId([
                    'name' => $nomesCandidatos[$i] ?? 'Candidato Teste ' . ($i + 1),
                    'email' => $email,
                    'celular' => $celular,
                    'password' => Hash::make('candidato123'),
                    'privilegio' => 'candidato',
                    'active' => 'Activo',
                    'is_premium' => 'no',
                    'foto_url' => 'none',
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now(),
                ]);

                // Criar perfil do candidato
                $categoriaId = $categorias->random()->id;
                $provinciaId = $provincias->random()->id;
                $dataNascimento = now()->subYears(rand(25, 50))->subDays(rand(1, 365));

                $candidatoId = DB::table('candidatos')->insertGetId([
                    'user_id' => $userId,
                    'datanascimento' => $dataNascimento,
                    'telefone_alt' => '84111' . str_pad(100 + $i, 3, '0', STR_PAD_LEFT),
                    'endereco' => 'Endereço ' . ($i + 1) . ', ' . $provincias->where('id', $provinciaId)->first()->name,
                    'provincia_id' => $provinciaId,
                    'sexo' => $sexos[array_rand($sexos)],
                    'categoria_id' => $categoriaId,
                    'numero_carta_conducao' => 'CN' . str_pad(1000 + $i, 4, '0', STR_PAD_LEFT),
                    'validade_conducao' => rand(0, 1) ? 'Sim' : 'Não',
                    'inibicao_anterior' => rand(0, 1) ? 'Não' : 'Sim',
                    'inibicao_motivo' => null,
                    'envolvimento_acidente' => rand(0, 1) ? 'Não' : 'Sim',
                    'acidente_descricao' => null,
                    'grau_academico' => $grausAcademicos[array_rand($grausAcademicos)],
                    'nacionalidade' => $nacionalidades[array_rand($nacionalidades)],
                    'cv' => null,
                    'created_at' => now()->subDays(rand(1, 30)),
                    'updated_at' => now(),
                ]);

                $candidatosCriados[] = [
                    'user_id' => $userId,
                    'candidato_id' => $candidatoId,
                    'categoria_id' => $categoriaId,
                ];

                $this->command->info("✅ Candidato criado: {$nomesCandidatos[$i]} ({$email})");
            }
        }

        // Buscar todos os candidatos (existentes + criados)
        $todosCandidatos = DB::table('candidatos')
            ->join('users', 'candidatos.user_id', '=', 'users.id')
            ->where('users.privilegio', 'candidato')
            ->select('candidatos.*', 'users.id as user_id', 'candidatos.categoria_id')
            ->get();

        if ($todosCandidatos->isEmpty()) {
            $this->command->warn('⚠️  Nenhum candidato encontrado para criar candidaturas.');
            return;
        }

        // Criar candidaturas
        $candidaturasCriadas = 0;
        $candidaturasExistentes = DB::table('candidaturas_anuncios')
            ->pluck('user_id', 'anuncio_id')
            ->toArray();

        foreach ($anuncios as $anuncio) {
            // Determinar quantos candidatos vão se candidatar a esta vaga (1-5 candidatos por vaga)
            $numCandidaturas = rand(1, min(5, $todosCandidatos->count()));
            
            // Selecionar candidatos aleatórios
            $candidatosSelecionados = $todosCandidatos->random($numCandidaturas);
            
            foreach ($candidatosSelecionados as $candidato) {
                // Verificar se já existe candidatura
                $chave = $candidato->user_id . '_' . $anuncio->id;
                if (isset($candidaturasExistentes[$chave])) {
                    continue;
                }

                // Verificar se o candidato tem categoria compatível (opcional, mas aumenta realismo)
                // Por enquanto, vamos permitir qualquer candidatura para ter mais dados de teste

                // Criar candidatura
                DB::table('candidaturas_anuncios')->insert([
                    'user_id' => $candidato->user_id,
                    'anuncio_id' => $anuncio->id,
                    'created_at' => now()->subDays(rand(0, 10)),
                    'updated_at' => now(),
                ]);

                $candidaturasCriadas++;
                $candidaturasExistentes[$chave] = true;
            }
        }

        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('✅ CANDIDATURAS CRIADAS COM SUCESSO!');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('');
        $this->command->info("📊 Total de candidaturas criadas: {$candidaturasCriadas}");
        $this->command->info("👥 Total de candidatos disponíveis: {$todosCandidatos->count()}");
        $this->command->info("📋 Total de vagas disponíveis: {$anuncios->count()}");
        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
    }
}
