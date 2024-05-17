<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'cpf', 'rg', 'telefone', 'sexo', 'data_nascimento', 'endereco', 'status_id'
    ];

    protected $dates = ['data_nascimento'];

    public function getIdadeAttribute()
{
    // Verifica se data_nascimento é uma instância de Carbon
    if ($this->data_nascimento instanceof Carbon) {
        // Retorna a idade com base na data de nascimento
        return $this->data_nascimento->age;
    }
    return null; // Retorna null se a data de nascimento não for válida
}
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
