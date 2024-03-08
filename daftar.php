<?php
$sql = "SELECT * FROM `laporan` WHERE `Accept`='False' ORDER BY `Hari` DESC";
$result = $conn->query($sql);
if (isset($_GET['delete'])) {
  $sql2 = "DELETE FROM `laporan` WHERE `ID`='$_GET[delete]'";
  $result2 = $conn->query($sql2);
  if ($result2) {
    header("location: ./?menu=daftar");
  } else {
    header("location: ./?menu=daftar");
  }
}
$sqlall = "SELECT * FROM `laporan`";
$resultall = $conn->query($sqlall);
if (isset($_GET['done'])) {
  if (mysqli_num_rows($resultall) > 0) {
    while ($row = $resultall->fetch_assoc()) {
      if ($row["Keterangan"] = "Kembalian") {
        $sqlupdate = "SELECT * FROM `laporan` WHERE `Nama`='$row[Nama]' AND `Tujuan`='$row[Tujuan]' AND `Hari`='$row[Tglkembalian]'";
        $resultupdate = $conn->query($sqlupdate);
        if (mysqli_num_rows($resultupdate) > 0) {
          while ($rowupdate = $resultupdate->fetch_assoc()) {
            $kembalian = $row['Uang'] + $rowupdate['Kembalian'];
            $sql2 = "UPDATE `laporan` SET `Kembalian`='$kembalian' WHERE `Nama`='$row[Nama]' AND `Tujuan`='$row[Tujuan]' AND `Hari`='$row[Tglkembalian]'";
            $sql3 = "DELETE FROM `laporan` WHERE `ID`='$_GET[done]'";
          }
        }
      } else {
        $sql2 = "UPDATE `laporan` SET `Accept`='True' WHERE `ID`='$_GET[done]'";
      }
    }
  }
  if (!isset($sql3)) {
    $sql3 = "SELECT * FROM `laporan`";
  }
  $result2 = $conn->query($sql2);
  $result3 = $conn->query($sql3);
  if ($result2 && $result3) {
    header("location: ./?menu=daftar");
  } else {
    header("location: ./?menu=daftar");
  }
}
?>

<body>
  <?php include "nav.php"; ?>
  <div class="card m-3">
    <div class="card-body m-3">
      <h5 class="card-title" style="color:#0891C0">Daftar Pinjam / Hutang</h5>
      <p class="card-text" style="text-align: justify;">
        <?php if (mysqli_num_rows($result) > 0) {
          while ($row = $result->fetch_assoc()) {
        ?>
      <div class="row my-1 mt-3">
        <div class="col-lg-10 col-md-10 col-sm-9 col-8">
          <?php echo $row["Hari"] . " ⠀" . $row["Jam"] . "<br>";
            echo $row["Nama"] . " " . $row["Keterangan"] . " - " . $row["Tujuan"] . "<br>";
            echo "<b>" . $row["Uang"] . "</b><br>"; ?>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3 col-4">
          <?php echo "<a class='btn btn-success btn-sm w-100' href='./?menu=daftar&done=" . $row['ID'] . "'>Done</a>"; ?>
          <?php echo "<a class='btn btn-danger btn-sm w-100 mt-1' href='./?menu=daftar&delete=" . $row['ID'] . "'>Delete</a>"; ?>
        </div>
      </div>
  <?php }
        } ?>
  </p>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>