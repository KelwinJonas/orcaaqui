<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['nome' => 'Agricultura']);
        Categoria::create(['nome' => 'Alimentação']);
        Categoria::create(['nome' => 'Comércio']);
        Categoria::create(['nome' => 'Comunicação']);
        Categoria::create(['nome' => 'Construção']);
        Categoria::create(['nome' => 'Educação']);
        Categoria::create(['nome' => 'Empregos']);
        Categoria::create(['nome' => 'Energia']);
        Categoria::create(['nome' => 'Eventos']);
        Categoria::create(['nome' => 'Governo']);
        Categoria::create(['nome' => 'Indústria']);
        Categoria::create(['nome' => 'Infraestrtutura de Software']);
        Categoria::create(['nome' => 'Imobiliário']);
        Categoria::create(['nome' => 'Lazer']);
        Categoria::create(['nome' => 'Logística']);
        Categoria::create(['nome' => 'Mobilidade Urbana']);
        Categoria::create(['nome' => 'Música']);
        Categoria::create(['nome' => 'Pecuária']);
        Categoria::create(['nome' => 'Pets']);
        Categoria::create(['nome' => 'Recursos Humanos']);
        Categoria::create(['nome' => 'Saúde']);
        Categoria::create(['nome' => 'Segurança']);
        Categoria::create(['nome' => 'Seguros']);
        Categoria::create(['nome' => 'Serviços em Geral']);
        Categoria::create(['nome' => 'Serviços Financeiros']);
        Categoria::create(['nome' => 'Sustentabilidade / Reciclagem']);
        Categoria::create(['nome' => 'Transporte']);
        Categoria::create(['nome' => 'Turismo']);
        Categoria::create(['nome' => 'Vestuário']);
        Categoria::create(['nome' => 'Varejo Supermercadista']);
        Categoria::create(['nome' => 'Veículos']);
    }
}
