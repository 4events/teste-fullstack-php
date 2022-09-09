excluir
<?php 
require 'conexao.php';
$cod_veiculo = $_GET['id_veiculo'];

$sql="delete from veiculos where id_veiculo= $cod_veiculo";


$mysqli->query($sql);
if($mysqli == true) 
{echo "excluido com sucesso";}
else {echo"erro ao excluir";}

?>

<a href="listar.php"><button>voltar</button></a>