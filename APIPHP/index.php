<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FULLSTACK CAR</title>
    <link rel="sortcut icon" href="./img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./Css/geral.css">
    <script type="text/javascript" src="./JavaScript/consumoAPI.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous">
    </script>
</head>
<body>
    <?php
        $response = file_get_contents('http://localhost/teste-fullstack-php/APIPHP/public_html/api/user/');
        $response = json_decode($response);
    ?>
    <div class="container">
        <div class="modalPosPost">
            <div class="infoPosPost">
                <p class="resultadoOp">Veículo inserido com sucesso!!</p>
                <button onclick="recarregaPag()">OK</button>
            </div>
        </div>
        <div class="modalNewCar">
            <div class="form_newCar" onchange="verifyInfos()">
                <p class="title_form">
                    Novo veículo
                </p>
                <div class="flex pb40">
                    <input type="text" class="d-none form_id">
                    <div class="w50">
                        Veículo* <br>
                        <input riquired class="w100_20" id="form_veiculo" maxlength="40" name="veiculo" type="text">
                    </div>
                    <div class="w50">
                        Marca* <br>
                        <input riquired class="w100" id="form_marca" maxlength="40" name="marca" type="text">
                    </div>
                </div>

                <div class="flex pb40">
                    <div class="w50">
                        Ano* <br>
                        <input type="number" max="2023" min="1800" riquired class="w100_20" id="form_ano" name="ano" type="text">
                    </div>
                    <div class="w50">
                        Vendido* <br>
                        <div class="switch__container">
                            <input id="switch-shadow" checked  class="switch switch--shadow" type="checkbox" /> 
                            <label id="form_vendido" for="switch-shadow"></label>
                        </div> 
                    </div>
                </div>

                <div class="w100 pb40">
                    Descrição* <br>
                    <textarea riquired maxlength="300" id="form_desc" name="descricao" rows="10"></textarea>
                </div>
                <div class="div_rev">
                    <input id="form_revisao" type="checkbox"> Revisei todas as informações!
                </div>
                

                <button onclick="closeModais()">FECHAR</button>
                <button style="background-color: red;" disabled class="btn_addOrUp_infos" onclick="updateOrInsertInfo('update')">CONCLUIR</button>                
            </div>
        </div>

        <div class="topo">
            <!-- <div class="titulo_topo">
                <img class="img_logo" src="./img/logo.png" alt="logo">
                <div class="txt_titulo_topo">FullStack</div>
            </div> -->
            <a class="titulo_topo" href="">
                <img class="img_logo" src="./img/logo.png" alt="logo">
                <div class="txt_titulo_topo">FullStack</div>
            </a>
            <div class="busca_topo">
                <input class="input_busca" name="busca" type="text" placeholder="Buscar veículo">
                <button class="btn_busca" onclick="buscarItem()"><img src="./img/busca.png" alt=""></button>
            </div>
        </div>

        <div class="middle">
            <h1 class="middle_title">Veículos</h1>
            <div class="adicionar">
                <button class="btn_add" onclick="openModalNewCar()">+ Adicionar veículo</button>
            </div>
        </div>
        <hr>
        
        <div class="conteudo">
            <div class="lista_veiculos">
                
                <h3 class="c_title">Lista de veículos</h3>
                <?php foreach($response->data as $v):?>
                    <div class="veiculo" onclick="listOne(<?= $v->id?>)">
                        <div class="veiculos_infos">
                            <p class="v_nome"><?= $v->marca?></p>
                            <p class="v_info"><?= $v->nome?></p>
                            <p class="v_ano"><?= $v->ano?></p>
                        </div>
                        <div class="veiculos_img">
                            <?php if($v->vendido == 1):?>
                                <img src="./img/vendido.png" alt="">
                            <?php else:?>
                                <img src="./img/disponivel.png" alt="">
                            <?php endif;?>
                        </div>
                    </div>
                <?php endforeach;?>
                
            </div>
            <div class="detalhes">
                <h3 class="c_title">Detalhes</h3>
                <?php if($response->data[0]):?>
                <div class="d_container">
                    <p id="d_id" class="d-none"><?=$response->data[0]->id?></p>
                    <p id="d_vend" class="d-none"><?=$response->data[0]->vendido?></p>
                    <p class="d_nome"><span id="dinamicName d_nome"><?=$response->data[0]->nome?></span></p>
                    <div class="marca_ano">
                        <p class="d_marca"> <span class="d_hist" id="d_marca">Marca</span> <br><span id="dinamicMarca"><?=$response->data[0]->marca?></span></p>
                        <p class="d_ano"> <span class="d_hist" id="d_ano">Ano</span> <br><span id="dinamicAno"><?=$response->data[0]->ano?></span></p>
                    </div>
                    <p class="d_hist d_desc"><span id="dinamicDescricao d_desc"><?=$response->data[0]->descricao?></span></p>
                </div>
                <div class="d_container m2">
                    <button class="btn_editar" onclick="openModalEditCar()"> <img src="./img/edit.png" alt=""> EDITAR</button>
                    <?php if($response->data[0]->vendido == 1):?>
                        <img class="img_edit" src="./img/vendido.png" alt="">
                    <?php else:?>
                        <img class="img_edit" src="./img/disponivel.png" alt="">
                    <?php endif;?>
                </div>
                <?php endif;?>
            </div>
        </div>

        <div class="rodape"></div>
    </div>
</body>
</html>