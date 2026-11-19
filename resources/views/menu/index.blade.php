<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Menu Restoran - Modul A (CRUD)</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  <div class="buku-menu">

    <header>
      <p class="label">Restoran &amp; Kafe</p>
      <h1>Buku Menu</h1>
      <p class="pengantar">Sajian sederhana untuk momen yang istimewa.</p>
    </header>

    <form method="post" action="{{ route('logout') }}">
      @csrf
      <button class="tombol-batal" type="submit">Keluar</button>
    </form>

    @if (auth()->user()->isAdmin())
      @include('menu.form')
    @endif

    @include('menu.daftar_menu')

    <footer>
      <p class="penutup">Selamat menikmati.</p>
      <p class="catatan">Jika memiliki alergi, silakan informasikan kepada staf.</p>
    </footer>

  </div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>

