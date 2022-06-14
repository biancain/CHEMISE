<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>chemise</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Script -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- Icon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.jpg') }}">
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('/img/favicon_192x192.png') }}"> --}}

</head>
<body onload="hora_act();">
    <section style="padding-top: 10%; text-align: center">
        <div class="container">
            <h1 id='hora'></h1>
            <div class="form-group">
                <div >
                    <h2 class="seccion1">Cod</h2><h2 class="seccion1" style="text-align:left;">Producto</h2><h2 class="seccion1" style="text-align: right; padding-right:1%;padding-bottom: 0%">Linea</h2>
                    {{-- <select id="select_product" class="form-select"  name="select_product" required style="height:50px; width:75%;">
                        <option class="option" value="" disabled selected>Seleccione el producto</option>
                        <option class="option" value="factura">Factura</option>
                        <option class="option" value="sobre">Sobre</option>
                        <option class="option" value="comprobante">Comprobante</option>
                        <option class="option" value="otro">Otro</option>
                    </select> --}}
                    <input id="autocompleteproduc" name="prod_func" type="number" class="form-control" placeholder="Produc" aria-label="Produc" aria-describedby="basic-addon2" style="float:left;padding:10px;height:35px; width:17%;">
                    <label id="product_name" class="labelprod" for="Producto" style="text-align:left;padding-right:5%;padding-left:5%;padding-bottom:0%"></label>
                    {{-- <input class="form-check-input position-static" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="A" style="float:center;padding:8px;height:5px; width:5px;"> --}}
                    <div style="float:right">
                        @for ($x = 1; $x <= 6; $x++)
                            <div class="form-check form-check-inline" style="text-align:right; padding-right:5%;padding-left:5%;padding-bottom: 0%">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" style="float:center;padding:8px;height:5px; width:5px;">
                                <label id="linea" class="form-check-label" for="inlineRadio1" style="float:center;height:5px; width:5px;">{{ $x }}</label>
                            </div>
                        @endfor
                    </div>
                    {{-- <select id="select_linea" class="form-select" name="select_linea" required style="height:35px; width:17%;">
                        <option class="option" value="1">1</option>
                        <option class="option" value="2">2</option>
                        <option class="option" value="3">3</option>
                        <option class="option" value="4">4</option>
                    </select> --}}
                </div>

                <div style="padding-top:12%">
                    <h2 class="seccion2">Cod</h2><h2 class="seccion2" style="text-align:left;">Nombres y Apellidos</h2>
                    <br>
                    <input id="autocomplete" name="cod_func" type="number" class="form-control" placeholder="Cod" aria-label="Cod" aria-describedby="basic-addon2" style="float:left;padding:10px;height:35px; width:17%;">
                    <label id="nombreApellido" class="labelfun" for="Nombre y Apellido" style="text-align:left;padding-right:5%;padding-left:5%;padding-bottom:0%"></label>
                    {{-- <select id="select_name" class="form-select"  name="select_name" required style="height:35px; width:80%;">
                        @foreach ($dic as $key=>$value)
                            <option id="{{ $key }}" class="option" value="{{ $value }}" disabled>{{ $value }}</option>
                        @endforeach

                    </select> --}}
                </div>
            </div>
        </div>
        <div class="container" style="padding-top:10%">
            <div class="form-group" >
                <label id="reTrabajo" class="conRetrabajo" value="" for="2">0</label>

            </div>
            <div class="form-group2">
                <label  id="trabajo" class="conTrabajo" value="" for="1">0</label>
            </div>
        </div>
        <div class="container" style="padding-top:5%">
            <button id="btn" type="button" class="btnTrabajo" onclick="trabajo();">+</button>
            <button id="btnre" type="button" class="btnRetrabajo" onclick="retrabajo();">R</button>
        </div>
    </section>
    <script>
        $('#autocomplete').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{route('search.autocomplete')}}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data)
                    }
                })
            },
            focus : function(){ return false; }
        }).on( 'autocompleteresponse autocompleteselect', function( e, ui ){
            console.log("a");
            nombreApellido = $('#nombreApellido')
            respuesta = ( e.type == 'autocompleteresponse' ? ui.content[0].label :  ui.item.label )
            nombreApellido.text( respuesta );

            return false;
        });
    </script>
    <script>
        $('#autocompleteproduc').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{route('search.autocomplete')}}",
                    dataType: 'json',
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data)
                    }
                })
            },
            focus : function(){ return false; }
        }).on( 'autocompleteresponse autocompleteselect', function( e, ui ){
            console.log("a");
            nombreApellido = $('#product_name')
            respuesta = ( e.type == 'autocompleteresponse' ? ui.content[0].label :  ui.item.label )
            nombreApellido.text( respuesta );

            return false;
        });
    </script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="{{ asset('js/trabajo.js') }}" type="text/javascript"></script>

</body>
</html>