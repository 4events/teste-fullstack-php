<?php 
$cod_veiculo = $_GET['id_veiculo'];

require 'conexao.php';

$sql="select * from veiculos where id_veiculo= $cod_veiculo";

$mysqli->query($sql);
$result = mysqli_query($mysqli,$sql);
$dados= mysqli_fetch_assoc($result);

$cod_veiculo= $dados ['id_veiculo'];
$veiculo= $dados ['veiculo'];
$ano= $dados ['ano'];
$descricao= $dados ['descricao'];
$vendido= $dados ['vendido'];
$created= $dados['created'];
?>

<form action="alterar_dados.php" method="POST">
<label>cod_Veiculo</label>
<input type="text" readonly id= "Cod_veiculo" name="id_veiculo" 
value="<?php echo $cod_veiculo?>"><br>
<label>veiculo</label>
<input type="text" name="veiculo" 
value="<?php echo $veiculo?>"><br>
<label>ano</label>
<input type="date" name="ano" 
value="<?php echo $ano?>"><br>
<label>Descricao</label>
<input type="text" name="descricao" 
value="<?php echo $descricao?>"><br>
<label>Vendido</label>
<input type="text" name="vendido" 
value="<?php echo $vendido?>"><br>
<label>Created</label>
<input type="text" name="created" 
value="<?php echo $created?>"><br>
<div class="mb-3"><button type="submit" class="btn btn-primary">Alterar</button></div>
