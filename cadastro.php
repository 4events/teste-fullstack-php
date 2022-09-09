<?php
include("conexao.php");

$veiculo=$_POST['veiculo'];
$ano=$_POST['ano'];
$descricao=$_POST['descricao'];
$vendido=$_POST['vendido'];
$created=$_POST['created'];

$sql=" INSERT INTO veiculos (veiculo,ano,descricao,vendido,created) VALUES ('$veiculo','$ano','$descricao','$vendido','$created')";
$mysqli->query($sql);
if($mysqli == true) 
{echo "Cadastro realizado com sucesso";}
else {echo"erro ao realizar cadastro";}

?>
<!--link Java -->
<link rel="stylesheet" href="css/bootstrap.rtl.min.css">
<a href="form.php"><div class="mb-3"><button type="submit" class="btn btn-primary">Voltar</button></div>
</div></a></p>
