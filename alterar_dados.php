<?php
require 'conexao.php';

$cod_veiculo=$_POST ["id_veiculo"];
$veiculo= $_POST ['veiculo'];
$ano= $_POST ["ano"];
$descricao= $_POST ["descricao"];
$vendido= $_POST ["vendido"];
$created= $_POST ["created"];

$sql= "UPDATE veiculos set veiculo='$veiculos',ano=
'$ano',descricao='$descricao',vendido='$vendido',created='$created' where id='$cod_veiculos'";

$mysqli->query($sql);
if($mysqli == true) 
{echo "Alterado com sucesso";}
else {echo"erro ao alterar";}

?>

<a href="listar.php"><button>voltar</button></a>
