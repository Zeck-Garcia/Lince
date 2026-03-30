<div class='modal fade' id="modalOrdemCompra" tabindex='-1' style='z-index: 1100;' aria-hidden='true'>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
            
            <div class="modal-header text-white" style="background: var(--bg-pink); border-bottom: none; padding: 1.2rem 1.5rem;">
                <h2 class="modal-title h5 mb-0 fw-bold d-flex align-items-center">
                    <i class="bi bi-cart-plus me-2"></i>
                </h2>
                <button type="button" class="btn-close btn-close-white btnCloseModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-4" style="background-color: #f8f9fa;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="accordion mb-3" id="containerFornecedor">
                            <div class="accordion-item" style="border-radius: 10px; border-left: 4px solid var(--bg-pink) !important;">
                                <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFornecedor" aria-expanded="true" aria-controls="collapseFornecedor">
                                    <i class="bi bi-building me-1"></i> Dados do Fornecedor
                                </button>
                                </h2>
                                <div id="collapseFornecedor" class="accordion-collapse collapse show" data-bs-parent="#containerFornecedor">
                                    <div class="accordion-body">
                                        <div class="row g-3">

                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <div class="form-floating">
                                                        <input type="text" id="txtCodFornecedor" class="form-control" placeholder="">
                                                        <label>Código</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <div class="form-floating">
                                                        <input type="text" id="txtNome" class="form-control" placeholder="">
                                                        <label>Nome</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-floating">
                                                    <input type="text" id="txtSite" class="form-control" placeholder="">
                                                    <label>Site</label>
                                                </div>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="form-floating">
                                                    <input type="email" id="txtEmail" class="form-control" placeholder="">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="text" id="txtContacto" class="form-control only-number" placeholder="">
                                                    <label>Contacto</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input type="email" id="txtTelefone" class="form-control only-number" placeholder="">
                                                    <label>Telefone</label>
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
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDadosNota" aria-expanded="true" aria-controls="collapseDadosNota">
                                    <i class="bi bi-file-earmark-text me-1"></i> Morada
                                </button>
                                </h2>
                                <div id="collapseDadosNota" class="accordion-collapse collapse show" data-bs-parent="#containerDetalheNota">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-7">
                                                <div class="form-floating">
                                                    <input type="text" id="txtMorada" class="form-control" placeholder="">
                                                    <label>Morada</label>
                                                </div>
                                            </div>

                                            <div class="col-md-5" id="containerValor">
                                                <div class="form-floating">
                                                    <input type="text" id="txtConcelho" class="form-control" placeholder="">
                                                    <label>Concelho</label>
                                                </div>
                                            </div>

                                            <div class="col-md-9" id="containerValor">
                                                <div class="form-floating">
                                                    <input type="text" id="txtDistrito" class="form-control" placeholder="">
                                                    <label>Distrito</label>
                                                </div>
                                            </div>

                                            <div class="col-md-3" id="containerValor">
                                                <div class="form-floating">
                                                    <input type="text" id="txtCodPostal" class="form-control" placeholder="">
                                                    <label>Cod Postal</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input custom-switch" type="checkbox" id="chkAtivo" checked>
                                <label class="form-check-label fw-semibold" for="chkAtivo">Ativar ou Desativar</label>
                            </div>
                        </div>
                        
                        <div class="col mt-3" id="containerButton">
                            <button type="button" id="" class="btn btn-outline-secondary btnCloseModal" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" id="btnExcluir" class="btn btn-outline-danger d-none" style="border-radius: 8px;" data-id-agente="<?php echo $_SESSION["idAgente"];?>" data-class-agente="<?php echo $_SESSION["classeAgente"];?>">Excluir</button>
                            <button type='button' id='btnValidar' class='btn btn-success px-4' style='border-radius: 8px;'>Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>