<?php
$sql = "SELECT * FROM `laporan` WHERE `Accept`='True' ORDER BY `Hari` DESC";
if (isset($_GET['pinjam'])) {
  $sql = "SELECT * FROM `laporan` WHERE `Accept`='True' AND `Keterangan`='Pinjam' ORDER BY `Hari` DESC";
} else if (isset($_GET['hutang'])) {
  $sql = "SELECT * FROM `laporan` WHERE `Accept`='True' AND `Keterangan`='Hutang' ORDER BY `Hari` DESC";
} else if (isset($_GET['uangkecil'])) {
  $sql = "SELECT * FROM `laporan` WHERE `Accept`='True' AND (`Uang`-`Kembalian`)<100000 ORDER BY `Hari` DESC";
} else if (isset($_GET['uangbesar'])) {
  $sql = "SELECT * FROM `laporan` WHERE `Accept`='True' AND (`Uang`-`Kembalian`)>=100000 ORDER BY `Hari` DESC";
} else if (isset($_GET['kas'])) {
  $sql = "SELECT * FROM `laporan` WHERE `Accept`='True' AND `Keterangan`='Kas' ORDER BY `Hari` DESC";
}
$result = $conn->query($sql);
?>

<body>
  <?php include "nav.php"; ?>
  <div class="card m-3">
    <div class="card-body m-3">
      <h4 class="card-title" style="color:#0891C0">Histori</h4>
      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Filter</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="./?menu=histori">All</a>
          <a href="./?menu=histori&pinjam">Pinjam</a>
          <a href="./?menu=histori&hutang">Hutang</a>
          <a href="./?menu=histori&uangkecil">Uang Kecil</a>
          <a href="./?menu=histori&uangbesar">Uang Besar</a>
          <a href="./?menu=histori&kas" style="background-color:#99ff99">Kas</a>
        </div>
      </div>
      <hr>
      <p class="card-text" style="text-align: justify;">
        <?php if (mysqli_num_rows($result) > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
      <div class="mt-2"><?php
                        if ($row["Keterangan"] == "Kas") {
                          echo $row["Hari"] . " ⠀ " . $row["Jam"] . "<br>";
                          echo $row["Keterangan"] . " ⠀ ";
                          echo "<b>+" . $row["Uang"] . "</b><br>";
                        } else if ($row["Kembalian"] != 0) {
                          echo $row["Hari"] . " ⠀ " . $row["Jam"] . "<br>";
                          echo $row["Nama"] . " " . $row["Keterangan"] . " - " . $row["Tujuan"] . "<br>";
                          echo "<b>" . ($row["Uang"] - $row["Kembalian"]) . " <a style='color:darkblue'>(" . $row["Uang"] . "-" . $row["Kembalian"] . ")</a></b><br>";
                        } else {
                          echo $row["Hari"] . " ⠀ " . $row["Jam"] . "<br>";
                          echo $row["Nama"] . " " . $row["Keterangan"] . " - " . $row["Tujuan"] . "<br>";
                          echo "<b>" . $row["Uang"] . "</b><br>";
                        }
                      }
                    } ?>
    </p>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
      function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      }
      window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
              openDropdown.classList.remove('show');
            }
          }
        }
      }
    </script>
</body>

</html>