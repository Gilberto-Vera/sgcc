        <div id="wrapper">
            <ul class="navbar-nav bg-gradient-light sidebar sidebar-black accordion" id="accordionSidebar">
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash_board.php">
                    <img class="mb-1" src="image/ring.png" width="45" height="50"><br>
                    <div class="sidebar-brand-text mx-3">SGCC</div>
                </a>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="dash_board.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Painel de Controle</span>
                    </a>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Cliente</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="manage_client.php">Cadastro</a>
                            <a class="collapse-item" href="client.php">Lista</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Usuário</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="manage_user.php">Cadastro</a>
                            <a class="collapse-item" href="user.php">Lista</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                        <i class="fas fa-fw fa-dolly"></i>
                        <span>Fornecedor</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="manage_provider.php">Cadastro</a>
                            <a class="collapse-item" href="provider.php">Lista</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefour"
                        aria-expanded="true" aria-controls="collapsefour">
                        <i class="fas fa-fw fa-thumbtack"></i>
                        <span>Evento</span>
                    </a>
                    <div id="collapsefour" class="collapse" aria-labelledby="headingfour"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="#">Cadastro</a>
                            <a class="collapse-item" href="event.php">Lista</a>
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-user-alt"></i>
                        <span><?= $_SESSION['user']->nome ?></span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header"></h6>
                            <a class="collapse-item" href="#">Perfil</a>
                            <a class="collapse-item" href="#">Configurações</a>
                            <a class="collapse-item" href="logout.php">
                                <i class="fas fa-fw fa-sign-in-alt"></i>
                                <span>Sair</span></a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Gráficos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tabelas</span></a>
                </li>
                <hr class="sidebar-divider d-none d-md-block">
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </ul>