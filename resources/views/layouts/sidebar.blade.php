<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="https://www.puce.edu.ec" class="brand-link">
        <img src="/images/logo-puce.png" class="brand-image img-circle elevation-3"
             style="opacity: 1 ">
        <span class="brand-text font-weight-light" style="color:#45bfde">PUCE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://scontent.fuio7-1.fna.fbcdn.net/v/t1.0-1/p100x100/10897763_330241177169113_6768127734202000663_n.jpg?_nc_cat=0&_nc_eui2=v1%3AAeHCw1ouZFbkWVI6orU4G0dZe_lqrxMzfhUoSN7rGepGJBZHYTHL5xcebSORK-h_9GKYrvMTwk-xwlEQtbD1-le96bXEpDmw5obZZ67OAeeDOg&oh=a3f4ae873ab5c9280e61fc85d1779076&oe=5B8A7BE3" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Fernanda Robles</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="fa fa-university"></i>
                        <p>
                            Sedes
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    @foreach($sedes as $sede)
                    <ul class="nav-item nav-treeview">
                        <a href="#" class="nav-link ">
                            <i class="right fa fa-angle-right"></i>
                            <p>
                                {{ $sede->nombresede }}
                            </p>
                        </a>
                        <ul class="nav-item nav-treeview ">
                            <ul class="nav-item">
                                <a href="{{ URL::to('facultades/' . $sede->idsede . '/list') }}"  class="nav-link">
                                    <p>Facultades</p>
                                </a>
                            </ul>
                            <ul class="nav-item">
                                <a href="{{ URL::to('escuelas/' . $sede->idsede . '/list2') }}" class="nav-link">
                                    <p>Escuelas</p>
                                </a>
                            </ul>
                            <ul class="nav-item">
                                <a href="{{ URL::to('carreras/' . $sede->idsede . '/list') }}" class="nav-link ">
                                    <p>Carreras</p>
                                </a>
                            </ul>
                            <ul class="nav-item">
                                <a href="{{ URL::to('convenios/' . $sede->idsede . '/list') }}" class="nav-link active">
                                    <p>Convenios</p>
                                </a>
                            </ul>
                         </ul>
                    </ul>
                    @endforeach
                </li>

                <li class="nav-item has-treeview">
                    <a href="/coordinadores" class="nav-link">
                        <i class="fa fa-clipboard"></i>
                        <p>
                            Coordinadores
                        </p>
                    </a>

                </li>
                <li class="nav-item has-treeview">
                    <a href="/empresas" class="nav-link">
                        <i class="fa fa-building"></i>
                        <p>
                            Empresas
                        </p>
                    </a>

                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fa fa-briefcase"></i>
                        <p>
                            Tutores
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/profesores" class="nav-link">
                                <i class="right fa fa-angle-right"></i>
                                <p>Tutores Academicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/tutores" class="nav-link">
                                <i class="right fa fa-angle-right"></i>
                                <p>Tutores Empresariales</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="/estudiantes" class="nav-link">
                        <i class="fa fa-user"></i>
                        <p>
                            Estudiantes
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-leanpub"></i>
                        <p>
                            Practicas
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/practicas" class="nav-link">
                                <i class="right fa fa-angle-right"></i>
                                <p>Listar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/formatos" class="nav-link">
                                <i class="right fa fa-angle-right"></i>
                                <p>Formatos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-pie-chart"></i>
                        <p>
                            Reportes
                            <i class="fa fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="right fa fa-angle-right"></i>
                                <p>Practicas por Nivel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="right fa fa-angle-right"></i>
                                <p>Practicas por Horas</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>