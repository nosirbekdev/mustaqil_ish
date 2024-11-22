<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
@include('components.main')
@include('components.about')
@include('components.footer')
</body>
</html>
