<?php
// =============================================================
// tampilan/form.php
// Tugas: menampilkan FORM tambah / ubah menu.
// Variabel yang dipakai (disiapkan di index.php):
//   $menuEdit, $isiForm, $pesan, $kategoriValid, $halalValid
// =============================================================
?>
@if ($errors->any()) <div class="pesan-gagal" role="alert"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div> @endif <div class="kotak-form" id="area-form">

  <h3 class="judul-form">
    <?php if ($menuEdit): ?>
      Ubah Menu: <?= e($menuEdit["nama"]) ?>
    <?php else: ?>
      Tambah Menu Baru
    <?php endif; ?>
  </h3>

  <!-- Data form dikirim ke simpan.php -->
  <form method="post" action="{{ $menuEdit ? route('menu.update', $menuEdit['id']) : route('menu.store') }}" enctype="multipart/form-data">
    @csrf @if ($menuEdit) @method('PUT') @endif <input type="hidden" name="id" value="<?= (int) $isiForm["id"] ?>">

    <div class="baris-input">
      <div class="grup-input">
        <label for="input-nama">Nama Menu *</label>
        <input type="text" id="input-nama" name="nama" maxlength="100"
               placeholder="Contoh: Nasi Goreng Spesial"
               value="<?= e(old("nama", $isiForm["nama"])) ?>" required>
      </div>

      <div class="grup-input">
        <label for="input-kategori">Kategori *</label>
        <select id="input-kategori" name="kategori">
          <?php foreach ($kategoriValid as $k): ?>
            <option value="<?= $k ?>" <?= old("kategori", $isiForm["kategori"]) === $k ? "selected" : "" ?>>
              <?= $k ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="grup-input">
        <label for="input-harga">Harga (Rp) *</label>
        <input type="number" id="input-harga" name="harga" min="0"
               placeholder="Contoh: 25000"
               value="<?= e(old("harga", $isiForm["harga"])) ?>" required>
      </div>
    </div>

    <div class="baris-input">
      <div class="grup-input">
        <label for="input-alergen">Indikator Alergen</label>
        <input type="text" id="input-alergen" name="alergen" maxlength="150"
               placeholder="Contoh: telur, kedelai (kosongkan jika tidak ada)"
               value="<?= e(old("alergen", $isiForm["alergen"])) ?>">
      </div>

      <div class="grup-input">
        <label for="input-halal">Status Halal *</label>
        <select id="input-halal" name="halal">
          <?php foreach ($halalValid as $h): ?>
            <option value="<?= $h ?>" <?= old("halal", $isiForm["halal"]) === $h ? "selected" : "" ?>>
              <?= $h ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="grup-input">
        <label for="input-foto">Foto Menu (Opsional)</label>
        <input type="file" id="input-foto" name="foto" accept="image/*">
      </div>
    </div>

    <div class="baris-input">
      <div class="grup-input">
        <label for="input-deskripsi">Deskripsi Menu *</label>
        <textarea id="input-deskripsi" name="deskripsi"
                  placeholder="Tulis penjelasan singkat mengenai menu ini..."
                  required><?= e(old("deskripsi", $isiForm["deskripsi"])) ?></textarea>
      </div>
    </div>

    <div class="aksi-form">
      <button type="submit" class="tombol-simpan">
        <?= $menuEdit ? "Simpan Perubahan" : "+ Tambah Menu" ?>
      </button>

      <?php if ($menuEdit): ?>
        <a href="{{ route('menu.index') }}" class="tombol-batal">Batal Ubah</a>
      <?php endif; ?>

      <?php if ($pesan): ?>
        <span id="pesan-status" class="pesan-status <?= $pesan["tipe"] === "gagal" ? "pesan-gagal" : "" ?>">
          <?= e($pesan["teks"]) ?>
        </span>
      <?php endif; ?>
    </div>
  </form>
</div>

