
<?php
require 'conexao.php';?>

<!--bootstrap-->
<!doctype html>
<html lang="pt-BR" dir="">
  <head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
    <meta name="viewport" 
    content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.rtl.min.css">

    <title>4.Events</title>
      </head>
      <body>
      <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">4.Events</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="form.php">Cadastrar Veiculo</a>
        </li>
        <li class="nav-item">
          
          <a class="nav-link" href="lista_veiculos.html" >Pesquisar Veiculos<svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
</svg></a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled"></a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<?php	


$sql="SELECT*FROM veiculos";
$result = mysqli_query($mysqli,$sql);
while ($dados= mysqli_fetch_assoc($result)) {

$cod_veiculo= $dados ['id_veiculo'];
$veiculo= $dados ['veiculo'];
$ano= $dados ['ano'];
$descricao= $dados ['descricao'];
$vendido= $dados ['vendido'];
$created= $dados['created'];

echo
"cod_veiculo: ". $cod_veiculo. "<br>".
"veiculo: ". $veiculo. "<br>".
"ano: ". $ano. "<br>".
"descricao: ". $descricao. "<br>".
"vendido: ". $vendido. "<br>".
"created: ". $created."<br>"."<br>"
;
?>
<a href="excluir.php?id_veiculo=<?php echo $cod_veiculo ?>"exc">
<button >excluir dados</button></a>
<a href="alterar.php?id_veiculo=<?php echo $cod_veiculo ?>"exc">
<button >Alterar dados</button> <br><hr></a>

<?php
}
?>
<a href="index.php?id=<?php echo $cod_veiculo ?>"exc">
<button >Home</button></a>
