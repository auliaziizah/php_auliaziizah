<?php

$jml = $_GET['jml'];
echo "<table border=1 style='border-collapse:collapse;'>\n";
for ($a = $jml; $a > 0; $a--)
{
  $total = 0;
  for ($b = $a; $b > 0; $b--) {
    $total += $b;
  }
  echo "<tr><td colspan='$jml'>TOTAL: $total</td></tr>\n";
  echo "<tr>\n";
  for ($b = $a; $b > 0; $b--)
  {
    echo "<td>$b</td>";
  }
  
  echo "</tr>\n";
}
echo "</table>";

?>