<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk ke Buku Menu</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <main class="buku-menu">
    <header>
      <p class="label">Restoran &amp; Kafe</p>
      <h1>Buku Menu</h1>
    </header>
    <section class="kotak-form">
      <h2>Masuk</h2>
      @if ($errors->any())
        <ul class="pesan-gagal" role="alert">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif
      <form method="post" action="{{ route('login.store') }}">
        @csrf
        <p><label for="email">Email</label><br>
          <input id="email" name="email" type="email" autocomplete="username" value="{{ old('email') }}" required></p>
        <p><label for="password">Kata sandi</label><br>
          <input id="password" name="password" type="password" autocomplete="current-password" required></p>
        <button class="tombol-simpan" type="submit">Masuk</button>
      </form>
    </section>
  </main>
</body>
</html>
