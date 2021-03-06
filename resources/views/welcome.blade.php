<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' }
    </script>

    <title>Laravel 8 API Resources</title>

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
    {{-- Header --}}

    <div id="app">
        <div class="container">
            <Cadastros />
        </div>
    </div>

    /<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
