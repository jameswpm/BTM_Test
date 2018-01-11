<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aplicação Demo - BTM_Teste - API</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


</head>

<body>

<div class="container-fluid" id="main">

    <h1>BTM - API Tests</h1>

    <form method="post" action="{{action('ApiController@send')}}">
        <fieldset>

            <legend>API for tests</legend>

            <div class="col-md-12">
                <div class="row">
                    <div class=" col-md-6 form-group">
                        <label for="apitype" class="label-control">Escolha o que quer buscar:</label>
                        <select name="apitype" id="apitype">
                            <option value="posts">Obter todos os posts (GET)</option>
                            <option value="post">Incluir novo post (POST)</option>
                        </select>
                    </div>
                </div>


                <div class="row" id="form-post" style="display: none;">
                    <div class=" col-md-4 form-group">
                        <label for="name">Título</label>
                        <input type="text" id="name" name="name">

                    </div>
                    <div class=" col-md-4 form-group">
                        <label for="content">Conteúdo</label>
                        <textarea id="content" name="content">
                        </textarea>

                    </div>
                    <div class=" col-md-4 form-group">
                        <label for="user_id">Usuário</label>
                        <input type="input" id="user_id" name="user_id">

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Testar API" name="btnApi" class="btn btn-primary text-center">
                    </div>
                </div>

            </div>

        </fieldset>
    </form>
</div>

</body>

<footer>
    <div class="author"><span>Desenvolvido por <a href="https://github.com/jameswpm" target="_blank">James Miranda.</a><br></span></div>
    <script
            src="https://code.jquery.com/jquery-1.12.4.min.js"
            integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {


            $('#apitype').on('change', function (e) {
                var optionSelected = $("option:selected", this);
                var valueSelected = this.value;

                if(valueSelected == 'post') {
                    $('#form-post').show();
                } else {
                    $('#form-post').hide();
                }
            });


        });
    </script>
</footer>
</html>
