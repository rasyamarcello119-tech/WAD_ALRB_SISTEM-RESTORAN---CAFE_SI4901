
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff & Pegawai</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <h1>Data Pegawai Restoran</h1>
    <p>Pengelolaan data Chef, Waiter, dan Kasir</p>

    <hr>

    <h2>Tambah Data Pegawai</h2>

    <form method="POST" action="{{ route('pegawai.store') }}">
        @csrf

        <label>Nama Pegawai:</label><br>
        <input type="text" name="nama_pegawai"
               placeholder="Masukkan nama" required>
        <br><br>

        <label>Nomor Kontak:</label><br>
        <input type="text" name="nomor_kontak"
               placeholder="Masukkan nomor kontak" required>
        <br><br>

        <label>Jabatan:</label>
        <select name="jabatan" required>
            <option value="">-- Pilih Jabatan --</option>
            <option value="Chef">Chef</option>
            <option value="Waiter">Waiter</option>
            <option value="Kasir">Kasir</option>
        </select>
        <br><br>

        <label>Status:</label>
        <select name="status" required>
            <option value="">-- Pilih Status --</option>
            <option value="Aktif">Aktif</option>
            <option value="Tidak Aktif">Tidak Aktif</option>
        </select>
        <br><br>

        <button type="submit">Tambah Pegawai</button>
        <button type="reset">Reset</button>
    </form>

    <hr>

    <h2>Daftar Pegawai</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Nomor Kontak</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @forelse ($pegawai as $no => $data)
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $data->nama_pegawai }}</td>
                <td>{{ $data->nomor_kontak }}</td>
                <td>{{ $data->jabatan }}</td>
                <td>{{ $data->status }}</td>
                <td>
                    <a href="{{ route('pegawai.edit', $data->id) }}">Edit</a>
                    <form action="{{ route('pegawai.destroy', $data->id) }}"
                            method="POST"
                            style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                onclick="return confirm('Yakin ingin menghapus data pegawai ini?')">
                            Hapus
                        </button>
                    </form>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="6">Belum ada data pegawai.</td>
            </tr>
        @endforelse
    </table>

</body>
</html>
