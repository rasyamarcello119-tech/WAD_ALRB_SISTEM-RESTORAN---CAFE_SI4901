
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pegawai</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Edit Data Pegawai</h1>
    <p>Silakan ubah data pegawai di bawah ini.</p>

    <form method="POST" action="{{ route('pegawai.update', $pegawai->id) }}">
        @csrf
        @method('PUT')

        <label>Nama Pegawai:</label><br>
        <input type="text" name="nama_pegawai"
               value="{{ $pegawai->nama_pegawai }}" required>
        <br><br>

        <label>Nomor Kontak:</label><br>
        <input type="text" name="nomor_kontak"
               value="{{ $pegawai->nomor_kontak }}" required>
        <br><br>

        <label>Jabatan:</label><br>
        <select name="jabatan" required>
            <option value="Chef" {{ $pegawai->jabatan == 'Chef' ? 'selected' : '' }}>Chef</option>
            <option value="Waiter" {{ $pegawai->jabatan == 'Waiter' ? 'selected' : '' }}>Waiter</option>
            <option value="Kasir" {{ $pegawai->jabatan == 'Kasir' ? 'selected' : '' }}>Kasir</option>
        </select>
        <br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="Aktif" {{ $pegawai->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Tidak Aktif" {{ $pegawai->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
        <br><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ url('/') }}">Kembali</a>
    </form>

</body>
</html>
