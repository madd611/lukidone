<?php
include("config.php");

$sql = "SELECT * FROM monitoring ORDER BY tanggal DESC";
$query = mysqli_query($db, $sql);
$no = 1;
while($value = mysqli_fetch_assoc($query)){
    echo "<tr>";
    echo "<td>".htmlspecialchars($no)."</td>";           
    echo "<td>".htmlspecialchars($value['ph'])."</td>";            
    echo "<td>".htmlspecialchars($value['suhu'])."</td>";            
    echo "<td>".htmlspecialchars($value['oksigen'])."</td>";
    echo "<td>".htmlspecialchars($value['salinitas'])."</td>";
    echo "<td>".htmlspecialchars($value['keruh'])."</td>";
    echo "<td>".htmlspecialchars($value['tanggal'])."</td>";                        
    echo "</tr>";
    $no++;
}
?>
