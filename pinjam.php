<?php
if (isset($_POST["pinjam"])) {
    $jam = date("H:i:s");
    $hari = date("Y-m-d");
    if (strtolower($_POST['keterangan']) == "p" || strtolower($_POST['keterangan']) == "pinjam") {
        $_POST['keterangan'] = "Pinjam";
    } else if (strtolower($_POST['keterangan']) == "h" || strtolower($_POST['keterangan']) == "hutang") {
        $_POST['keterangan'] = "Hutang";
    } else if (strtolower($_POST['keterangan']) == "k" || strtolower($_POST['keterangan']) == "kembalian") {
        $_POST['keterangan'] = "Kembalian";
    } else if (strtolower($_POST['keterangan']) == "kas") {
        $_POST['keterangan'] = "Kas";
    } else {
        $_POST['keterangan'] = "Bruh WDYM";
    }
    if ($_POST['keterangan'] != "Bruh WDYM" && $_POST['keterangan'] != "Kembalian" && $_POST['keterangan'] != "Kas") {
        $sql2 = "INSERT INTO `laporan` (`Nama`, `Keterangan`, `Uang`, `Tujuan`, `Jam`, `Hari`) VALUES ('$_POST[nama]', '$_POST[keterangan]', '$_POST[uang]', '$_POST[tujuan]', '$jam', '$hari')";
    } else if ($_POST['keterangan'] == "Kembalian") {
        if ($_POST["tanggal"] == "") {
            $_POST['keterangan'] = "kembali";
            echo '<script>alert("Tanggal Pinjam/Hutang untuk kembalian tidak sesuai format!");</script>';
        } else {
            $sqlk = "SELECT * FROM `laporan` WHERE `Nama`='$_POST[nama]' AND `Tujuan`='$_POST[tujuan]'";
            $resultk = $conn->query($sqlk);
            if (mysqli_num_rows($resultk) > 0) {
                while ($row = $resultk->fetch_assoc()) {
                    if ($_POST["uang"] > ($row["Uang"] - $row["Kembalian"])) {
                        $_POST['keterangan'] = "kembali";
                        echo '<script>alert("Kembalian berlebihan, mohon cek ulang!");</script>';
                    }
                    if ($_POST['keterangan'] != "kembali") {
                        $sql2 = "INSERT INTO `laporan` (`Nama`, `Keterangan`, `Uang`, `Tujuan`, `Jam`, `Hari`, `Tglkembalian`) VALUES ('$_POST[nama]', '$_POST[keterangan]', '$_POST[uang]', '$_POST[tujuan]', '$jam', '$hari', '$_POST[tanggal]')";
                        // $sql2 = "UPDATE `laporan` SET `Kembalian`='$_POST[uang]' WHERE `Nama`='$_POST[nama]' AND `Tujuan`='$_POST[tujuan]' AND `Tglkembalian`='$_POST[tanggal]'";
                    }
                }
            } else {
                $_POST['keterangan'] = "kembali";
                echo '<script>alert("Tidak ada Nama&Tujuan&Tanggal yang dikembalikan!");</script>';
            }
        }
    } else if ($_POST['keterangan'] == "Kas") {
        $sql2 = "INSERT INTO `laporan` (`Keterangan`, `Accept`, `Uang`, `Jam`, `Hari`) VALUES ('$_POST[keterangan]', 'True', '$_POST[uang]', '$jam', '$hari')";
    } else if ($_POST['keterangan'] == "Bruh WDYM") {
        echo '<script>alert("Keterangan kurang jelas, mohon absen lagi!");</script>';
    }
    if (!isset($sql2)) {
        $sql2 = "SELECT * FROM `laporan`";
    }
    $result2 = $conn->query($sql2);
    if ($result2 && $_POST['keterangan'] != "Bruh WDYM" && $_POST['keterangan'] != "kembali") {
        header('location: ./?menu=pinjam');
    }
}
?>

<body>
    <?php include "nav.php"; ?>
    <div class="card m-3">
        <div class="card-body m-3">
            <div style="color:#555566">
                <h2>Pinjam Kas</h2>
                <b><?php if (date("l") == "Sunday") {
                        echo "Minggu ";
                    } else if (date("l") == "Monday") {
                        echo "Senin ";
                    } else if (date("l") == "Tuesday") {
                        echo "Selasa ";
                    } else if (date("l") == "Wednesday") {
                        echo "Rabu ";
                    } else if (date("l") == "Thursday") {
                        echo "Kamis ";
                    } else if (date("l") == "Friday") {
                        echo "Jumat ";
                    } else if (date("l") == "Saturday") {
                        echo "Sabtu ";
                    } ?></b><?php
                            echo date("j F Y / h:i A");
                            $kas = "";
                            if ($_SESSION['Akses'] == "Supervisor") {
                                $kas = " / Kas";
                            } ?>
            </div>
            <hr>
            <form action="" method="post" class="row">
                <p style="color:orange" class="btn bg-warning-subtle mt-2">Keterangan 🡒 Pinjam / Hutang / Kembalian<?= $kas ?></p>
                <div class="col-lg-2 col-md-3 col-sm-12 col-12">
                    <label class="form-label py-1"> Absen Nama: </label>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-6">
                    <input class="form-control" type="text" name="nama" placeholder="Nama" required>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-6 col-6">
                    <input id="keterangan" onchange="kembali()" class="form-control" type="text" name="keterangan" placeholder="Keterangan" required>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <input class="form-control" type="number" name="uang" placeholder="Banyak Uang" required>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-6 col-12">
                    <input class="form-control" type="text" name="tujuan" placeholder="Tujuan" required>
                </div>
                <div>
                    <input id="tanggal" type="date" name="tanggal" hidden>
                </div>
                <div class="col-12 mt-2">
                    <input class="btn bg-primary text-white w-100" type="submit" name="pinjam" value="Submit"><br>
                </div>
            </form><br>
        </div>
    </div>
    <script>
        function kembali() {
            let keterangan = document.getElementById('keterangan').value;
            if (keterangan.toLowerCase() == "k" || keterangan.toLowerCase() == "kembalian") {
                let date = "";
                while (date == "" || date == null) {
                    date = window.prompt("Kembalian > Tanggal Pinjam/Hutang? (Format:yyyy-mm-dd)");
                }
                document.getElementById('tanggal').value = date;
            }
        }
    </script>
</body>

</html>