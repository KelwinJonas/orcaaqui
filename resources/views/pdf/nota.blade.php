<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota do Pedido</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        .line-title{
            border-style: inset;
            border-top: 1px solid #000;
            width: 100%;
        }
        .centralizar {
            text-align: center;
        }
        .row {
            margin-top: 10px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</head>
<body>
    <div class="centralizar">
        <h4>OrçaAqui</h4>
        <h5>Nota do Pedido {{$pedido->id}}</h5>
    </div>
    <hr class="line-title">
    <div class="row">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Data prevista para entrega</th>
                    <th scope="col">Data de realização</th>
                    <th scope="col">Valor total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{date('d/m/Y', strtotime($pedido->data_prevista))}}</td>
                    <td>{{date('d/m/Y H:i', strtotime($pedido->created_at))}}</td>
                    <td>{{$pedido->valorTotal()}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @foreach ($pedido->produtos as $i => $produto)
        <hr class="line-title">
        <div class="row">
            <div class="col-12">
                <strong>Produto nº {{$produto->id}} - ({{$produto->nome}})</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <strong>Quantidade:</strong> {{$produto->pivot->quantidade}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div>
                    <strong>Valor:</strong> {{$produto->valor}}
                </div>
            </div>
        </div>
    @endforeach
</body>
</html>
