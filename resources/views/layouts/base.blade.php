<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{$web_config['title']}}</title>
    <meta name="keywords" content="{{$web_config['keywords']}}"/>
    <meta name="description" content="{{$web_config['description']}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel =
        <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
</head>
<body>
<div id="app">
    @yield('content')
</div>
</body>
<script src="{{ asset('js/app.js') }}"></script>
<style>
    .middle_div{
        position:absolute;
        top:50%;
        left:50%;
        width:30%;
        height: 20%;
        margin-left:-15%;
        margin-top:-10%;
    }
</style>
</html>