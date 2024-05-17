<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->unique();
            $table->timestamps();
        });

        // Inserir os status iniciais
        DB::table('statuses')->insert([
            ['descricao' => 'inativo'],
            ['descricao' => 'ativo'],
            ['descricao' => 'pendente'],
            ['descricao' => 'excluido']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
