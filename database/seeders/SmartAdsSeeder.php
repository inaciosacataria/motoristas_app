<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmartAdsSeeder extends Seeder
{
    /**
     * Cria banners de publicidade para a página do empregador.
     * Usa HTML para não depender de upload de imagens.
     */
    public function run()
    {
        $existe = DB::table('smart_ads')->where('slug', 'banner-empregador-top')->first();
        if ($existe) {
            $this->command->info('ℹ️  Banners de publicidade já existem. Ignorando.');
            return;
        }

        $banners = [
            [
                'name' => 'Banner Superior - Empregador',
                'slug' => 'banner-empregador-top',
                'body' => '<div class="rounded-lg overflow-hidden shadow-md bg-gradient-to-r from-green-600 to-green-700 text-white p-6 text-center"><p class="text-lg font-semibold">Portal Motoristas</p><p class="text-sm opacity-90">Encontre os melhores motoristas para sua empresa.</p><a href="/" class="inline-block mt-2 px-4 py-2 bg-white text-green-700 rounded-lg font-medium hover:bg-green-50">Saiba mais</a></div>',
                'adType' => 'HTML',
                'image' => null,
                'imageUrl' => null,
                'imageAlt' => null,
                'views' => 0,
                'clicks' => 0,
                'enabled' => 1,
                'placements' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Banner Inferior - Empregador',
                'slug' => 'banner-empregador-bottom',
                'body' => '<div class="rounded-lg overflow-hidden shadow-md bg-gray-800 text-white p-6 text-center"><p class="text-lg font-semibold">Portal Motoristas</p><p class="text-sm text-gray-300">Pesquise motoristas e publique vagas em segurança.</p><a href="/" class="inline-block mt-2 px-4 py-2 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700">Aceder</a></div>',
                'adType' => 'HTML',
                'image' => null,
                'imageUrl' => null,
                'imageAlt' => null,
                'views' => 0,
                'clicks' => 0,
                'enabled' => 1,
                'placements' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($banners as $banner) {
            DB::table('smart_ads')->insert($banner);
        }

        $this->command->info('✅ 2 banners de publicidade criados (página Empregador).');
    }
}
