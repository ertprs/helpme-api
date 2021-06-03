<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'crime_id',
        'pessoa_id',
        'status_id',
        'datahora_ocorrencia',
        'descricao_detalhada'
    ];

}
