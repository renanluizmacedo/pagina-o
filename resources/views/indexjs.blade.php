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
                <h5 class = "card-title" id = "cardTitle">
                     
                </h5>
                <table class="table table-hover" id = "tabelaClientes">
                    <thead>
                        <th scope="col"># </th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">Email</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class = "card-footer">
                <nav id = "paginator">
                    <ul class="pagination">
                 
                    </ul>
                  </nav>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}" type = "text/javascript"></script>
    
    <script type = "text/javascript">


        
        function getItemProximo(data){
            i = data.current_page + 1;
            if(data.last_page == data.current_page){
                s = '<li class="page-item disabled">';

            }
            else{
                s = '<li class="page-item">';  
            }
             
            s += '<a class="page-link" ' + 'pagina = "' + i +'" href="javascript:void(0);">Proximo</a></li>';
        
            return s;
        
        }
        function getItemAnterior(data){
            i = data.current_page -1;
            if(1 == data.current_page){
                s = '<li class="page-item disabled">';

            }
            else{
                s = '<li class="page-item">';  
            }
             
            s += '<a class="page-link" ' + 'pagina = "' + i +'" href="javascript:void(0);">Anterior</a></li>';
        
            return s;
        
        }
        function getItem(data,i){

            if(i == data.current_page){
                s = '<li class="page-item active">';

            }
            else{
                s = '<li class="page-item">';  
            }
             
            s += '<a class="page-link" ' + 'pagina = "' + i +'" href="javascript:void(0);" >' + i + '</a></li>';
        
            return s;
        
        }
        function montarPaginator(data){
            $("#paginator>ul>li").remove();
            $("#paginator>ul").append(getItemAnterior(data));
            
            n = 10;

            if(data.current_page - n/2 <= 1){
                inicio = 1;
            }
            else if(data.last_page - data.current_page < n){
                inicio = data.last_page - n + 1;
            }
            else{
                inicio = data.current_page - n/2;
            }
           
            fim = inicio + n - 1;

            for(i=inicio;i<=fim;i++){
                s = getItem(data,i);
                $("#paginator>ul").append(s);
            }
            $("#paginator>ul").append(getItemProximo(data));

        }
        function montarLinha(cliente){
            return '<tr>' + 
                '<td>' + cliente.id + '</td>'+
                '<td>' + cliente.nome + '</td>'+
                '<td>' + cliente.sobrenome + '</td>'+
                '<td>' + cliente.email + '</td>'+
            '</tr>'; 
        }

        function montarTabela(data) {
            $("#tabelaClientes>tbody>tr").remove();
            for(i=0;i<data.data.length;i++) {
                $("#tabelaClientes>tbody").append(
                    montarLinha(data.data[i])
                );
            }
        }

        function carregarClientes(pagina){
            $.get('/json',{page:pagina},function(resp){
                console.log(resp);
                montarTabela(resp);
                montarPaginator(resp);
                $("#paginator>ul>li>a").click(function(){
                    carregarClientes($(this).attr('pagina'));
                });
                $("#cardTitle").html("Exibindo "+ resp.per_page + " clientes de "+resp.total+"( " + resp.from +" a "+resp.to+" ) ");

            });
            
         }

        $(function(){

            carregarClientes();
        });
    </script>
</body>
</html>