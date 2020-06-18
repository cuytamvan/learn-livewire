<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }} {{ isset($title) ? '| '.$title : '' }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <livewire:styles />
</head>
<body>
  @include('layouts.inc.header')

  <div class="container pt-4">
    @yield('content')
  </div>
  
  <livewire:scripts />
  <script src="{{ asset('js/app.js') }}"></script>
  @stack('script')
</body>
</html>