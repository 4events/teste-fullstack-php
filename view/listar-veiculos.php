<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Teste FullStack</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">

    <style>
        .bg-cinza { background: #c9d0c7;}
        #frmAddVeiculo .modal-body input[type="text"],
        #frmAddVeiculo .modal-body input[type="number"],
        #frmAddVeiculo .modal-body textarea {
            border: 0px;
            border-bottom: 1px solid #32525a ;
            color: #32525a;
        }
        #frmAddVeiculo .modal-body textarea {
            height: auto;
        }
        #frmAddVeiculo .modal-body label {
            color: #32525a;
            font-weight: bold;
        }

        #frmAddVeiculo .modal-body input[type="text"]:focus,
        #frmAddVeiculo .modal-body input[type="number"]:focus,
        #frmAddVeiculo .modal-body textarea:focus {
            outline: none;
            border: none;
            border-bottom: 1px solid #32525a ;
            color: #32525a;
            background: #c9d0c7;
        }
    </style>
    
</head>
<body class="container p-5">
<nav class="navbar navbar-dark bg-dark p-2">
    <div class="container">
        <a class="navbar-brand"><i class="m-4 bi bi-droplet-fill"></i>FULLSTACK</a>
        <form class="col-md-6 d-flex" name="frmBusca" id="frmBusca">
            <input type="search" name="txtBusca" id="txtBusca" class="text-light bg-dark bg-opacity-75 rounded-0 form-control" placeholder="BUSCA por um Nome de Veiculo" aria-label="Search">
        </form>
    </div>
</nav>
<div class="container bg-opacity-25 bg-black p-2 pb-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="p-4">Veículos</h4>
            </div>
            <div class="col align-content-end">

                <!-- Button trigger modal -->
                <button type="button" class="float-end btn rounded-circle fs-3" data-bs-toggle="modal" data-bs-target="#mdlAddVeiculo"><i class="bi bi-plus-circle-fill"></i></button>

                <!-- Modal -->
                <div class="modal fade" id="mdlAddVeiculo" tabindex="-1" aria-labelledby="mdlAddVeiculoLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content bg-cinza">
                            <form name="frmAddVeiculo" method="post" id="frmAddVeiculo">
                                <div class="modal-header border-0">
                                    <h5 class="modal-title pt-2 fs-3 mb-3" id="mdlAddVeiculoLabel">Novo Veículo</h5>
                                </div>
                                <div class="modal-body border-0">
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control rounded-0 bg-cinza text-dark" id="txtVeiculo" name="txtVeiculo" placeholder="Veículo">
                                                <label for="txtVeiculo">Veículo</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control rounded-0 bg-cinza text-dark" id="txtMarca" name="txtMarca" placeholder="Marca">
                                                <label for="txtMarca">Marca</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea class="form-control bg-cinza rounded-0 text-dark" placeholder="Descrição" id="txtDescricao" name="txtDescricao" rows=5></textarea>
                                        <label for="txtDescricao">Descrição</label>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col">
                                            <div class="form-floating">
                                                <input type="number" min="1956" max="<?= date('Y') + 1; ?>" class="form-control rounded-0 bg-cinza text-dark" id="txtAno" name="txtAno" placeholder="Ano">
                                                <label for="txtAno">Ano</label>
                                            </div>
                                        </div>
                                        <div class="col align-middle">
                                            <div class="form-check form-switch mx-5">
                                                <input type="checkbox" class="form-check-input fs-3" role="switch" id="txtVendido" name="txtVendido">
                                                <label for="txtVendido">Vendido</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" class="px-5 py-3 rounded-0 btn btn-secondary fs-5 fw-normal" name="btnAddVeiculo" id="btnAddVeiculo">ADD</button>
                                    <button type="button" class="px-5 py-3 rounded-0 btn btn-secondary fs-5 fw-normal" data-bs-dismiss="modal" name="btnFecharAdd" id="btnFecharAdd">FECHAR</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="container">
                    <h4>Lista de Veículos</h4>
                    <ul class="list-group" id="lista-veiculos">
                        <?php foreach ($veiculos as $veiculo): ?>
                            <li class="list-group-item my-1" id="veiculo-<?= $veiculo->recuperaId(); ?>">
                                <span class="float-end align-middle"><i class="bi bi-tag-fill"></i></span>
                                <span class="text-secondary fw-bold"><?= $veiculo->recuperaMarca(); ?></span><br/>
                                <span class="text-success fw-bolder"><?= $veiculo->recuperaVeiculo(); ?></span><br/>
                                <span class="text-muted"><?= $veiculo->recuperaAno(); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="container">
                    <h4>Detalhes</h4>
                    <div class="card bg-opacity-10 bg-light" id="card-description">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


<script type="text/javascript">
    $(document).ready(function() {
        getFirst();
    })

    /*
    * Pega o primeiro item da lista de veiculos e simula um click para trazer o detalhe
    */
    function getFirst() {
        var myItem = $("#lista-veiculos li").first();
        myItem.click();
    }

    var myModal = document.getElementById('mdlAddVeiculo')
    var myInput = document.getElementById('txtVeiculo')

    myModal.addEventListener('shown.bs.modal', function () {
        myInput.focus()
    })

    function limpaModal(){
        (document).getElementById('txtVeiculo').value = '';
        (document).getElementById('txtMarca').value = '';
        (document).getElementById('txtDescricao').value = '';
        (document).getElementById('txtAno').value = '';
    }

    $('#frmAddVeiculo').submit(function (e){
        e.preventDefault();
        var frm = $(this);
        $.ajax({
            url: "veiculos",
            type: "POST",
            data: frm.serialize(),
            dataType: "json",
            success: function (data){
                alert('Dados do novo veiculo cadastrados com sucesso!');
            },
        });
        limpaModal();
        $('#btnFecharAdd').click();
        $('#txtBusca').innerText = '';
        $('#frmBusca').submit();
    });


    $('#frmBusca').submit(function (event) {
        event.preventDefault();

        var form = $(this);

        $.ajax({
            url: "veiculos/find",
            type: "GET",
            data: {'nome': form.serialize()},
            dataType: "json",
            success: function (data) {
                $("#lista-veiculos").empty();

                $.each(data, function (index, element) {

                    $("#lista-veiculos").append("<li class='list-group-item my-1' id='veiculo-" + element.id + "'><span class='float-end align-middle'><i class='bi bi-tag-fill'></i></span>" +
                        "<span class='text-secondary fw-bold'>" + element.marca + "</span><br/>" +
                        "<span class='text-success fw-bolder'>" + element.veiculo + "</span><br/>" +
                        "<span class='text-muted'>" + element.ano + "</span>" +
                        "</li>");

                });

                getFirst();
            }
        });
    })

    $(document).on('click', '#lista-veiculos li', function (event) {
        $.ajax({
            url: "veiculos/id",
            data: {veiculo: event.currentTarget.id},
            type: "GET",
            success: function (result) {
                $("#card-description").html(result);
            }
        });
    });

</script>
</body>
</html>

