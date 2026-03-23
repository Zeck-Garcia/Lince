<!-- <nav id="sidebar" class="shadow-sm">
    <div class="sidebar-header d-flex align-items-center">
        <div class="toggle-box" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </div>
        <div class="user-info ms-3">
            <div class="fw-bold lh-1 text-uppercase small"><?php echo $_SESSION["nomeAgente"]; ?></div>
            <div class="text-muted small">Usuário</div>
        </div>
    </div>

    <ul class="nav flex-column mt-2"> -->
        <?php //rh
        //  if(in_array($_SESSION["classeAgente"], [4])){
            // echo "<li class='nav-item'>
            //     <a href='#subRH' data-bs-toggle='collapse' class='nav-link dropdown-toggle'>
            //         <i class=' bi bi-person-rolodex'></i>
            //         <span class='hide-on-collapse'>Recursos Humanos</span>
            //     </a>
            //     <div class='collapse list-unstyled ps-4' id='subRH'>
            //         <a href='recursoHumano/formacao' class='nav-link border-0 small'>Formação</a>
            //     </div>
            // </li>";

            // "<!-- <li class='nav-item'>
            //         <a href='recursoHumano/calculo-hora' class='nav-link'>
            //             <i class='bi bi-alarm'></i>
            //             <span class='hide-on-collapse'>Calculo de Hora</span>
            //         </a>
            //     </li> -->";
        // }
        ?>

    <!-- </ul>

    <a href="javascript:void(0)" class="nav-link logout-btn" onclick="exit()">
        <i class="bi bi-box-arrow-right"></i>
        <span class="hide-on-collapse">Sair</span>
    </a>
</nav> -->

<nav class="navbar navbar-light bg-white d-lg-none border-bottom sticky-top navbar-mobile">
    <div class="container-fluid">
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#menuMobile">
            <span class="navbar-toggler-icon"></span>
        </button>
        <span class="navbar-brand fw-bold" style="color: var(--text-pink)">Lince</span>
    </div>
</nav>

<!-- mobile -->
<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="menuMobile">
    <div class="offcanvas-header border-bottom bg-light">
        <h5 class="offcanvas-title fw-bold" style="color: var(--text-pink)">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0 d-flex flex-column">
        <div class="py-3">
            <ul class="nav flex-column">
                <!-- <li class="nav-item"><a class="nav-link active" href="#"><i class="bi bi-cart-check me-3"></i> Ordens</a></li>
                
                <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-people me-3"></i> Utilizadores</a></li> -->

                <?php
                //rh
                 if(in_array($_SESSION["classeAgente"], [4])){
                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/formacao' class='nav-link'><i class='bi bi-journal-richtext'></i> &nbsp Formação</a></li>";

                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/calculo-hora' class='nav-link'><i class='bi bi-alarm'></i> &nbsp Calculo de Hora</a></li>";
                }

                //user
                if(in_array($_SESSION["classeAgente"], [2])){
                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/ordem-compra' class='nav-link'><i class='bi bi-cart-check'></i> &nbsp Ordem de Compra</a></li>";
                }

                //adm
                if(in_array($_SESSION["classeAgente"], [1])){
                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/utilizadores' class='nav-link'><i class='bi bi-cart-check'></i> &nbsp Utilizadores</a></li>";

                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/ordem-compra' class='nav-link'><i class='bi bi-cart-check'></i> &nbsp Ordem de Compra</a></li>";
                }

                ?>
            </ul>
        </div>
        <div class="sidebar-footer">
            <a href="javascript:void(0)" class="btn btn-outline-danger w-100" onclick="exit()"><i class="bi bi-box-arrow-left me-2"></i> Sair</a>
        </div>
    </div>
</div>

<!-- desktop -->
<aside class="sidebar-desktop d-none d-lg-flex">
    <div class="p-4 text-center border-bottom">
        <div class="text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow-sm" style="width: 50px; height: 50px; background: var(--bg-pink);">
            <i class="bi bi-person-fill fs-4"></i>
        </div>
        <h6 class="mb-0 fw-bold"><?= ucfirst($_SESSION["nomeAgente"]); ?></h6>
        <small class="text-muted"><?= ucfirst($_SESSION["nomeClasseAgente"]); ?></small>
    </div>

    <div class="py-3">
        <ul class="nav flex-column">
            <?php

                //rh
                 if(in_array($_SESSION["classeAgente"], [4])){
                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/formacao' class='nav-link'><i class='bi bi-journal-richtext'></i> &nbsp Formação</a></li>";

                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/calculo-hora' class='nav-link'><i class='bi bi-alarm'></i> &nbsp Calculo de Hora</a></li>";
                }

                //adm e user
                if(in_array($_SESSION["classeAgente"], [2])){
                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/ordem-compra' class='nav-link'><i class='bi bi-cart-check'></i> &nbsp Ordem de Compra</a></li>";
                }

                if(in_array($_SESSION["classeAgente"], [1])){
                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/utilizadores' class='nav-link'><i class='bi bi-cart-check'></i> &nbsp Utilizadores</a></li>";

                    echo "<li class='nav-item'><a href='{$_SESSION["slugClasseAgente"]}/ordem-compra' class='nav-link'><i class='bi bi-cart-check'></i> &nbsp Ordem de Compra</a></li>";
                }
            ?>
        </ul>
    </div>

    <div class="sidebar-footer">
        <a href="javascritp:void(0)" class="btn btn-outline-danger w-100 border-0" onclick="exit()"><i class="bi bi-box-arrow-left me-2"></i> Sair do Sistema</a>
    </div>
</aside>