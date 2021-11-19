<?php
$carros = [];
foreach ($veiculos as $veiculo) {
    $arrayCarro = [
            "id"=> $veiculo->recuperaId(),
            "marca"=> $veiculo->recuperaMarca(),
            "veiculo"=> $veiculo->recuperaVeiculo(),
            "descricao"=> $veiculo->recuperaDescricao(),
            "ano"=>$veiculo->recuperaAno()
    ];
    $carros[] = $arrayCarro;
}
echo json_encode($carros);
?>

