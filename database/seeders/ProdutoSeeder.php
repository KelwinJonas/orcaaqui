<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Seeder;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produto::create([
            'nome' => 'Produto 1',
            'quantidade' => 10,
            'valor' => 10.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 1,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 2',
            'quantidade' => 6,
            'valor' => 15.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 2,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 3',
            'quantidade' => 7,
            'valor' => 17.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 4,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 4',
            'quantidade' => 2,
            'valor' => 25.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 5,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 5',
            'quantidade' => 7,
            'valor' => 119.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 7,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 6',
            'quantidade' => 15,
            'valor' => 35.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 2,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 7',
            'quantidade' => 4,
            'valor' => 17.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 1,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 8',
            'quantidade' => 2,
            'valor' => 22.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 5,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 9',
            'quantidade' => 4,
            'valor' => 139.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 5,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 10',
            'quantidade' => 12,
            'valor' => 31.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 8,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 11',
            'quantidade' => 41,
            'valor' => 2.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 16,
            'user_id' => 2,
        ]);

        Produto::create([
            'nome' => 'Produto 12',
            'quantidade' => 20,
            'valor' => 19.99,
            'descricao' => "Alguma descrição do produto",
            'imagem' => "/",
            'categoria_id' => 8,
            'user_id' => 2,
        ]);
    }
}
