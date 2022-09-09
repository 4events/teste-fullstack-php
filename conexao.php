<?php

$usuario="root";
$senha= "";
$database= "veiculos_4.events";
$host= "localhost";

$mysqli= new mysqli($host,$usuario,$senha,$database);
//condiçao
if($mysqli->error){die ("falha ao conectar ao banco de dados: ". $mysqli->error);
}


?>