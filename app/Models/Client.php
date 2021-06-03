<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'cnpj_cpf',
        'address',
        'state',
        'city',
        'cep',
        'description',
        'status',
    ];
}
