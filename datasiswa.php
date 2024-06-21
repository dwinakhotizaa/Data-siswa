<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head> 
<body>
    <h3 class="text-center fw-bold mt-4">DATA SISWA</h3>
    <form action="" method="POST">
        <div class="d-flex flex-row justify-content-center grid gap-3 position-relative hstack mt-4">
            <div>
                <label for="nama">Nama :</label><br>
                <input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan data"></input>
            </div>
            <div>
                <label for="nis">Nis :</label><br>
                <input class="form-control" type="text" name="nis" id="nis" placeholder="Masukan data"></input>
            </div>
            <div>
                <label for="rayon">Rayon :</label><br>
                <input class="form-control" type="text" name="rayon" id="rayon" placeholder="Masukan data"></input>
            </div>
            
            </div>
            <div class="button " style="margin-left: 335px;">
                <br><button style="width: 120px" class="btn btn-warning h-25 shadow" type="submit" name="kirim">Kirim</button>
            <button style="width: 120px" class="btn btn-success h-25 shadow" type="submit" name="reset">Reset</button>
        </div>
    </form>
    <br>
    <?php
//memulai session
session_start();


//jika array dimensi tidak ada, buat array terlebih dahulu
if (!isset($_SESSION['dataSiswa'])) {
    $_SESSION['dataSiswa'] = array();
}


// redirect
if (isset($_POST['reset'])) {
    session_unset();
    // 'header('Location : ' . $_SERVER['PHP_SELF']);
    //  exit;'
}

// proses button hapus pada tampil data
if (isset($_GET['hapus'])) {
    $index = $_GET['hapus'];
    unset($_SESSION['dataSiswa'][$index]);
}

// pengecekan input semua harus sudah terisi

if (isset($_POST['kirim'])) {
    if (@$_POST['nama'] && @$_POST['nis'] && @$_POST['rayon']) {
        // Pengecekan jika nama siswa sudah ada sebelumnya
        $nis_siswa = $_POST['nis'];
        $siswa_exist = false;
        foreach ($_SESSION['dataSiswa'] as $siswa) {
            if ($siswa['nis'] == $nis_siswa) {
                $siswa_exist = true;
                break;
            }
        }

        // Jika nama siswa sudah ada, tampilkan pesan kesalahan
        if ($siswa_exist) {
            echo "<p class='text-center fw-bold text-danger'>Nis siswa yang sama sudah ada.</p><br>";
        } else {
            // Tambahkan siswa ke dalam session jika tidak ada nama yang sama
            $data = [
                'nama' => $_POST['nama'],
                'nis' => $_POST['nis'],
                'rayon' => $_POST['rayon']
            ];
            array_push($_SESSION['dataSiswa'], $data);
        }
    } else {
        echo "<p class='text-center fw-bold text-danger'>Data Belum Lengkap</p><br>";
    }
}

// var_dump($_SESSION)

//menampilkan data dengan tabel
if(!empty($_SESSION['dataSiswa'])){
    echo '<table class="table table-hover w-50 mt-4 ms-auto me-auto">';
    echo '<thead class="table-secondary">
            <tr>
                <th>NAMA</th>
                <th>NIS</th>
                <th>RAYON</th>
                <th>AKSI</th>
            </tr>
        </thead>';
        foreach ($_SESSION['dataSiswa'] as $index => $value) {
            echo '<tr>';
            echo '<td scope="row">' . $value['nama'] . '</td>';
            echo '<td>' . $value['nis'] . '</td>';
            echo '<td>' . $value['rayon'] . '</td>';
            echo '<td><a style="width: 120px" class="btn btn-danger h-25 shadow" href="?hapus=' . $index . '">Hapus</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>