<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Pedido;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        $pedidos->setCollection($pedidos->getCollection()->transform(fn ($pedido) => [
            'id' => $pedido->id,
            'valor' => $pedido->valorTotal(),
            'status' => $pedido->getStatusString(),
        ]));

        return Inertia::render('Pedidos', ['pedidos' => $pedidos]);
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
     * @param  \App\Http\Requests\StorePedidoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produto = Produto::find($request->id);
        if (! Auth::user()->pedidos->last() || ! Auth::user()->pedidos->last()->sacola) {
            $pedido = new Pedido();
            $pedido->data_prevista = Carbon::now()->addDays(10);
            $pedido->user()->associate(Auth::user());
            $pedido->save();
        } else {
            $pedido = Auth::user()->pedidos->last();
        }
        $pedidoProduto = $pedido->produtos()->where('produto_id', $produto->id)->first();
        if ($pedidoProduto) {
            $pedidoProduto = $pedidoProduto->pivot;
            $pedidoProduto->quantidade += 1;
            $pedidoProduto->update();
        } else {
            $pedido->produtos()->attach($produto->id);
        }
        return Redirect::back()->with('message', 'Produto salvo com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePedidoRequest  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido  $pedido)
    {
        $pedidoProduto = $pedido->produtos()->where('produto_id', $request->id)->first();
        $pedidoProduto = $pedidoProduto->pivot;
        $pedidoProduto->quantidade += $request->soma;
        $pedidoProduto->update();

        if ($pedidoProduto->quantidade == 0) {
            $pedidoProduto->delete();
        }

        if (! $pedido->produtos()) {
            $pedido->detele();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
