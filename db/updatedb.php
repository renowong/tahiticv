<?php
include_once("../includes/global_vars.php");
$mysqli = new mysqli(HOST, DBUSER, DBPASSWORD, DB);


$file = fopen('tahiticv.sql', 'r');
print '<pre>';
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
}
$temp = '';
$count = 0;

while($line = fgets($file)) {
  if ((substr($line, 0, 2) != '--') && (substr($line, 0, 2) != '/*') && strlen($line) > 1) {
    $last = trim(substr($line, -2, 1));
    $temp .= trim(substr($line, 0, -1));
    if ($last == ';') {
      $mysqli->query($temp);
      $count++;
      $temp = '';
    }
  }
}
print mysql_error();
print "Total {$count} queries done\n";
print "Veuillez vous relogger sur tahiticv\n";
print '</pre>';
 ?>