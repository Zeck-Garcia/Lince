<div id="modalConfirme" class='modal fade' tabindex='-1' style='display: block; z-index: 1200;' aria-modal='true' role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-sm"> <div class="modal-content shadow-lg border-0">
            <div class="modal-header text-white" style="background: var(--bg-pink);">
                <h2 class="modal-title h5 mb-0 fw-bold">
                    <i class="bi bi-info-circle me-2"></i>
                </h2>
                <button type="button" class="btn-close btn-close-white btnCloseSubModal" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body p-4 text-center">
                <i class="bi bi-exclamation-circle text-warning mb-3" style="font-size: 3rem;"></i>
                <div id="confirmMessage">
                    <p class="mb-0 fw-medium">Deseja realmente prosseguir com esta ação?</p>
                </div>
            </div>

            <div class="modal-footer border-0 d-flex justify-content-center pb-4">
                <button type="button" class="btn btn-outline-danger px-4 py-2 fw-bold btnCloseSubModal rounded-pill" data-bs-dismiss="modal">
                    Não, sair
                </button>
                <button id="btnSubModalValida" type="button" class="btn px-4 py-2 fw-bold text-white shadow-sm btn-success rounded-pill">
                    Sim
                </button>
            </div>
        </div>
    </div>
</div>
