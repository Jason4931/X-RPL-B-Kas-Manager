<?php
$home = "";
$pinjam = "";
$daftar = "";
$histori = "";
if ($_SESSION["Active"] == "home") {
  $home = "active";
} else if ($_SESSION["Active"] == "pinjam") {
  $pinjam = "active";
} else if ($_SESSION["Active"] == "daftar") {
  $daftar = "active";
} else if ($_SESSION["Active"] == "histori") {
  $histori = "active";
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link <?= $home ?>" href="./?menu=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn bg-success-subtle <?= $pinjam ?>" href="./?menu=pinjam">Pinjam Kas</a>
        </li>
        <?php if ($_SESSION['Akses'] == "Supervisor") { ?>
          <li class="nav-item ms-lg-4">
            <a class="nav-link <?= $daftar ?> ms-lg-4 btn bg-warning-subtle" href="./?menu=daftar">Daftar Pinjaman</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= $histori ?>" href="./?menu=histori">Histori</a>
          </li>
        <?php } ?>
      </ul>
      <div class="d-flex">
        <span class="mx-2 text-end"><a href="#" style="text-decoration:none"><?= $_SESSION["Username"] ?></a><a href="./?logout" class="nav-link">Logout</a></span>
      </div>
    </div>
  </div>
</nav>