<nav id="sidebar" class="shadow-sm">
    <div class="sidebar-header d-flex align-items-center">
        <div class="toggle-box" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </div>
        <div class="user-info ms-3">
            <div class="fw-bold lh-1 text-uppercase small"><?php echo $_SESSION["nomeAgente"]; ?></div>
            <div class="text-muted small">Usuário</div>
        </div>
    </div>

    <ul class="nav flex-column mt-2">
        <?php //rh
         if(in_array($_SESSION["classeAgente"], [4])){
            echo "<li class='nav-item'>
                <a href='#subRH' data-bs-toggle='collapse' class='nav-link dropdown-toggle'>
                    <i class=' bi bi-person-rolodex'></i>
                    <span class='hide-on-collapse'>Recursos Humanos</span>
                </a>
                <div class='collapse list-unstyled ps-4' id='subRH'>
                    <a href='recursoHumano/formacao' class='nav-link border-0 small'>Formação</a>
                </div>
            </li>";

            // "<!-- <li class='nav-item'>
            //         <a href='recursoHumano/calculo-hora' class='nav-link'>
            //             <i class='bi bi-alarm'></i>
            //             <span class='hide-on-collapse'>Calculo de Hora</span>
            //         </a>
            //     </li> -->";
        }
        ?>
        <?php //adm
            if(in_array($_SESSION["classeAgente"], [1])){
                echo "<li class='nav-item'>
                     <a href='adm/utilizadores' class='nav-link'>
                         <i class='bi bi-alarm'></i>
                         <span class='hide-on-collapse'>Utilizadores</span>
                     </a>
                 </li>";
            }
        ?>

        <?php //adm / user
            if(in_array($_SESSION["classeAgente"], [1,2])){
                echo "<li class='nav-item'>
                     <a href='adm/ordem-compra' class='nav-link'>
                         <i class='bi bi-alarm'></i>
                         <span class='hide-on-collapse'>Ordem de Compra</span>
                     </a>
                 </li>";
            }
        ?>

    </ul>

    <a href="javascript:void(0)" class="nav-link logout-btn" onclick="exit()">
        <i class="bi bi-box-arrow-right"></i>
        <span class="hide-on-collapse">Sair</span>
    </a>
</nav>