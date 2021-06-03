<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_completo',
        'nascimento',
        'nome_mae',
        'uf_nascimento',
        'rg',
        'cpf',
        'cep',
        'endereco',
        'bairro',
        'numero',
        'complemento',
        'cidade',
        'uf',
        'telefone',
        'celular',
        'email',
    ];
}
