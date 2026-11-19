// =============================================================
// js/script.js
// Tugas: menghilangkan pesan status setelah 3 detik.
// =============================================================
var pesanStatus = document.getElementById("pesan-status");

if (pesanStatus) {
  setTimeout(function () {
    pesanStatus.textContent = "";
  }, 3000);
}
