<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Muri') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- font awesome for icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  </head>
  <body>
    <nav class="navbar">
      <div class="container-fluid">
        <a class="navbar-brand">MURI</a>
          <button class="btn">Mainkan Sekarang</button>
      </div>
    </nav>

    <section id="hero">
      <img src="{{ asset('assets/img/bg.png') }}" class="bg-hero" alt="background">
    </section>
    
    <section id="video">
      <div class="header">
        <div class="foto1">
        <img src="{{ asset('assets/img/bg.png') }}" class="bg-header" alt="background">
      </div>
      </div>
      <div class="muri-logo text-dark text-center">
        Muri
      </div>
      <div class="d-flex justify-content-center">
        <button class="trailler btn mx-3">Trailer Video <i class="fa-solid fa-play bg-white w-45 h-45" style="color: #ED7D31; "></i></button>
        <button class="mainkan btn">Mainkan Sekarang</button>
      </div>

    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/03d46b6e93.js" crossorigin="anonymous"></script>
  </body>
</html>