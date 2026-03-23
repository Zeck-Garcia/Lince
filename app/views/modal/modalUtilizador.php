<!-- <div id="" class='modal fade' tabindex='-1' style='z-index: 1100;' aria-modal='true' role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 10px;">
            <div class="modal-fluid">
                <div class="modal-header text-white" style="background: var(--bg-color-pink);">
                    <h2 class="modal-title h5 mb-0 fw-bold">
                        <i class="bi bi-person-badge me-2"></i>
                    </h2>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="">
                            <div class="row">

                                <div class="d-flex align-items-center" id="containerNome">
                                    <div class="col-2 CampoGroup me-3">
                                    <input type="text" id="txtCodColaboradorModal" class="form-control only-number">
                                    <label>Cod</label>
                                    </div>
                                    <div class="CampoGroup w-100">
                                    <input type="text" id="txtNomeColaboradorModal" class="form-control">
                                    <label>Nome do Funcionário</label>
                                    </div>
                                    <button id="btnSearchColaboradorModal" class="btn btn-primary col-1 ms-3"><i class="bi bi-search"></i></button>
                                    <button id="btnSaveColaboradorModal" class="btn btn-success col-1 ms-3"><i class="bi bi-plus-circle"></i></button>
                                </div>

                                <div class="d-flex align-items-center mt-3">
                                    <div class="CampoGroup w-100">
                                        <input type="text" id="txtemailModal" class="form-control">
                                        <label>Email</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mt-3" id='containerLoja'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcDepartamentoModal">
                                            <option value="99" selected disabled>Selecione</option>
                                        </select>
                                        <label for='slcAtivo'>Departamento</label>
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3" id='containerAtivo'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcCargoModal">
                                            <option value="99" selected disabled>Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                        <label for='slcAtivo'>Cargo</label>
                                    </div>
                                </div>

                                <div class="col-md-7 mt-3" id='containerLoja'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcLojaModal">
                                            <option value="99" selected disabled>Selecione</option>
                                        </select>
                                        <label for='slcAtivo'>Loja</label>
                                    </div>
                                </div>

                                <div class="col-md-5 mt-3" id='containerAtivo'>
                                    <div class="CampoGroup active">
                                        <select class="select w-100" id="slcAtivoModal">
                                            <option value="99" selected disabled>Selecione</option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                        <label for='slcAtivo'>Ativo</label>
                                    </div>
                                </div>

                                <div>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" id="chkAtivoColaboradorModal" name="ativo" checked>
                                        <label class="form-check-label fw-bold" for="chkAtivoColaboradorModal">Colaborador ativo?</label>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="modal-group-btn mt-3">
                                <input type="button" id="btnCloseModal" class="btnCloseModal btn btn-outline-secondary mr-3" value="Fechar" data-bs-dismiss="modal">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class='modal fade' id="modalUtilizador" tabindex='-1' style='z-index: 1100;' aria-hidden='true'>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header text-white" style="background: var(--bg-pink); border-bottom: none; padding: 1.2rem 1.5rem;">
                <h2 class="modal-title h5 mb-0 fw-bold d-flex align-items-center">
                    <i class="bi bi-cart-plus me-2"></i>
                </h2>
                <button type="button" class="btn-close btn-close-white btnCloseModalUtilizador" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="accordion mb-3" id="containerDadosUser">
                            <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUtilizador" aria-expanded="false" aria-controls="collapseUtilizador">
                                    <i class="bi bi-person me-1"></i> Dados do Utilizador
                                </button>
                                </h2>
                                <div id="collapseUtilizador" class="accordion-collapse collapse show" data-bs-parent="#containerDadosUser">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-6">
                                                <div class="form-floating">
                                                    <input type="text" id="txtNomeColaborador" class="form-control border-0 bg-light" placeholder="" value="sakdada">
                                                    <label for="txtNomeColaborador">Nome</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="txtEmailColaborador" class="form-control border-0 bg-light" placeholder="" value="saoisfiosfs">
                                                    <label for="txtEmailColaborador">Email</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select id="slcModalDepartamentoColaborador" class="form-select border-0 bg-light" placeholder="">
                                                        <option value="0">Todas</option>
                                                    </select>
                                                    <label for="slcModalDepartamentoColaborador">Departamento</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <select id="slcModalCargoColaborador" class="form-select border-0 bg-light">
                                                        <option value="0">Todas</option>
                                                    </select>
                                                    <label for="slcModalCargoColaborador">Cargo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mb-3" id="containerDadosLogin">
                            <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid #ffc107 !important;">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLogin" aria-expanded="false" aria-controls="collapseLogin">
                                    <i class="bi bi-person me-1"></i> Dados de Login
                                </button>
                                </h2>
                                <div id="collapseLogin" class="accordion-collapse collapse show" data-bs-parent="#containerDadosUser">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-7">
                                                <div class="form-floating">
                                                    <input type="text" id="txtLoginUser" class="form-control border-0 bg-light" placeholder="" value="sfsdifdg">
                                                    <label>Login</label>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-floating">
                                                    <select id="slcNivelUser" class="form-select border-0 bg-light">
                                                        <option value="0">Todas</option>
                                                    </select>
                                                    <label for="slcNivelUser">Grupo</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="txtSenhaUser" class="form-control border-0 bg-light" placeholder="" value="sfibsds">
                                                    <label>Senha</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="txtConfirmarSenhaUser" class="form-control border-0 bg-light" placeholder="" value="sfibsds">
                                                    <label>Confirmar Senha</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col mt-3" id="containerButton">
                            <button type="button" id="" class="btn btn-outline-secondary btnCloseModalUtilizador" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" id="btnExcluir" class="btn btn-outline-danger d-none" style="border-radius: 8px;" data-id-agente="<?php echo $_SESSION["idAgente"];?>" data-class-agente="<?php echo $_SESSION["classeAgente"];?>">Excluir</button>
                            
                            <button type='button' id='btnValidar' class='btn btn-success px-4' style='border-radius: 8px;'>Salvar</button>
                               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>