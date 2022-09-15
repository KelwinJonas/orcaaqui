<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Http\Requests\UpdateProdutoRequest;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
        $produtos = Produto::where('user_id', Auth::user()->id)->with('categoria')->orderBy('nome')->paginate(10);
        return Inertia::render('Produtos', ['produtos' => $produtos, 'categorias' => $categorias]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todos_produtos()
    {
        $produtos = Produto::where('quantidade', '>', 0)->with('categoria')->orderBy('nome')->paginate(9);
        return Inertia::render('Welcome', [
            'produtos' => $produtos,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdutoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdutoRequest $request)
    {
        $this->authorize('isFornecedor', User::class);
        $validated = $request->validated();
        $validated['imagem'] = '/';
        $produto = new Produto($validated);
        $produto->user()->associate(Auth::user());
        $produto->categoria()->associate($validated['categoria']);
        $produto->save();

        return Redirect::back()->with('message', 'Produto salvo com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdutoRequest  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        $this->authorize('isFornecedor', User::class);
        $validated = $request->validated();

        if($validated['categoria'] != $produto->categoria_id) {
            $produto->categoria()->dissociate();
            $produto->categoria()->associate($validated['categoria']);
        }
        $produto->save();

        $produto->fill($validated);
        $produto->save();

        return Redirect::back()->with('message', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();

        return Redirect::back()->with('message', 'Produto deletado.');
    }
}
