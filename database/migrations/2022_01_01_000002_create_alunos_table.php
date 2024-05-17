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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id(); // Isso criará uma coluna 'id' autoincrementável
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('rg')->nullable();
            $table->string('telefone')->nullable();
            $table->enum('sexo', ['M', 'F', 'Outro']);
            $table->date('data_nascimento');
            $table->text('endereco')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
