<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnunciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Primeiro, criar um usuário empregador de teste se não existir
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
        } else {
            $userId = $empregadorUser->id;
        }

        // Buscar IDs de categorias e províncias
        $categoriaA = DB::table('categorias')->where('categoria', 'like', '%A%')->first();
        $categoriaB = DB::table('categorias')->where('categoria', 'like', '%B%')->first();
        $categoriaC = DB::table('categorias')->where('categoria', 'like', '%C%')->first();
        $categoriaD = DB::table('categorias')->where('categoria', 'like', '%D%')->first();

        $maputo = DB::table('provincias')->where('name', 'like', '%Maputo%')->first();
        $beira = DB::table('provincias')->where('name', 'like', '%Sofala%')->first();
        $nampula = DB::table('provincias')->where('name', 'like', '%Nampula%')->first();

        // Array de anúncios de exemplo
        $anuncios = [
            [
                'titulo' => 'Motorista de Táxi Executivo - Salário Competitivo',
                'descricao' => 'Procuramos motorista profissional para serviço de táxi executivo. Requisitos: Carta de condução Categoria B válida, experiência mínima de 2 anos, conhecimento da cidade de Maputo, boa apresentação, pontualidade e responsabilidade. Oferecemos: Salário fixo + comissões, seguro de trabalho, uniformes, apoio com combustível. Horário flexível disponível.',
                'categoria_id' => $categoriaB ? $categoriaB->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1],
                'validade' => now()->addDays(30),
            ],
            [
                'titulo' => 'Motorista de Camião Pesado (Cat. C+E) - Transporte Nacional',
                'descricao' => 'Empresa de logística procura motorista experiente para transporte de mercadorias em rotas nacionais. Requisitos: Carta Categoria C+E, mínimo 3 anos de experiência, disponibilidade para viagens longas, conhecimento de manutenção básica de veículos. Oferecemos: Salário atrativo, subsídios de alimentação e dormida, seguro completo, manutenção do veículo garantida. Contrato de longo prazo.',
                'categoria_id' => $categoriaC ? $categoriaC->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1, $beira ? $beira->id : 2],
                'validade' => now()->addDays(45),
            ],
            [
                'titulo' => 'Motorista Particular para Família - Tempo Integral',
                'descricao' => 'Família residente em Maputo procura motorista confiável para transporte diário. Responsabilidades: Transporte de crianças para escola, fazer compras, manutenção do veículo. Requisitos: Carta Categoria B, experiência comprovada, referências obrigatórias, residente em Maputo ou arredores. Oferecemos: Salário mensal fixo, refeições, folgas semanais, ambiente familiar agradável.',
                'categoria_id' => $categoriaB ? $categoriaB->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1],
                'validade' => now()->addDays(20),
            ],
            [
                'titulo' => 'Motorista de Ambulância - Urgente (Cat. B)',
                'descricao' => 'Hospital privado contrata motorista de ambulância para serviços de emergência. Requisitos: Carta Categoria B válida, curso de primeiros socorros (preferencial), disponibilidade para turnos rotativos incluindo fins de semana, calma sob pressão, boa comunicação. Oferecemos: Salário competitivo, formação contínua, seguro de saúde, subsídio de risco, possibilidade de crescimento na instituição.',
                'categoria_id' => $categoriaB ? $categoriaB->id : 1,
                'provincias' => [$beira ? $beira->id : 2],
                'validade' => now()->addDays(15),
            ],
            [
                'titulo' => 'Motorista de Autocarro Urbano (Cat. D) - Maputo',
                'descricao' => 'Empresa de transportes públicos recruta motoristas de autocarro. Requisitos: Carta Categoria D válida, experiência mínima de 1 ano em transporte de passageiros, conhecimento das rotas urbanas de Maputo, bom relacionamento interpessoal. Oferecemos: Salário base + bónus de desempenho, seguro completo, formação inicial paga, uniformes, possibilidade de horas extras remuneradas.',
                'categoria_id' => $categoriaD ? $categoriaD->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1],
                'validade' => now()->addDays(25),
            ],
            [
                'titulo' => 'Motorista de Entregas Delivery - Motas e Carros Ligeiros',
                'descricao' => 'Plataforma de delivery em expansão contrata motoristas. Requisitos: Carta Categoria A ou B, smartphone com internet, veículo próprio ou fornecido pela empresa, disponibilidade imediata. Oferecemos: Horários flexíveis, pagamento por entrega + bónus, aplicativo fácil de usar, suporte técnico 24h, seguro de acidentes pessoais. Ideal para quem busca renda extra ou tempo integral.',
                'categoria_id' => $categoriaA ? $categoriaA->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1, $beira ? $beira->id : 2, $nampula ? $nampula->id : 3],
                'validade' => now()->addDays(60),
            ],
            [
                'titulo' => 'Motorista de Transporte Escolar - Manhãs e Tardes',
                'descricao' => 'Escola internacional procura motorista responsável para transporte de alunos. Requisitos: Carta Categoria D ou superior, experiência com crianças, registo criminal limpo (obrigatório), paciência e responsabilidade. Oferecemos: Horário part-time (manhã e tarde), salário fixo mensal, folgas durante férias escolares, ambiente de trabalho estável e respeitoso. Início imediato.',
                'categoria_id' => $categoriaD ? $categoriaD->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1],
                'validade' => now()->addDays(10),
            ],
            [
                'titulo' => 'Motorista de Grua/Reboque - Experiência Necessária',
                'descricao' => 'Oficina mecânica procura motorista de grua para reboque de veículos. Requisitos: Carta Categoria C, experiência com operação de grua, conhecimento mecânico básico, disponibilidade 24h (sistema de turnos). Oferecemos: Salário atrativo, subsídio de disponibilidade, formação especializada, equipamentos de segurança, ambiente de equipa dinâmica.',
                'categoria_id' => $categoriaC ? $categoriaC->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1, $beira ? $beira->id : 2],
                'validade' => now()->addDays(35),
            ],
            [
                'titulo' => 'Motorista de Viaturas de Turismo (Cat. B) - Hotel 5 Estrelas',
                'descricao' => 'Resort de luxo contrata motorista para transporte de hóspedes. Requisitos: Carta Categoria B, fluência em Inglês (obrigatório), Português (nativo), experiência em hotelaria (preferencial), excelente apresentação pessoal, cordialidade e profissionalismo. Oferecemos: Salário competitivo, gorjetas, uniforme fornecido, refeições durante turno, possibilidade de crescimento profissional.',
                'categoria_id' => $categoriaB ? $categoriaB->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1],
                'validade' => now()->addDays(40),
            ],
            [
                'titulo' => 'Motorista de Transporte de Valores - Segurança Máxima',
                'descricao' => 'Empresa de segurança contrata motorista para transporte de valores. Requisitos: Carta Categoria B, curso de segurança (fornecido), registo criminal limpo (verificação obrigatória), discrição absoluta, disponibilidade para treino intensivo. Oferecemos: Salário elevado, subsídio de risco significativo, seguro de vida, formação especializada paga, equipamento de proteção completo, contrato de trabalho estável.',
                'categoria_id' => $categoriaB ? $categoriaB->id : 1,
                'provincias' => [$maputo ? $maputo->id : 1, $beira ? $beira->id : 2],
                'validade' => now()->addDays(50),
            ],
        ];

        // Inserir os anúncios
        foreach ($anuncios as $anuncio) {
            $anuncioId = DB::table('anuncios')->insertGetId([
                'user_id' => $userId,
                'titulo' => $anuncio['titulo'],
                'descricao' => $anuncio['descricao'],
                'categoria_id' => $anuncio['categoria_id'],
                'validade' => $anuncio['validade'],
                'estado_anuncio' => 'Publicado',
                'forma_de_candidatura' => 'online',
                'created_at' => now()->subDays(rand(1, 10)),
                'updated_at' => now(),
            ]);

            // Associar províncias
            foreach ($anuncio['provincias'] as $provinciaId) {
                DB::table('anuncios_provincias')->insert([
                    'anuncio_id' => $anuncioId,
                    'provincia_id' => $provinciaId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('✅ VAGAS CRIADAS COM SUCESSO!');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('');
        $this->command->info("📋 Total de vagas criadas: " . count($anuncios));
        $this->command->info("🏢 Empresa: Transportes Moçambique Lda");
        $this->command->info("📧 Email: empresa@teste.com");
        $this->command->info('');
        $this->command->info('💡 Dica: Execute o CandidaturasSeeder para criar candidaturas');
        $this->command->info('   php artisan db:seed --class=CandidaturasSeeder');
        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
    }
}
