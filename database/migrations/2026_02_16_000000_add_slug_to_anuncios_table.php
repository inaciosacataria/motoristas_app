<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     * URLs seguras: usar slug em vez de ID sequencial.
     */
    public function up()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->string('slug', 32)->nullable()->unique()->after('id');
        });

        // Preencher slugs para registos existentes (não sequenciais, não previsíveis)
        $anuncios = \DB::table('anuncios')->get();
        $used = [];
        foreach ($anuncios as $anuncio) {
            do {
                $slug = Str::random(16);
            } while (in_array($slug, $used, true));
            $used[] = $slug;
            \DB::table('anuncios')->where('id', $anuncio->id)->update(['slug' => $slug]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('anuncios', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
