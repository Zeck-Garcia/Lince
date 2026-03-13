<div class='modal fade' id="modalOrdemCompra" tabindex='-1' style='z-index: 1100;' aria-hidden='true'>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header text-white" style="background: var(--bg-pink); border-bottom: none; padding: 1.2rem 1.5rem;">
                <h2 class="modal-title h5 mb-0 fw-bold d-flex align-items-center">
                    <i class="bi bi-cart-plus me-2"></i>
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="CampoGroup shadow-sm">
                                <input type="text" id="txtNumberOrder" class="form-control" placeholder="" disabled>
                                <label class="fw-bold text-muted">Nº da Order</label>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="CampoGroup active shadow-sm">
                                <select class="form-select border-0" id="slcPrioridade">
                                    <option value="1" selected>Baixa</option>
                                    <option value="2">Média</option>
                                    <option value="3">Alta</option>
                                </select>
                                <label class="fw-bold text-muted">Prioridade</label>
                            </div>
                        </div>

                        <div class="accordion mb-3" id="containerDadosUser">
                            <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSolicitante" aria-expanded="false" aria-controls="collapseSolicitante">
                                    <i class="bi bi-person me-1"></i> Dados do Solicitante
                                </button>
                                </h2>
                                <div id="collapseSolicitante" class="accordion-collapse collapse" data-bs-parent="#containerDadosUser">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="CampoGroup">
                                                    <input type="text" id="txtColaborador" class="form-control border-0 bg-light" placeholder="">
                                                    <label>Colaborador</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="CampoGroup">
                                                    <input type="text" id="txtDepartamento" class="form-control border-0 bg-light" placeholder="">
                                                    <label>Departamento</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="CampoGroup">
                                                    <input type="email" id="txtCargo" class="form-control border-0 bg-light" placeholder="">
                                                    <label>Cargo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mb-3" id="containerFornecedor">
                            <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFornecedor" aria-expanded="false" aria-controls="collapseFornecedor">
                                    <i class="bi bi-building me-1"></i> Dados do Fornecedor
                                </button>
                                </h2>
                                <div id="collapseFornecedor" class="accordion-collapse collapse" data-bs-parent="#containerFornecedor">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="input-group">
                                                    <div class="form-floating">
                                                        <input type="text" id="txtNomeEmpresa" class="form-control border-0 bg-light" placeholder="" value="1">
                                                        <label>Nome da empresa</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-floating">
                                                    <input type="text" id="txtSiteEmpresa" class="form-control border-0 bg-light" placeholder="">
                                                    <label>Site da empresa</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-floating">
                                                    <input type="email" id="txtEmailEmpresa" class="form-control border-0 bg-light" placeholder="">
                                                    <label>Email da empresa</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="txtContactoEmpresa" class="form-control border-0 bg-light" placeholder="">
                                                    <label>Contacto</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="email" id="txtTelefoneEmpresa" class="form-control border-0 bg-light" placeholder="">
                                                    <label>Telefone</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-0">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input custom-switch" type="checkbox" id="chkEnviarEmailFornecedor" checked>
                                                    <label class="form-check-label fw-semibold" for="chkEnviarEmailFornecedor">Enviar email automático ao fornecedor após aprovação</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="accordion mb-3" id="containerDetalheNota">
                            <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid #ffc107 !important;">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDadosNota" aria-expanded="false" aria-controls="collapseDadosNota">
                                    <i class="bi bi-file-earmark-text me-1"></i> Detalhes da Compra
                                </button>
                                </h2>
                                <div id="collapseDadosNota" class="accordion-collapse collapse" data-bs-parent="#containerDetalheNota">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="txtNOrcamento" class="form-control border-0 bg-light">
                                                    <label>Nº do orçamento</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="containerValor">
                                                <div class="form-floating">
                                                    <input type="text" id="txtValorNota" class="form-control border-0 bg-light" value="324343">
                                                    <label>Valor da nota (€)</label>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <textarea class="form-control border-0 bg-light" id="txtDescricaoCurta" style="min-height: 80px">texto curto</textarea>
                                                    <label>Descrição do item</label>
                                                    <div class="d-flex justify-content-between mt-1">
                                                        <small class="text-muted">Mínimo 10 caracteres</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-floating">
                                                    <textarea class="form-control border-0 bg-light" id="txtDescricaoLonga" style="min-height: 120px">texto longo</textarea>
                                                    <label>Descrição do serviço/validação</label>
                                                    <small class="text-muted">Mínimo 20 caracteres. Inclua links se necessário.</small>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                            if(in_array($_SESSION["classeAgente"], [1])){
                                echo "<div class='col-12' id='containerAprovação'></div>";
                            }
                        ?>

                        <div class="col mt-3" id="containerButton">
                            <button type="button" id="" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" id="btnExcluir" class="btn btn-outline-danger d-none" style="border-radius: 8px;" data-id-agente="<?php echo $_SESSION["idAgente"];?>" data-class-agente="<?php echo $_SESSION["classeAgente"];?>">Excluir</button>
                            
                            <?php
                                if(in_array($_SESSION["classeAgente"], [1])){
                                    echo "<button type='button' id='btnValidar' class='btn btn-outline-success px-4' style='border-radius: 8px;'>Validar</button>";
                                }

                                if(in_array($_SESSION["classeAgente"], [1])){
                                    //echo "<button type='button' id='btnAprovar' class='btn btn-success fw-bold px-4 ms-1' style='border-radius: 8px;'>Aprovar Ordem</button>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>