<div class="navbar navbar-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo Uri::base(false); ?>admin">SGAE :: FATEC</a>
            <div class="nav-collapse">
                <ul class="nav">
                    <li><a href="<?php echo Uri::base(false); ?>admin">Home</a></li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastrar <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="admin/cadastrar/atividades">Atividades</a></li>
                        <li><a href="admin/cadastrar/cursos">Cursos</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gerenciar <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="admin/gerenciar/alunos">Alunos</a></li>
                        <li><a href="admin/gerenciar/atividades">Atividades</a></li>
                        <li><a href="admin/gerenciar/cursos">Cursos</a></li>
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="admin/atividades-alunos/busca">Atividades/Alunos</a>
                    </li>
                    <li><a href="admin/relatorio">Gerar Relatórios</a></li>
                    <li><a href="admin/logout">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>