<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <style>
        body{
            padding:20px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Paginação</title>
</head>
<body>
    <div class="container">
        <div class="card text-center">
            <div class = "card-header">
                Tabela Clientes
            </div>
            <div class = "card-body">
                <h5 class = "card-title">Exibindo {{$clientes->count()}} clientes de {{$clientes->total()}}(
                    {{$clientes->firstItem()}} a {{$clientes->lastItem()}}
                )
                </h5>
                <table class="table table-hover">
                    <thead>
                        <th scope="col"># </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">Email</th>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $c)
                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{$c->nome}}</td>
                                <td>{{$c->sobrenome}}</td>
                                <td>{{$c->email}}</td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class = "card-footer">
                {{$clientes->links('pagination::bootstrap-4')}}

            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}" type = "text/javascript"></script>
</body>
</html>