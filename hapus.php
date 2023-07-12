<?php
// include database connection file
include_once( "db_config.php" );

// Get id from URL to delete that user
if ( isset( $_POST[ 'id' ] ) )
{
    $id = $_POST[ 'id' ];
}
else
{
    // Handle the case where 'id' is not set
    header ( "Location:dashboard.php" );
}


// Delete user row from table based on given id
// $result = mysqli_query ( $mysqli, "DELETE FROM orang WHERE id = $id" );
$result = mysqli_query ( $conn, "DELETE FROM orang WHERE id = $id" );


// After delete redirect to Home, so that latest user list will be displayed.
header ( "Location:dashboard.php" );
?>