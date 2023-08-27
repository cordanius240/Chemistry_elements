<?php
$serverName = "KOMP1\SQLEXPRESS";
$connectionInfo = array("Database" => "chemestry", "UID" => "sa", "PWD" => "samara80", "CharacterSet" => "UTF-8", "Encrypt" => false);
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn === false) {
  die;
}
$tsql = 'SELECT *
  FROM chemestry.dbo.connection
  where substance=\'' . $_POST['substance'] . '\';';
$arr = array();
$stmt = sqlsrv_query($conn, $tsql);
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $arr[] = $row["id1"];
  $arr[] = $row["id2"];
}
echo json_encode($arr);
?>