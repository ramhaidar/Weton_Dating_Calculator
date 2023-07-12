<?php
// include database connection file
include_once( "db_config.php" );

$result = mysqli_query ( $conn, "SELECT * FROM orang ORDER BY id DESC" );

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
                        <a class="nav-link active text-success fw-semibold" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tambah_orang.php">Tambah Orang</a>
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
            <h1>Menu Dashboard</h1>
            <br>

            <?php
            $sql   = "SELECT * FROM orang";
            $query = mysqli_query ( $conn, $sql );
            if ( mysqli_num_rows ( $query ) == 0 )
            {
                echo '<div class="alert alert-danger" role="alert">Data kosong! Tambahkan data di <a href="tambah_orang.php">sini</a> terlebih dahulu!</div>';
            }
            else
            {
                while ( $orang = mysqli_fetch_array ( $query ) )
                {
                    echo '<table class="table">';
                    echo '    <thead>';
                    echo '        <tr>';
                    echo '            <th>No</th>';
                    echo '            <th>Nama</th>';
                    echo '            <th>Neptu Hari</th>';
                    echo '            <th>Neptu Pasaran</th>';
                    echo '            <th>Tindakan</th>';
                    echo '        </tr>';
                    echo '    </thead>';
                    echo '    <tbody>';

                    $sql   = "SELECT * FROM orang";
                    $query = mysqli_query ( $conn, $sql );

                    while ( $orang = mysqli_fetch_array ( $query ) )
                    {
                        $neptu_hari_id = $orang[ 'neptu_hari_id' ];
                        $neptu_pasaran = $orang[ 'neptu_pasaran' ];

                        $hari_query  = "SELECT nama FROM neptu_hari WHERE id=$neptu_hari_id";
                        $hari_result = mysqli_query ( $conn, $hari_query );
                        $hari_row    = mysqli_fetch_assoc ( $hari_result );
                        $hari_nama   = $hari_row[ 'nama' ];

                        $pasaran_query  = "SELECT nama FROM neptu_pasaran WHERE id=$neptu_pasaran";
                        $pasaran_result = mysqli_query ( $conn, $pasaran_query );
                        $pasaran_row    = mysqli_fetch_assoc ( $pasaran_result );
                        $pasaran_nama   = $pasaran_row[ 'nama' ];

                        echo "<tr>";
                        echo "<td>" . $orang[ 'id' ] . "</td>";
                        echo "<td>" . $orang[ 'nama' ] . "</td>";
                        echo "<td>" . $hari_nama . "</td>";
                        echo "<td>" . $pasaran_nama . "</td>";
                        echo "<td>";
                        echo "<form action='form-edit.php' method='post' style='display: inline-block;'>";
                        echo "<input type='hidden' name='id' value='" . $orang[ 'id' ] . "'>";
                        // echo "<input type='submit' value='Edit'>";
                        echo '<button type="submit" name="hitung" class="btn btn-secondary mx-1">Edit</button>';
                        echo "</form>";
                        echo "<form action='hapus.php' method='post' style='display: inline-block;'>";
                        echo "<input type='hidden' name='id' value='" . $orang[ 'id' ] . "'>";
                        // echo "<input type='submit' value='Hapus'>";
                        echo '<button type="submit" name="hitung" class="btn btn-danger mx-1">Hapus</button>';
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    echo '    </tbody>';
                    echo '</table>';
                }

            }
            ?>


        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
</body>

</html>