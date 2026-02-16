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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Tipo de notificação
            $table->morphs('notifiable'); // user_id e user_type
            $table->text('data'); // Dados da notificação em JSON
            $table->timestamp('read_at')->nullable(); // Data de leitura
            $table->timestamps();
            
            // Índices para performance
            $table->index(['notifiable_type', 'notifiable_id']);
            $table->index('read_at');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
