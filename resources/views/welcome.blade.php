<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aplicação Demo - BTM_Teste</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:600" type="text/css" rel="stylesheet" />

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <link href="style.css" type="text/css" rel="stylesheet" />

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="mapa.js"></script>
    <script type="text/javascript" src="jquery-ui.custom.min.js"></script>

</head>

<body>

<div class="container-fluid" id="main">

    <h1>BTM - Short Trip</h1>

    <form method="post" action="index.html">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

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

                    <div id="map"></div>

                    <input type="submit" value="Obter menor caminho" name="btnSend" class="btn btn-primary"/>

                    <input type="hidden" id="txtLatitude" name="txtLatitude" />
                    <input type="hidden" id="txtLongitude" name="txtLongitude" />
                </div>
            </div>

        </fieldset>
    </form>

</div>

</body>

<footer>
    <div><span>Desenvolvido por <a href="https://github.com/jameswpm" target="_blank">James Miranda.</a><br></span></div>
</footer>
</html>
