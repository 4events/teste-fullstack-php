<?php require_once('../Controllers/VeiculosController.php');   ?>
<?php require_once('../template/header.php'); ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between">
                        <h3>VEÍCULO</h3>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_modal" onclick="newVehicle()">
                            <i class="fa fa-plus fa-lg" aria-hidden="true"></i>
                        </button>
                    </div>
                    <hr/>
                </div>
                <div class="col-lg-6">
                    <h5>Lista de veículos</h5>
                    <ul class="list-group">
                        <?php
                        //var_export($veiculos->view());
                        foreach($veiculos->view() as $veiculo) {
                        echo '
                        <li id="item_'.$veiculo["id"].'" class="list-group-item d-flex justify-content-between align-items-center" onclick="getDetalis('.$veiculo["id"].')">
                            <div class="data-vehicle">
                                <span id="marca">'.$veiculo["marca"].'</span>
                                <span id="veiculo">'.$veiculo["veiculo"].'</span>
                                <span id="ano">'.$veiculo["ano"].'</span>
                                <input type="hidden" id="combustivel" value="'.$veiculo["combustivel"].'" />
                                <input type="hidden" id="descricao" value="'.$veiculo["descricao"].'" />
                                <input type="hidden" id="vendido" value="'.$veiculo["vendido"].'" />
                            </div>
                            <span>
                                <i class="fa fa-tag fa-lg" aria-hidden="true"></i>
                            </span>
                          
                        </li>';
                        
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h5>Detalhes</h5>
                    <div class="card bg-secondary mb-3" style="max-width: 100rem;">
                        <div id="detalhes" class="card-body row">
                            <div class="col-lg-12">
                                <h4 id="detalhe_veiculo"><?php echo $veiculos->view()[0]['veiculo']?></h4>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-label mt-4">Marca:</div>
                                <span id="detalhe_marca" class="card-title"><?php echo $veiculos->view()[0]['marca']?></span>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-label mt-4">Ano:</div>
                                <span id="detalhe_ano" class="card-title"><?php echo $veiculos->view()[0]['ano']?></span>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-label mt-4">Combustível:</div>
                                <span id="detalhe_combustivel" class="card-title"><?php echo $veiculos->view()[0]['combustivel']?></span>
                            </div>
                            <hr>
                            <div class="col-lg-12">
                                <p id="detalhe_descricao" class="card-text"><?php echo $veiculos->view()[0]['descricao']?></p>
                            </div>
                        </div>
                        <div id="card-footer" class="card-footer d-flex justify-content-between align-items-center">
                            <div>
                                <input type="hidden" id="detalhe_vendido" name="vendido" value=""/>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_modal" id="detalhe_edita" onclick="edit(<?php echo $veiculos->view()[0]['id']?>)">
                                    <i class="fa fa-pencil" aria-hidden="true"></i> 
                                    Editar
                                </button>
                                <button type="button" id="detalhe_delete" class="btn btn-danger" onclick="del(<?php echo $veiculos->view()[0]['id']?>)">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                    Excluir
                                </button>
                            </div>
                            <span>
                                <i class="fa fa-tag fa-lg" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <!-- MODAL -->
        <div class="modal modal-xl fade" id="form_modal" tabindex="-1" aria-labelledby="form_modalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">VEÍCULO</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" method="post" action="/fullstack-4events-mvc/Controllers/VeiculosController.php">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="marcas_fipe" class="form-label mt-4">Marca</label>
                                    <select class="form-select" id="marcas_fipe" onChange="getModelosFipe(this.value)">
                                        <option value="">Selecione</option>
                                    </select>
                                    <div class="invalid-feedback">Esse campo é obrigatorio!</div>
                                <input type="hidden" name="id" id="id_form" value="">
                                <input type="hidden" name="marca" id="marca_fipe" value=""/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="modelos_fipe" class="form-label mt-4">Veículo</label>
                                <select class="form-select" id="modelos_fipe" onChange="getAnoFipe(this.value)">
                                    <option value="">Selecione</option>
                                </select>
                                <div class="invalid-feedback">Esse campo é obrigatorio!</div>
                                <input type="hidden" name="veiculo" id="modelo_fipe" value=""/>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="ano_fipe" class="form-label mt-4">Ano</label>
                                <select class="form-select" id="ano_fipe" onChange="setCombustivel(this.value)">
                                    <option value="">Selecione</option>
                                </select>
                                <div class="invalid-feedback">Esse campo é obrigatorio!</div>
                                <input type="hidden" name="ano" id="ano_modelo_fipe" value=""/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="combustivel_form" class="form-label mt-4">Combustível</label>
                                    <input type="text" class="form-control" id="combustivel_form" name="combustivel">
                                    <div class="invalid-feedback">Esse campo é obrigatorio!</div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="vendido_form" class="form-label mt-4">Vendido</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" value="1" id="vendido_form" name="vendido">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="descricao_form" class="form-label mt-4">Descrição</label>
                                <textarea class="form-control" id="descricao_form" name="descricao" rows="5"></textarea>
                                <div class="invalid-feedback">Esse campo é obrigatorio!</div>
                                
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="alert alert-dismissible alert-success">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Sucesso!!</strong> Veículo salvo com sucesso.
                            </div>
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <strong>Erro!</strong> Houve im erro inesperado, por favor tente novamente.
                            </div>
                        </div>
                      </div>
                  </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="valida()">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
              </div>
            </div>
          </div>
        <script src="../assets/js/jquery-3.7.0.min.js"></script>
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/functions.js"></script>
<?php require_once('../template/footer.php'); ?>