<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    public $fillable = [
        'nome',
        'valor',
        'descricao',
        'quantidade',
        'imagem',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'pedido_produto', 'produto_id', 'pedido_id')->withPivot('quantidade', 'valor');
    }

}
