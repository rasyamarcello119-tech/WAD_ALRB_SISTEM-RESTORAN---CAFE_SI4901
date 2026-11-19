<?php
// =============================================================
// tampilan/daftar_menu.php
// Tugas: menampilkan DAFTAR MENU per kategori + tombol Ubah/Hapus.
// Variabel yang dipakai (disiapkan di index.php): $grupMenu
// =============================================================
?>
<main>
  <?php foreach ($grupMenu as $namaKategori => $daftar): ?>
    <section>
      <h2><?= $namaKategori ?></h2>

      <?php if (empty($daftar)): ?>
        <p class="kosong">Belum ada menu <?= strtolower($namaKategori) ?>.</p>
      <?php endif; ?>

      <?php foreach ($daftar as $item): ?>
        <?php
          // Siapkan data tampilan untuk satu menu
          $sumberFoto = !empty($item["foto"])
              ? asset("uploads/" . basename($item["foto"]))
              : $fotoDefault($item["nama"], $item["kategori"]);

          $kelasHalal = $item["halal"] === "Halal" ? "badge-halal" : "badge-nonhalal";

          $teksAlergen = $item["alergen"] === "Tanpa alergen utama"
              ? "Tanpa alergen utama"
              : "Alergen: " . $item["alergen"];
        ?>
        <article>
          <img class="foto-menu" src="<?= e($sumberFoto) ?>" alt="<?= e($item["nama"]) ?>">

          <div class="detail-menu">
            <div class="baris-menu">
              <div class="kiri-menu">
                <h3 class="nama-menu"><?= e($item["nama"]) ?></h3>
                <span class="<?= $kelasHalal ?>"><?= e($item["halal"]) ?></span>
              </div>
              <span class="harga"><?= "Rp" . number_format($item["harga"], 0, ",", ".") ?></span>
            </div>

            <p class="deskripsi"><?= e($item["deskripsi"]) ?></p>

            <div class="baris-bawah">
              <small><?= e($teksAlergen) ?></small>

              @if (auth()->user()->isAdmin())
              <div class="grup-tombol">
                <!-- Ubah: buka index.php?edit=ID -->
                <a class="tombol-ubah" href="{{ route('menu.edit', $item['id']) }}#area-form">Ubah</a>

                <!-- Hapus: kirim ID ke hapus.php -->
                <form method="post" action="{{ route('menu.destroy', $item['id']) }}"
                      onsubmit="return confirm('Yakin hapus menu ini?');">
                  @csrf @method('DELETE') <input type="hidden" name="id" value="<?= (int) $item["id"] ?>">
                  <button class="tombol-hapus" type="submit">Hapus</button>
                </form>
              </div>
              @endif
            </div>
          </div>
        </article>
      <?php endforeach; ?>

    </section>
  <?php endforeach; ?>
</main>

