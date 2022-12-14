<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $fillable = [
        'nome'
    ];

    public function user()
    {
        return $this->hasMany(Produto::class);
    }
}
