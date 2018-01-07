<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aplicação Demo - BTM_Teste</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:600" type="text/css" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body>

<div class="container-fluid" id="main">

    <h1>BTM - Short Trip</h1>

    <form method="post" action="index.html">
        <fieldset>

            <legend>BTM - Short Trip</legend>

            <div class="col-md-12">
                <div class="row">
                    <div class=" col-md-6 form-group">
                        <label for="add1" class="label-control">Partida:</label>
                        <input type="text" id="add1" name="add1Text" class="form-control"/>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="add2" class="label-control">Chegada:</label>
                        <input type="text" id="add2" name="add2Text" class="form-control"/>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                            <div id="map"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <input type="submit" value="Obter menor caminho" name="btnSend" class="btn btn-primary text-center">
                        <input type="reset" value="Limpar mapa" id="btnReset" name="btnReset" class="btn btn-warning text-center">

                        <input type="hidden" id="txtLatitude1" name="txtLatitude1" />
                        <input type="hidden" id="txtLongitude1" name="txtLongitude1" />
                        <input type="hidden" id="txtLatitude2" name="txtLatitude2" />
                        <input type="hidden" id="txtLongitude2" name="txtLongitude2" />
                    </div>
                </div>
            </div>

        </fieldset>
    </form>

    <div id="result" style="display: none;">
        <div class="row">
            <div id="origin" class="col-md-6">
                <h3>Origem:</h3>
                <p class="lat"></p>
                <p class="lng"></p>
                <p class="add"></p>
            </div>
            <div id="dest" class="col-md-6">
                <h3>Destino:</h3>
                <p class="lat"></p>
                <p class="lng"></p>
                <p class="add"></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 alert alert-primary" role="alert">
                 A melhor rota foi apresentada no mapa
            </div>
        </div>
    </div>


</div>

</body>

<footer>
    <div class="author"><span>Desenvolvido por <a href="https://github.com/jameswpm" target="_blank">James Miranda.</a><br></span></div>
    <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/ui/1.8.24/jquery-ui.min.js"
            integrity="sha256-UOoxwEUqhp5BSFFwqzyo2Qp4JLmYYPTHB8l+1yhZij8="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDL6T2uw5F1PBOt0G9_N2T_ge3OYyCAMeY&libraries=geometry"
            type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('js/map.js') }}"></script>
</footer>
</html>
