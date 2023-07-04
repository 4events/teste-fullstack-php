$(document).ready(function() {
    getVeiculos();
    getMarcasFipe();
    getDetalis(0);
   //$("#item").click();
});

let strJson;
let strClone;
let strCloneFooter;
let strCloneList;
let iArray;

function getVeiculos() {

    if(!strCloneList){
        strCloneList = $(".list-group").html();
    }
    $(".list-group").html("");

    $.ajax({
        url: "http://localhost:90/veiculos",
        type: "GET",
        async: false,
        dataType: "json",
        success: function (res) {
            //console.log(res);
            strJson = res.data;
            $.each(strJson, function(i, val) {
                $(".list-group").append(
                    strCloneList.replace("item_veiculo", i)
                    .replace("item_id", val.id)
                    .replace("marca", val.marca)
                    .replace("veiculo", val.veiculo)
                    .replace("ano", val.ano)
                    .replace("combustivel", val.combustivel)
                );

               // console.log(strClone.replace("id_veiculo", i));
            });
        }
    });
}

$("#find").keyup(function() {

    text = $(this).val();

    if(text.length > 2 ) {

        $(".list-group").html("");

        $.ajax({
            url: "http://localhost:90/veiculos/find?q="+text,
            type: "GET",
            async: false,
            dataType: "json",
            success: function (res) {
                strJson = res.data;
                $.each(strJson, function(i, val) {
                    $(".list-group").append(
                        strCloneList.replace("item_veiculo", i)
                        .replace("item_id", val.id)
                        .replace("marca", val.marca)
                        .replace("veiculo", val.veiculo)
                        .replace("ano", val.ano)
                        .replace("combustivel", val.combustivel)
                    );
                        
                      
                });
                getDetalis(0);
            }
        });
    }

    if(text == ""){
        getVeiculos();
        getDetalis(0);
    }
});

function selectByText(select, text) {
    $(select).find('option:contains("' + text + '")').prop('selected', true);
}

function populaForm(id){

    $.ajax({
        url: "http://localhost:90/veiculos/"+id,
        type: "GET",
        async: true,
        dataType: "json",
        success: function (res) {

            selectByText('#marcas_fipe', res.data.marca);
            getModelosFipe($("#marcas_fipe").val());
            selectByText('#modelos_fipe', res.data.veiculo);
            getAnoFipe($("#modelos_fipe").val());
            selectByText('#ano_fipe', res.data.ano);
            
            $("#combustivel").val(res.data.combustivel);
            if(res.data.vendido == 1){
                $('#vendido').attr('checked', 'checked');
            }
            $("#descricao").val(res.data.descricao);
            
            $('.modal-title').html('Edita Veículo');
            $('#id_veiculo').val(res.data.id);

        }
    });
}

function getDetalis(i) {

    if(!strClone){
        strClone = $("#detalhes").html();
        strCloneFooter = $("#card-footer").html();
    }
    
    $("#detalhes").html(
        strClone.replace("veiculo", strJson[i].veiculo)
        .replace("descricao", strJson[i].descricao)
        .replace("marca", strJson[i].marca)
        .replace("ano", strJson[i].ano)
        .replace("combustivel", strJson[i].combustivel)
    );

    
    $("#card-footer").html(
        strCloneFooter.replace("id_excluir", strJson[i].id)
    );

    $("#form input, #form select, #form textarea").each(function() {
        $(this).next().css("display", "none");
    });

    iArray = i;
    populaForm(strJson[i].id);
   
}

function newVehicle(){
    $('.modal-title').html('Novo Veículo');
    $('#id_veiculo, #marcas_fipe, #combustivel, #descricao').val("");
    $('#modelos_fipe, #ano_fipe').html("");
    $('#vendido').removeAttr('checked');
    iArray = 0;

    $("#form input, #form select, #form textarea").each(function() {
        $(this).next().css("display", "none");
    });
}

function valida() {

    let erro = false;
    let method = "POST";
    
    let data = {
        "marca": $("#marcas_fipe option:selected").text(),
        "veiculo": $("#modelos_fipe option:selected").text(),
        "ano": $("#ano_fipe option:selected").text(),
        "combustivel": $("#combustivel").val(),
        "vendido": $('#vendido').is(':checked') ? 1 : 0,
        "descricao": $("#descricao").val()
    }
    
    if($("#id_veiculo").val() != "") {
        data['id'] = parseInt($("#id_veiculo").val());
        method = "PUT";
    }

    $("#form input, #form select, #form textarea").each(function() {
        $(this).next().css("display", "none");
        if($(this).val() == "" || $(this).val() == undefined){
            erro = true;
            $(this).next().css("display", "block");
        }
    });

    if(!erro){
        $.ajax({
            url: "http://localhost:90/veiculos",
            type: method,
            async: false,
            dataType: "json",
            data: JSON.stringify(data),
            success: function (res) {
                if(res.code == 200 || res.code == 201){
                    $(".alert-success").css("display", "block");
                    setTimeout(function(){
                        $(".alert-success").css("display", "none");
                    }, 4000);
                }else{
                    $(".alert-danger").css("display", "block");
                    setTimeout(function(){
                        $(".alert-danger").css("display", "none");
                    }, 4000);
                }
            }
        });
    }

}

function del(id) {
    if(confirm("Deseja realmente excluir esse veículo")) {
        $.ajax({
            url: "http://localhost:90/veiculos/"+id,
            type: "DELETE",
            async: false,
            dataType: "json",
            success: function (res) {
                getVeiculos();
                getDetalis(0);
            }
        });
    }
}

$('#form_modal').on('hide.bs.modal', function (event) {
    getVeiculos();
})


///////// Funcões busca FIPE /////////

    function getMarcasFipe() {

        $.ajax({
            url: "https://veiculos.fipe.org.br/api/veiculos/ConsultarMarcas",
            type: "POST",
            async: false,
            dataType: "json",
            data: {"codigoTipoVeiculo": 1, "codigoTabelaReferencia": 299},
            success: function (res) {
                $.each(res, function(i, val) {
                    $("#marcas_fipe").append(
                        '<option value="'+val.Value+'">'+val.Label+'</option>'
                    )
                });
            }
        });

    }

    function getModelosFipe(id) {
        $("#modelos_fipe").html('<option value="">Selecione</option>');
        $.ajax({
            url: "https://veiculos.fipe.org.br/api/veiculos/ConsultarModelos",
            type: "POST",
            async: false,
            dataType: "json",
            data: {"codigoTipoVeiculo": 1, "codigoTabelaReferencia": 299, "codigoMarca": id},
            success: function (res) {
                $.each(res.Modelos, function(i, val) {
                    $("#modelos_fipe").append(
                        '<option value="'+val.Value+'">'+val.Label+'</option>'
                    )
                });
            }
        });

    }

    function getAnoFipe(id) {
        let idMarca = $("#marcas_fipe").val();
        $("#ano_fipe").html('<option value="">Selecione</option>');
        $.ajax({
            url: "https://veiculos.fipe.org.br/api/veiculos/ConsultarAnoModelo",
            type: "POST",
            async: false,
            dataType: "json",
            data: {"codigoTipoVeiculo": 1, "codigoTabelaReferencia": 299, "codigoMarca": idMarca, "codigoModelo": id},
            success: function (res) {
                $.each(res, function(i, val) {
                    $("#ano_fipe").append(
                        '<option value="'+val.Label.split(" ")[1]+'">'+val.Value.split("-")[0].replace("32000", "Zero")+'</option>'
                    )
                });
            }
        });

    }

    function setCombustical(val) {
        $("#combustivel").val(val);
    }
