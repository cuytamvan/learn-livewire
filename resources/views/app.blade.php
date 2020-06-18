<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <livewire:styles />
</head>
<body>

  <div class="container pt-3">
    <div class="row d-flex">
      <div class="col-sm-12 col-md-5">
        <livewire:tickets />
      </div>
      <div class="col-sm-12 col-md-7">
        <livewire:comments />
      </div>
    </div>
  </div>
  
  <livewire:scripts />
  <script src=""></script>
  @stack('script')
</body>
</html>