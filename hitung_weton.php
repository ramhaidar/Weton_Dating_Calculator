<?php
// include database connection file
include_once( "db_config.php" );

// HITUNG
if ( isset( $_POST[ 'hitung' ] ) )
{
    $id_orang_pertama = $_POST[ 'orang_pertama' ];
    $id_orang_kedua   = $_POST[ 'orang_kedua' ];

    $conn = mysqli_connect ( "localhost", "root", "", "weton_jodoh" );

    if ( ! $conn )
    {
        die( "Connection failed: " . mysqli_connect_error () );
    }

    $sql1 = "SELECT nama, neptu_hari_id, neptu_pasaran FROM orang WHERE id = $id_orang_pertama;";
    $sql2 = "SELECT nama, neptu_hari_id, neptu_pasaran FROM orang WHERE id = $id_orang_kedua;";

    $result1 = mysqli_query ( $conn, $sql1 );
    $result2 = mysqli_query ( $conn, $sql2 );

    if ( $result1 and $result2 )
    {
        $row1 = mysqli_fetch_assoc ( $result1 );
        $row2 = mysqli_fetch_assoc ( $result2 );

        $_SESSION[ 'neptu_hari_id_pertama' ] = $row1[ 'neptu_hari_id' ];
        $_SESSION[ 'neptu_pasaran_pertama' ] = $row1[ 'neptu_pasaran' ];
        $_SESSION[ 'neptu_hari_id_kedua' ]   = $row2[ 'neptu_hari_id' ];
        $_SESSION[ 'neptu_pasaran_kedua' ]   = $row2[ 'neptu_pasaran' ];
        $_SESSION[ 'orang_pertama' ]         = $row1[ 'nama' ];
        $_SESSION[ 'orang_kedua' ]           = $row2[ 'nama' ];
    }
    else
    {
        echo "Query error: " . mysqli_error ( $conn );
    }
}

// READ
$sql         = "SELECT * FROM orang";
$result      = mysqli_query ( $conn, $sql );
$orang_array = array();

if ( $result->num_rows > 0 )
{
    while ( $row = $result->fetch_assoc () )
    {
        array_push ( $orang_array, $row );
    }
}

$sql   = "SELECT * FROM orang";
$query = mysqli_query ( $conn, $sql );

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
                        <a class="nav-link" href="tambah_orang.php">Tambah Orang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active text-success fw-semibold" href="hitung_weton.php">Hitung Weton</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="bg-body-tertiary p-5 rounded">
            <h1>Menu Hitung Weton</h1>
            <br>
            <?php
            if (
                isset( $_SESSION[ 'neptu_hari_id_pertama' ], $_SESSION[ 'neptu_pasaran_pertama' ], $_SESSION[ 'neptu_hari_id_kedua' ], $_SESSION[ 'neptu_pasaran_kedua' ] )
            )
            {
                $days    = [ 'Selasa', 'Senin', 'Minggu', 'Jumat', 'Rabu', 'Kamis', 'Sabtu' ];
                $pasaran = [ 'Wage', 'Legi', '', 'Pon', 'Kliwon', 'Pahing' ];

                $neptu_hari_id_pertama = $_SESSION[ 'neptu_hari_id_pertama' ];
                $neptu_pasaran_pertama = $_SESSION[ 'neptu_pasaran_pertama' ];
                $neptu_hari_id_kedua   = $_SESSION[ 'neptu_hari_id_kedua' ];
                $neptu_pasaran_kedua   = $_SESSION[ 'neptu_pasaran_kedua' ];
                $orang_pertama         = $_SESSION[ 'orang_pertama' ];
                $orang_kedua           = $_SESSION[ 'orang_kedua' ];

                $dayIndex_pertama     = $neptu_hari_id_pertama - 3;
                $dayIndex_kedua       = $neptu_hari_id_kedua - 3;
                $pasaranIndex_pertama = $neptu_pasaran_pertama - 4;
                $pasaranIndex_kedua   = $neptu_pasaran_kedua - 4;

                $total_neptu_pertama = $neptu_hari_id_pertama + $neptu_pasaran_pertama;
                $total_neptu_kedua   = $neptu_hari_id_kedua + $neptu_pasaran_kedua;
                $total_neptu_jodoh   = $total_neptu_pertama + $total_neptu_kedua;

                echo '<div class="container">';
                echo '    <table class="table table-dark table-hover">';
                echo '        <thead>';
                echo '            <tr>';
                echo '            </tr>';
                echo '        </thead>';
                echo '        <tbody>';
                echo '            <tr>';
                echo '                <td>';
                echo $orang_pertama;
                echo '                </td>';
                echo '                <td>';
                if ( array_key_exists ( $dayIndex_pertama, $days ) )
                {
                    echo '<p>Hari Lahir: ' . $days[ $dayIndex_pertama ] . '</p>';
                }
                if ( array_key_exists ( $pasaranIndex_pertama, $pasaran ) )
                {
                    echo '<p>Hari Pasaran: ' . $pasaran[ $pasaranIndex_pertama ] . '</p>';
                }
                echo '                </td>';
                echo '                <td>';
                echo '                    <p>Nilai Neptu: ';
                echo $neptu_hari_id_pertama;
                echo '                    </p>';
                echo '                    <p>Nilai Neptu: ';
                echo $neptu_pasaran_pertama;
                echo '                    </p>';
                echo '                    <p>Total Neptu: ';
                echo $total_neptu_pertama;
                echo '                    </p>';
                echo '                </td>';
                echo '            </tr>';
                echo '            <tr>';
                echo '                <td>';
                echo $orang_kedua;
                echo '                </td>';
                echo '                <td>';
                if ( array_key_exists ( $dayIndex_kedua, $days ) )
                {
                    echo '<p>Hari Lahir: ' . $days[ $dayIndex_kedua ] . '</p>';
                }
                if ( array_key_exists ( $pasaranIndex_kedua, $pasaran ) )
                {
                    echo '<p>Hari Pasaran: ' . $pasaran[ $pasaranIndex_kedua ] . '</p>';
                }
                echo '                </td>';
                echo '                <td>';
                echo '                    <p>Nilai Neptu: ';
                echo $neptu_hari_id_kedua;
                echo '                    </p>';
                echo '                    <p>Nilai Neptu: ';
                echo $neptu_pasaran_kedua;
                echo '                    </p>';
                echo '                    <p>Total Neptu: ';
                echo $total_neptu_kedua;
                echo '                    </p>';
                echo '                </td>';
                echo '            </tr>';
                echo '            <tr>';
                echo '                <td>Total Neptu Jodoh</td>';
                echo '                <td></td>';
                echo '                <td>';
                echo $total_neptu_jodoh;
                echo '                </td>';
                echo '            </tr>';
                echo '        </tbody>';
                echo '    </table>';
                echo '</div>';
            }
            ?>

            <?php

            unset( $_SESSION[ 'neptu_hari_id_pertama' ] );
            unset( $_SESSION[ 'neptu_pasaran_pertama' ] );
            unset( $_SESSION[ 'neptu_hari_id_kedua' ] );
            unset( $_SESSION[ 'neptu_pasaran_kedua' ] );
            ?>

            <?php
            if ( mysqli_num_rows ( $query ) == 0 )
            {
                echo '<div class="alert alert-danger" role="alert">Data kosong! Tambahkan data di <a href="tambah_orang.php">sini</a> terlebih dahulu!</div>';
            }
            else
            {
                echo '
        <form method="POST" action="">
            <div class="mb-3">
                <label for="orang_pertama" class="form-label">Orang Pertama</label>
                <select required class="form-control form-select" id="orang_pertama" name="orang_pertama">
                    <option value="" selected>Pilih orang pertama</option>';
                foreach ( $orang_array as $orang )
                {
                    echo '<option value="' . $orang[ 'id' ] . '">' . $orang[ 'nama' ] . '</option>';
                }
                echo '</select>
            </div>
            <div class="mb-3">
                <label for="orang_kedua" class="form-label">Orang Kedua</label>
                <select required class="form-control form-select" id="orang_kedua" name="orang_kedua">
                    <option value="" selected>Pilih orang kedua</option>';
                foreach ( $orang_array as $orang )
                {
                    echo '<option value="' . $orang[ 'id' ] . '">' . $orang[ 'nama' ] . '</option>';
                }
                echo '</select>
            </div>
            <button type="submit" name="hitung" class="btn btn-primary">Submit</button>
        </form>';
            }
            ?>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>