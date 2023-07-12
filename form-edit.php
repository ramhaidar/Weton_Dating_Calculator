<?php
// include database connection file
include_once( "db_config.php" );

$conn = mysqli_connect ( "localhost", "root", "", "weton_jodoh" );

// Check if form is submitted for user update, then redirect to homepage after update
if ( isset( $_POST[ 'update' ] ) )
{
    $id           = $_POST[ 'id' ];
    $name         = $_POST[ 'nama' ];
    $neptuhari    = $_POST[ 'neptu_hari_id' ];
    $neptupasaran = $_POST[ 'neptu_pasaran' ];

    // update user data
    $result = mysqli_query ( $conn, "UPDATE orang SET nama = '$name', neptu_hari_id = '$neptuhari', neptu_pasaran = '$neptupasaran' WHERE id = $id" );

    // Redirect to homepage to display updated user in list
    header ( "Location: dashboard.php" );
}
else
{
    if ( isset( $_POST[ 'id' ] ) )
    {
        $id = $_POST[ 'id' ];
    }
    else
    {
        // Handle the case where 'id' is not set
        header ( "Location:dashboard.php" );
    }

    // Fetech user data based on id
    $result = mysqli_query ( $conn, "SELECT * FROM orang WHERE id=$id" );

    while ( $user_data = mysqli_fetch_array ( $result ) )
    {
        $name         = $user_data[ 'nama' ];
        $neptuhari    = $user_data[ 'neptu_hari_id' ];
        $neptupasaran = $user_data[ 'neptu_pasaran' ];
    }
}
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
            <form name="update" method="POST" action="">
                <table class="table">
                    <tr>
                        <td><label for="nama" class="form-label">Nama</label></td>
                        <td>
                            <input required type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                value="<?php echo $name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Neptu Hari</td>
                        <td>
                            <select class="form-select" name="neptu_hari_id">
                                <?php
                                $query  = "SELECT * FROM neptu_hari";
                                $result = mysqli_query ( $conn, $query );
                                while ( $row = mysqli_fetch_assoc ( $result ) )
                                {
                                    $selected = ( $row[ 'id' ] == $neptuhari ) ? "selected" : "";
                                    echo "<option value='" . $row[ 'id' ] . "' " . $selected . ">" . $row[ 'nama' ] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Neptu Pasaran</td>
                        <td>
                            <select class="form-select" name="neptu_pasaran">
                                <?php
                                $query  = "SELECT * FROM neptu_pasaran";
                                $result = mysqli_query ( $conn, $query );
                                while ( $row = mysqli_fetch_assoc ( $result ) )
                                {
                                    $selected = ( $row[ 'id' ] == $neptupasaran ) ? "selected" : "";
                                    echo "<option value='" . $row[ 'id' ] . "' " . $selected . ">" . $row[ 'nama' ] . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value=<?php echo $id; ?>></td>
                        <td><button type="submit" name="update" class="btn btn-success">Update</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </main>


</body>

</html>