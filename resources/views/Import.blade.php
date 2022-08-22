<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ \App::getLocale() }}"/>
    <title>{{ config('app.name', 'LaraJS') }}</title>

    <link href="{{ mix('css/app.css') }}" type="text/css" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('images/logo-tanmnt.png')}}"/>
</head>
<body>

<form action="http://larajs.test/api/v1/import">
    @csrf
    <label for="file_import">Select file:</label><br>
    <input type="file" id="file_import" name="file_import"><br>
    <input type="submit" value="Submit">
</form>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js')}}"></script>
<script src="{{ mix('js/app.js')}}"></script>
</body>
</html>
