$(document).ready(function() {
    getMarcasFipe();
});

let strJson;

$("#find").keyup(function() {

    text = $(this).val();
    let id;

    if(text.length > 2 ) {

        $(".list-group").html("");

        $.ajax({
  
            url: "/fullstack-4events/Controllers/VeiculosController.php",
            type: "GET",
            async: false,
            dataType: "json",
            data: {"function": find, "q": text},
            success: function (res) {
                strJson = res.data;
                $.each(strJson, function(i, val) {
                    if(!id){
                        id = val.id;
                    }                    
                    $(".list-group").append(
                        '<li id="item_'+val.id+'" class="list-group-item d-flex justify-content-between align-items-center" onclick="getDetalis('+val.id+')">'+
                            '<div class="data-vehicle">'+
                                '<span id="marca">'+val.marca+'</span>'+
                                '<span id="veiculo">'+val.veiculo+'</span>'+
                                '<span id="ano">'+val.ano+'</span>'+
                                '<input type="hidden" id="combustivel" value="'+val.combustivel+'" />'+
                                '<input type="hidden" id="descricao" value="'+val.descricao+'" />'+
                                '<input type="hidden" id="vendido" value="'+val.vendido+'" />'+
                            '</div>'+
                            '<span>'+
                                '<i class="fa fa-tag fa-lg" aria-hidden="true"></i>'+
                            '</span>'+
                        '</li>'
                    )  
                });
                getDetalis(id);
            }
        });
    }

});

function selectByText(select, text) {
    $(select).find('option:contains("' + text + '")').prop('selected', true);
}
function getDetalis(id) {

    $("#item_"+id+" span, #item_"+id+" input").each(function() {

        let idE =  $(this).attr("id");
        if($(this).attr("type") == "hidden") {
            if(idE == "descricao") {
                $("#detalhe_"+idE).html($(this).val());
            }else{
                $("#detalhe_"+idE).val($(this).val());

            }
        }else{
            $("#detalhe_"+idE).html($(this).html());
        }

        $("#detalhe_edita").attr("onClick", "edit("+id+")");
        $("#detalhe_delete").attr("onClick", "del("+id+")");
    });
    
}

function edit(id) {
    selectByText('#marcas_fipe', $("#detalhe_marca").html());
    getModelosFipe($("#marcas_fipe").val());
    selectByText('#modelos_fipe', $("#detalhe_veiculo").html());
    getAnoFipe($("#modelos_fipe").val());
    selectByText('#ano_fipe', $("#detalhe_ano").html());
    setCombustivel($("#ano_fipe").val());
    
    $("#combustivel_form").val($("#detalhe_combustivel").html());
    $("#descricao_form").val($("#detalhe_descricao").html());
    $("#id_form").val(id);
    
    if($("#detalhe_vendido").val() == 1){
        $('#vendido_form').attr('checked', 'checked');
    }
    

}

function newVehicle(){
    $('.modal-title').html('Novo Veículo');
    $('#id_veiculo, #marcas_fipe, #combustivel, #descricao').val("");
    $('#modelos_fipe, #ano_fipe').html("");
    $('#vendido').removeAttr('checked');

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
        if(($(this).val() == "" || $(this).val() == undefined) && $(this).attr("id") != "id_form"){
            erro = true;
            console.log($(this).attr("id"));
            $(this).next().css("display", "block");
        }
    });

    if(!erro){
        $("#form").submit();
    }

}

function del(id) {
    if(confirm("Deseja realmente excluir esse veículo")) {
        $.ajax({
            //url: "http://localhost/veiculos/"+id,
            url: "/fullstack-4events/Controllers/VeiculosController.php",
            type: "DELETE",
            async: false,
            data:{"id": id},
            dataType: "json",
            success: function (res) {
                window.location.reload(true);
            }
        });
    }
}


///////// Funcões busca FIPE /////////

    function getMarcasFipe() {
        $.ajax({
            url: "https://veiculos.fipe.org.br/api/veiculos/ConsultarMarcas",
            type: "POST",
            async: true,
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
        $("#marca_fipe").val($("#marcas_fipe option:selected").text());
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
        $("#modelo_fipe").val($("#modelos_fipe option:selected").text());
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

    function setCombustivel(val) {
        $("#ano_modelo_fipe").val($("#ano_fipe option:selected").text());
    }
