<?php
include(__DIR__ . "/../db_connection.php");

$sql = "SELECT * FROM refunds";
$result = $conn_integration->query($sql);
$rowNumber = $result->num_rows;

if($rowNumber>0){
    while($row = $result->fetch_assoc()){
       // $id = $row['user_id'];
        echo "<option value='{$row['id']}'>{$row['id']}</option>";
    }
}
?>