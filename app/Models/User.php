<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    public const ROLE_ENUM = [
        'comprador' => 1,
        'fornecedor' => 2,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function produtosCarrinho()
    {
        $ultimoPedido = $this->pedidos->last();
        if ($ultimoPedido && $ultimoPedido->sacola) {
            $produtos = $ultimoPedido->produtos
            ->transform(fn ($produto) => [
                'id' => $produto->pivot->id,
                'valor' => $produto->pivot->valor,
                'quantidade' => $produto->pivot->quantidade,
            ]);
            return $produtos;
        }
        return null;

    }

    public function getRoleString()
    {
        switch ($this->role) {
            case User::ROLE_ENUM['comprador']:
                return 'comprador';
                break;
            case User::ROLE_ENUM['fornecedor']:
                return 'fornecedor';
                break;
        }
    }

    public function isFornecedor(){
        return $this->role == User::ROLE_ENUM['fornecedor'];
    }

    public function isComprador(){
        return $this->role == User::ROLE_ENUM['comprador'];
    }
}
