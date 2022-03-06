<?php 

require 'connection.php';

$result = mysqli_query($conn, "SELECT * FROM login WHERE DorP='Patient'");
$arr = mysqli_fetch_row($result);
// while($row = mysqli_fetch_row($result))
// {
//     array_push($arr,$row);
// }

echo json_encode($arr);

?>



