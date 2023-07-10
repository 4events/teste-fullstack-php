<?php
$mysqli= new mysqli("localhost","root","","veiculos_4.events");


$cod_veiculo = mysqli_real_escape_string($mysqli, $_GET['id_veiculo']);
$veiculo = mysqli_real_escape_string($mysqli, $_GET['veiculo']);
$ano = mysqli_real_escape_string($mysqli, $_GET['ano']);


$result = mysqli_query($mysqli,"SELECT * FROM veiculos WHERE veiculo LIKE'%$veiculo%' ");



echo "<table border='1'>
<tr>
<th>cod_veiculo</th>
<th>veiculo</th>
<th>ano</th>
<th>descricao</th>
<th>vendido</th>
<th>created</th>
</tr>";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['id_veiculo'] . "</td>";
  echo "<td>" . $row['veiculo'] . "</td>";
  echo "<td>" . $row['ano'] . "</td>";
  echo "<td>" . $row['descricao'] . "</td>";
  echo "<td>" . $row['vendido'] . "</td>";
  echo "<td>" . $row['created'] . "</td>";
  echo "</tr>";
}

echo "</table>";
mysqli_close($mysqli);
echo "<br>";  
echo "<a href='lista_veiculos.html'>Voltar para a página anterior</a>";
echo "<br>"; 
echo "<a href='index.php'>Voltar para a página inicial</a>";
?> 