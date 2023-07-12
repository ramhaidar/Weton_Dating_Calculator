<?php
// include database connection file
include_once( "db_config.php" );

// CREATE
if ( isset( $_POST[ 'create' ] ) )
{
    $nama          = $_POST[ 'nama' ];
    $neptu_hari    = $_POST[ 'neptu_hari' ];
    $neptu_pasaran = $_POST[ 'neptu_pasaran' ];

    $conn = mysqli_connect ( "localhost", "root", "", "weton_jodoh" );

    if ( ! $conn )
    {
        die( "Connection failed: " . mysqli_connect_error () );
    }

    $sql = "INSERT INTO orang (nama, neptu_hari_id, neptu_pasaran) VALUES (?, ?, ?)";

    $stmt = mysqli_prepare ( $conn, $sql );

    mysqli_stmt_bind_param ( $stmt, "sii", $nama, $neptu_hari, $neptu_pasaran );

    if ( mysqli_stmt_execute ( $stmt ) )
    {
        $_SESSION[ 'message' ] = "Orang Berhasil Ditambahkan.";
    }
    else
    {
        echo "Error: " . mysqli_stmt_error ( $stmt );
    }

    mysqli_stmt_close ( $stmt );
}

mysqli_close ( $conn );
?>

<!DOCTYPE html>
<html lang='en' data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Weton Jodoh</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand text-primary fw-bold" href="index.php">Weton Jodoh</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-success fw-semibold" href="tambah_orang.php">Tambah Orang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="hitung_weton.php">Hitung Weton</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="bg-body-tertiary p-5 rounded">
            <h1>Menu Tambah Orang</h1>
            <?php
            if ( isset( $_SESSION[ 'message' ] ) )
            {
                echo '<div class="alert alert-success" role="alert">' . $_SESSION[ 'message' ] . '</div>';

                unset( $_SESSION[ 'message' ] );
            }
            ?>

            <br>

            <form method="POST" action="">

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input required type="text" class="form-control" id="nama" name="nama" autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="neptu_hari" class="form-label">Neptu Hari</label>
                    <select required class="form-control form-select" name="neptu_hari" id="neptu_hari">
                        <option selected value="">Pilih salah satu</option>
                        <option value="3">Minggu</option>
                        <option value="4">Senin</option>
                        <option value="5">Selasa</option>
                        <option value="6">Rabu</option>
                        <option value="7">Kamis</option>
                        <option value="8">Jumat</option>
                        <option value="9">Sabtu</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="neptu_pasaran" class="form-label">Neptu Pasaran</label>
                    <select required class="form-control form-select" id="neptu_pasaran" name="neptu_pasaran">
                        <option selected value="">Pilih salah satu</option>
                        <option value="4">Wage</option>
                        <option value="5">Kliwon</option>
                        <option value="8">Legi</option>
                        <option value="9">Pahing</option>
                        <option value="7">Pon</option>
                    </select>
                </div>

                <button type="submit" name="create" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>