<?php
$serverName = "KOMP1\SQLEXPRESS";
$connectionInfo = array("Database" => "chemestry", "UID" => "sa", "PWD" => "samara80", "CharacterSet" => "UTF-8", "Encrypt" => false);
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn === false) {
  die;
}
$tsql = 'SELECT distinct substance
  FROM chemestry.dbo.Formuls';
$arr = array();
$arr1 = array();
$stmt = sqlsrv_query($conn, $tsql);
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  $arr1[] = $row["substance"];
}
for ($i = 0; $i < count($arr1); $i++) {
  $tsql = 'SELECT COUNT(*) as numb
  FROM chemestry.dbo.Formuls where substance=\'' . $arr1[$i] . '\' and element=\'Carbon\';';
  $arr_c = array();
  $stmt = sqlsrv_query($conn, $tsql);
  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $arr_c[] = $row["numb"];
  }
  $tsql = 'SELECT COUNT(*) as numb
  FROM chemestry.dbo.Formuls where substance=\'' . $arr1[$i] . '\' and element=\'Hydrogen\';';
  $arr_h = array();
  $stmt = sqlsrv_query($conn, $tsql);
  while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $arr_h[] = $row["numb"];
  }
  $arr[] = $arr1[$i];
  $arr[] = $arr_c;
  $arr[] = $arr_h;
}
echo json_encode($arr);
?>