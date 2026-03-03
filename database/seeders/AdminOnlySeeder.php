<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminOnlySeeder extends Seeder
{
    /**
     * Seed minimal data: only admin user + base provincias/categorias + banners.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('');
        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('🚀 SEED: Admin + dados básicos');
        $this->command->info('═══════════════════════════════════════════════════');

        // Admin user
        $admin = DB::table('users')->where('email', 'admin@motoristas.co.mz')->first();
        if (!$admin) {
            DB::table('users')->insert([
                'name' => 'Administrador Sistema',
                'email' => 'admin@motoristas.co.mz',
                'celular' => '840000001',
                'password' => Hash::make('admin123'),
                'privilegio' => 'admin',
                'active' => 'Activo',
                'is_premium' => 'no',
                'foto_url' => 'none',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('✅ Usuário ADMIN criado (admin@motoristas.co.mz / admin123)');
        } else {
            $this->command->info('ℹ️  Usuário ADMIN já existe, mantendo.');
        }

        // Provincias e categorias básicas
        $this->call(ProvinciasCategoriasSeeder::class);

        // Banners de publicidade padrão (opcional, apenas se não existirem)
        $this->call(SmartAdsSeeder::class);

        $this->command->info('═══════════════════════════════════════════════════');
        $this->command->info('✅ SEED concluído: apenas admin + dados básicos.');
        $this->command->info('═══════════════════════════════════════════════════');
    }
}

