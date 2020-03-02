<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">            
            <logout-component></logout-component>         
        </nav>
        <create-ticket-component></create-ticket-component>
        <hr>
        <redeem-ticket-component></redeem-ticket-component>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>