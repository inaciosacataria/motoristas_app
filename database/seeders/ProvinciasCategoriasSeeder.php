<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciasCategoriasSeeder extends Seeder
{
    /**
     * Cria províncias e categorias básicas para o sistema funcionar.
     * Só insere se as tabelas estiverem vazias.
     */
    public function run()
    {
        $this->seedProvincias();
        $this->seedCategorias();
    }

    private function seedProvincias()
    {
        if (DB::table('provincias')->count() > 0) {
            $this->command->info('ℹ️  Províncias já existem. Ignorando.');
            return;
        }

        $provincias = [
            'Maputo', 'Gaza', 'Inhambane', 'Sofala', 'Manica', 'Tete', 'Zambézia',
            'Nampula', 'Cabo Delgado', 'Niassa', 'Maputo Cidade'
        ];

        foreach ($provincias as $name) {
            DB::table('provincias')->insert([
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ ' . count($provincias) . ' províncias criadas.');
    }

    private function seedCategorias()
    {
        if (DB::table('categorias')->count() > 0) {
            $this->command->info('ℹ️  Categorias já existem. Ignorando.');
            return;
        }

        $categorias = [
            ['categoria' => 'A-Motociclo', 'url' => 'a-motociclo'],
            ['categoria' => 'B-Ligeiro', 'url' => 'b-ligeiro'],
            ['categoria' => 'C-Pesado', 'url' => 'c-pesado'],
            ['categoria' => 'D-Transporte de passageiros', 'url' => 'd-passageiros'],
            ['categoria' => 'C+E-Reboque', 'url' => 'c-e-reboque'],
        ];

        foreach ($categorias as $cat) {
            DB::table('categorias')->insert([
                'categoria' => $cat['categoria'],
                'url' => $cat['url'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ ' . count($categorias) . ' categorias criadas.');
    }
}
