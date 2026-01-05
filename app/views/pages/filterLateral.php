<?php session_start();?>

<div class="" id="containerMenu">
    <div id="navControl">
        <button id="btnNavControl"><i class="bi bi-list"></i></button>
    </div>

        <div id='divUsuario' class="">
            <img src=''>
            <div id="groupInfoUser" class="">
                <p id='nomeUser'  data-classe='<?= $_SESSION["classeAgente"]; ?>' data-id='<?= $_SESSION["idUser"];?>'><?= ucfirst($_SESSION["nomeAgente"]) ;?></p>
                <small><?php echo ($_SESSION["classeAgente"] == 1 ? "Administrador" : "Usuário") ;?></small>
            </div>
        </div>

        <!--  //$currentPrefix; ?param=fazerPedidoLoja -->
        <ul id='menu'>
             <?php
                if(in_array($_SESSION["classeAgente"], [1,2])){
                    echo "<li class='menuItem cursorPointer' data-colapsse='menuOrderCompra'>
                        <i class=' bi bi-cash-coin'></i>
                        <a class='menuText'>Ordem de compra<i class='bi bi-chevron-right'></i></a>
                    </li>
                        <ul id='menuOrderCompra' class='subMenu'>
                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-currency-exchange'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=criarOrdemCompra' data-pagina=''>Criar</a>
                            </li>

                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-person-vcard'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=listarOrdemCompra' data-pagina=''>Listar</a>
                            </li>
                        </ul>";
                } 
            ?>

            <?php

                if(in_array($_SESSION["classeAgente"], [1])){
                    echo "<li class='menuItem cursorPointer' data-colapsse='menuUser'>
                        <i class=' bi bi-person-bounding-box'></i>
                        <a class='menuText'>Utilizadores<i class='bi bi-chevron-right'></i></a>
                    </li>
                        <ul id='menuUser' class='subMenu'>
                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-person-plus'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=criarUltilizadores' data-pagina='criarUltilizador'>Criar</a>
                            </li>

                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-person-vcard'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=listarUltilizadores' data-pagina='listarUltilizador'>Listar</a>
                            </li>
                        </ul>";
                }

            ?>

            <?php
                if(in_array($_SESSION["classeAgente"], [3])){
                    
                    echo "<li class='menuItem cursorPointer' data-colapsse='fornecedor'>
                        <i class=' bi bi-cash-coin'></i>
                        <a class='menuText'>Fornecedor<i class='bi bi-chevron-right'></i></a>
                    </li>
                        <ul id='fornecedor' class='subMenu'>
                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-building-up'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=cadastarProdutoFornecedorProduto' data-pagina=''>Criar</a>
                            </li>
        
                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-buildings'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=listarOrdemCompra' data-pagina=''>Listar</a>
                            </li>
        
                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-box-seam'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=cadastarProdutoFornecedorProduto' data-pagina=''>Cadastrar produto</a>
                            </li>
                        </ul>";
                } 
            ?>

            <?php
                if(in_array($_SESSION["classeAgente"], [4,1])){
                    echo "<li class='menuItem cursorPointer' data-colapsse='recursoHumano'>
                        <i class=' bi bi-person-rolodex'></i>
                        <a class='menuText'>Recursos Humanos<i class='bi bi-chevron-right'></i></a>
                    </li>
                        <ul id='recursoHumano' class='subMenu'>
                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-journal-check'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=formacao' data-pagina=''>Formação</a>
                            </li>

                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-person-walking'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=solicitarFerias' data-pagina=''>Férias</a>
                            </li>

                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-person-plus'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=novoColaborador' data-pagina=''>Colaboradores</a>
                            </li>

                            <li class='subMenuItem cursorPointer'>
                                <i class='sub bi bi-pie-chart'></i>
                                <a class='subMenuText nomePagina' href='{$currentPrefix}?param=criarEscala' data-pagina=''>Escala</a>
                            </li>
                        </ul>";
                } 
            ?>


            <li class='menuItem cursorPointer' data-colapsse='pedidoLoja'>
                <i class=' bi bi-cart'></i>
                <a class='menuText'>Stock<i class='bi bi-chevron-right'></i></a>
            </li>
                <ul id='pedidoLoja' class='subMenu'>
                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-cart-plus'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=fazerPedidoLoja" data-pagina=''>Criar pedido de stock</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-cart-check'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=verPedidosLoja" data-pagina=''>Ver pedido de stock</a>
                    </li>
                </ul>

            <li class='menuItem cursorPointer' data-colapsse='encomendasLojas'>
                <i class=' bi bi-card-text'></i>
                <a class='menuText'>Gerir encomendas<i class='bi bi-chevron-right'></i></a>
            </li>
                <ul id='encomendasLojas' class='subMenu'>
                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-journal-arrow-down'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=listarEncomendasLojas" data-pagina=''>Baixar pedidos</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-journal-check'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=listarEncomendasFeitasLojas" data-pagina=''>Rever pedidos</a>
                    </li>
                </ul>

            <li class='menuItem cursorPointer' data-colapsse='anularEncomendas'>
                <i class=' bi bi-file-earmark-excel'></i>
                <a class='menuText'>Anulações<i class='bi bi-chevron-right'></i></a>
            </li>
                <ul id='anularEncomendas' class='subMenu'>
                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-file-earmark-break'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=anularDocumentoLoja" data-pagina=''>Anulação</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-file-earmark-easel'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=verAnularDocumento" data-pagina=''>Ver anulação</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-file-earmark-diff'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=removerArtigoEncomenda" data-pagina=''>Remover artigo de encomenda</a>
                    </li>
                </ul>

            <li class='menuItem cursorPointer' data-colapsse='transferenciaLoja'>
                <i class=' bi bi-signpost-split'></i>
                <a class='menuText'>Transferência<i class='bi bi-chevron-right'></i></a>
            </li>
                <ul id='transferenciaLoja' class='subMenu'>
                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-box-arrow-in-left'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=transfePendenteAceitar" data-pagina=''>Pedente por aceitar</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-box-arrow-right'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=transfeFaltaStock" data-pagina=''>Por falta de stock</a>
                    </li>
                </ul>

            <li class='menuItem cursorPointer' data-colapsse='pagamentoLoja'>
                <i class=' bi bi-currency-dollar'></i>
                <a class='menuText'>Pagamento<i class='bi bi-chevron-right'></i></a>
            </li>
                <ul id='pagamentoLoja' class='subMenu'>
                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-currency-exchange'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=alterarPgto" data-pagina=''>Alterar pagamento</a>
                    </li>
                </ul>

            <li class='menuItem cursorPointer' data-colapsse='overViewEncomendas'>
                <i class=' bi bi-puzzle'></i>
                <a class='menuText'>Encomendas<i class='bi bi-chevron-right'></i></a>
            </li>
                <ul id='overViewEncomendas' class='subMenu'>
                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-journal-medical'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=" data-pagina=''>Pendencia a tratar</a>
                    </li>
                </ul>
            
            <!-- <li class='menuItem cursorPointer' data-colapsse='recursosHumanos'>
                <i class=' bi bi-postcard'></i>
                <a class='menuText'>Recursos humanos<i class='bi bi-chevron-right'></i></a>
            </li>
                <ul id='recursosHumanos' class='subMenu'>
                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-person-walking'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=solicitarFerias" data-pagina=''>Férias</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-person-plus'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=novoColaborador" data-pagina=''>Colaboradores</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-pie-chart'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=criarEscala" data-pagina=''>Escala</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-person-gear'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=trocarFolga" data-pagina=''>Trocar folga</a>
                    </li>

                    <li class='subMenuItem cursorPointer'>
                        <i class='sub bi bi-person-gear'></i>
                        <a class='subMenuText nomePagina' href="<?= $currentPrefix;?>?param=uniforme" data-pagina=''>Uniforme</a>
                    </li>
                </ul> -->
            <li class='menuItem cursorPointer btnSair'>
                <i class=' bi bi-door-closed btnExit' ></i>
                <a class='menuText btnExit'>Sair</a>
            </li>

        </ul>
</div>