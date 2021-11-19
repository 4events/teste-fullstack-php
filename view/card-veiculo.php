                    <div class="card-body" id="card-veiculo">
                        <div class="row mb-3">
                            <div class="col">
                                <h5 class="card-title" style="color: darkgreen;"><?= $veiculo->recuperaVeiculo();?></h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <h6 class="card-subtitle mb-2 text-muted"><span class="text-dark">Marca</span><br/><?= $veiculo->recuperaMarca();?></h6>
                            </div>
                            <div class="col">
                                <h6 class="card-subtitle mb-2 text-muted"><span class="text-dark">Ano</span><br/><?= $veiculo->recuperaAno();?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="card-text"><?= $veiculo->recuperaDescricao();?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="\editarVeiculo\<?= $veiculo->recuperaId();?>" class="rounded-0 btn btn-secondary px-4 card-link btn btn-primary">Editar</a>
                            </div>
                            <div class="col align-content-end">
                                <span class="float-end align-middle"><i class="bi bi-tag-fill"></i></span>
                            </div>
                        </div>
                    </div>
