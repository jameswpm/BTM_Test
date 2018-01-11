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

        @if( $data["type"] == "posts")
            <a href="{{ url()->previous() }}">Voltar</a>
            <p>Todos os posts do blog</p>
            @foreach ($data['response'] as $post)
                <span class="label label-primary">{{ $post['title'] }}</span>
                <span class="label label-default">{{ $post['body'] }}</span>
            <br>
            @endforeach
        @endif
    @if( $data["type"] == "post")
        <a href="{{ url()->previous() }}">Voltar</a>
        <p>Seu post foi criado com sucesso</p>
    @endif

</div>

</body>

<footer>
    <div class="author"><span>Desenvolvido por <a href="https://github.com/jameswpm" target="_blank">James Miranda.</a><br></span></div>
</footer>
</html>
