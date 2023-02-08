/**
 * Função que lista todos os detalhes de um carro selecionado
 * @param {*} id -> paramêtro passado para a API para realizar
 * a busca do carro selecionado pelo usuário
 */
function listOne(id){
    var url = 'http://localhost/teste-fullstack-php/APIPHP/public_html/api/user/'+id;
    fetch(url)
        .then(response => response.json())
        .then(data => {
            $('.infos_busca_').remove();
            $(".d_container"). css("display", "block");
            $('.d_nome').text(data['data'].nome);
            $('#d_id').text(data['data'].id);
            $('#d_vend').text(data['data'].vendido);
            $('#dinamicMarca').text(data['data'].marca);
            $('#dinamicAno').text(data['data'].ano);
            $('.d_desc').text(data['data'].descricao);
            if(data['data'].vendido === '1'){
                $(".img_edit").attr("src", "./img/vendido.png");
            }else{
                $(".img_edit").attr("src", "./img/disponivel.png");
            }
        });

}

/**
 * Função utilizada para busca itens relevantes com a pesquisa do usuário
 * Caso retorne algum item, os mesmos serão listados ao usuário,
 * caso contrário o usuário será informado que não houve retorno da busca.
 */
function buscarItem(){
    var valor = $(".input_busca").val();
    var busca = "busca";
    fetch("http://localhost/teste-fullstack-php/APIPHP/public_html/api/user/"+busca+"---"+valor, {
    method: "POST",
    headers: {'Content-Type': 'application/json'}
    }).then(response => response.json())
    .then(data => {
        $('.veiculo').remove();
        $('.infos_busca_').remove();
        $(".d_container"). css("display", "none");
        if(typeof data['data'][0].nome == 'undefined'){
            $(".lista_veiculos").append("<p class='infos_busca_'>Nenhum resultado encontrado :(</p>");
            $(".detalhes").append("<p class='infos_busca_'>Não encontramos nenhum modelo para ver os detalhes :(</p>");
            return;
        }
        $(".detalhes").append("<p class='infos_busca_'>Selecione um modelo para ver os detalhes :)</p>");
        for(let x of data['data']){
            var veiculo = '<div class="veiculo" onclick="listOne('+x.id+')">' +
                            '<div class="veiculos_infos">'+
                                '<p class="v_nome">'+x.marca+'</p>'+
                                '<p class="v_info">'+x.nome+'</p>'+
                                '<p class="v_ano">'+x.ano+'</p>'+
                            '</div>'+
                            '<div class="veiculos_img">';

            if(x.vendido == 1){
                veiculo = veiculo + '<img src="./img/vendido.png" alt="">';
            }else{
                veiculo = veiculo + '<img src="./img/disponivel.png" alt="">';
            }
            veiculo = veiculo + '</div>'+ '</div>';
            $(".lista_veiculos").append(veiculo);
        }
    });
}

/**
 * O modal para novos cadastro e o modal de atualização de cadastros já existentes
 * é o mesmo, somente são feitas algumas alterações da estrutura com jquery.
 */

/**
 * Função que abre uma modal para que o usuário possa realizar
 * o cadastro de novos carros.
 */
function openModalNewCar(){
    disableScroll();
    $("#form_veiculo").attr("value","");
    $("#switch-shadow").prop('checked', false);
    $("#form_marca").attr("value","");
    $("#form_ano").attr("value","");
    $("#form_desc").val("");

    $('.modalNewCar .title_form').text("Novo veículo");
    $('.btn_addOrUp_infos').text("ADICIONAR");
    $('.btn_addOrUp_infos').attr("onclick", 'updateOrInsertInfo("insert")');
    $(".modalNewCar"). css("display", "flex");
}
/**
 * Função que abre uma modal para que o usuário possa realizar
 * a atualização das informações de carros já existentes.
 */
function openModalEditCar(){
    disableScroll();
    $('.modalNewCar .title_form').text("Alterar informações do veículo");
    $('.btn_addOrUp_infos').text("ALTERAR");
    $('.btn_addOrUp_infos').attr("onclick", 'updateOrInsertInfo("update")');
    $(".modalNewCar"). css("display", "flex");

    //Atribui os devidos valores aos inputs
    $("#form_veiculo").attr("value",$(".d_nome").text());
    $(".form_id").attr("value",$("#d_id").text());
    if($("#d_vend").text() == 1){
        $("#switch-shadow").prop('checked', true);
    }else{
        $("#switch-shadow").prop('checked', false);
    }
    $("#switch-shadow").attr("value",$("#d_vend").text());
    $("#form_marca").attr("value",$("#dinamicMarca").text());
    $("#form_ano").attr("value",$("#dinamicAno").text());
    $("#form_desc").val($(".d_desc").text());

}

/**
 * Função utilizada para fechar os modais
 */
function closeModais(){
    window.onscroll = function() {};
    $(".modalNewCar"). css("display", "none");
}

/**
 * Função que realiza o envio de novas informações para a API
 * tanto de INSERT como de UPDATE.
 * @param {*} op -> Parametro utilizado para decidir qual vai ser a operação
 * (insert ou update)
 * 
 * Em caso de sucesso ou não, um modal é aberto ao usuário informado 
 * o status da operação, após clicar em 'OK' a página é recarregada
 * para trazer as novas informações adicionadas ou não pelo usuário.
 */
function updateOrInsertInfo(op){
    var nome, marca, ano, vendido, desc;
    nome = $("#form_veiculo").val();
    marca = $("#form_marca").val();
    ano = $("#form_ano").val();
    vendido = $("#switch-shadow").is(':checked')? 1 : 0 ;
    desc = $("#form_desc").val();

    if(op == "update"){
        id = $(".form_id").val();
        let info = op+"---"+id+"---"+nome+"---"+marca+"---"+ano+"---"+desc+"---"+vendido;
        fetch("http://localhost/teste-fullstack-php/APIPHP/public_html/api/user/"+info, {
        method: "POST",
        headers: {'Content-Type': 'application/json'}
        }).then(response => response.json())
        .then(data => {
            if(data['status'] == 'sucess'){
                $('.resultadoOp').text(data['data']);
                $(".modalPosPost").css('display', 'block');
            }
        });


    }else if(op == "insert"){
        let info = op+"---"+nome+"---"+marca+"---"+ano+"---"+desc+"---"+vendido;
        fetch("http://localhost/teste-fullstack-php/APIPHP/public_html/api/user/"+info, {
        method: "POST",
        headers: {'Content-Type': 'application/json'}
        }).then(response => response.json())
        .then(data => {
            if(data['status'] == 'sucess'){
                $('.resultadoOp').text(data['data']);
                $(".modalPosPost").css('display', 'block');
            }
        });
    }
}

/**
 * Função que verifica se as informações do formulário estão preenchidas,
 * caso não esteja o botão de enviar o form será desativado, quando todas as 
 * informações forem preenchidas o botão é reativado.
 */
function verifyInfos(){
    var nome, marca, ano, vendido, desc;
    nome = $("#form_veiculo").val();
    marca = $("#form_marca").val();
    ano = $("#form_ano").val();
    vendido = $("#switch-shadow").is(':checked');
    desc = $("#form_desc").val();
    rev = $("#form_revisao").is(':checked');

    if(nome == '' || marca == '' || ano == '' || desc == '' || rev == false){
        $(".btn_addOrUp_infos").attr('disabled', 'disabled');
        $(".btn_addOrUp_infos").css('background-color', 'red');
    }else{
        $(".btn_addOrUp_infos").removeAttr('disabled');
        $(".btn_addOrUp_infos").css('background-color', 'green');
    }
}

/**
 * Função utilizada para recarregar a página.
 * Essa função é utilizada somente após um insert ou update de informações
 */
function recarregaPag(){
    location.reload();
}

/**
 * Função que desabilita o scrol dentro do modal de cadastro e atualização de informações
 * motivo -> para o usuário não rolar a página no celular, já que não haverá nenhuma informação 
 * relevante.
 */
function disableScroll(){
    window.scrollTo(0, 0);
    window.onscroll = function() {
        window.scrollTo(0, 0);
    };
}
