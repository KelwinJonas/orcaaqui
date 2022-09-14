<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public $fillable = [
        'sacola',
        'endereco',
        'status',
        'data_prevista',
        'data_entregue',
    ];

    public const STATUS_ENUM = [
        'processando' => 1,
        'recebido' => 2,
        'aprovado' => 3,
        'recusado' => 4,
        'enviado' => 5,
        'entregue' => 6,
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'pedido_produto', 'pedido_id', 'produto_id')->withPivot('quantidade', 'valor');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function valorTotal()
    {
        return $this->produtos()->sum('pedido_produto.valor');
    }

    public function getStatusString()
    {
        switch ($this->status) {
            case Pedido::STATUS_ENUM['processando']:
                return 'processando';
                break;
            case Pedido::STATUS_ENUM['recebido']:
                return 'recebido';
                break;
            case Pedido::STATUS_ENUM['aprovado']:
                return 'aprovado';
                break;
            case Pedido::STATUS_ENUM['recusado']:
                return 'recusado';
                break;
            case Pedido::STATUS_ENUM['enviado']:
                return 'enviado';
                break;
            case Pedido::STATUS_ENUM['entregue']:
                return 'entregue';
                break;
        }
    }
}
