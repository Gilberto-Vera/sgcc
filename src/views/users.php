<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header">
                    <h4 class="mb-0 ml-2 font-weight-bold text-primary">Usuário</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-0 card-title text-center">
                            <h1 class="h4 text-gray-900 my-2">Listar usuários</h1>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-secondary text-white">
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Editar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) { ?>
                                    <tr>
                                        <td class="align-middle"><?= $user->nome ?></td>
                                        <td class="text-center align-middle"><?= $user->telefone ?></td>
                                        <td class="align-middle"><?= $user->email ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning btn-sm rounded-circle" href="manage_user.php?update=<?= $user->id ?>">
                                            <i class="fas fa-fw fa-edit"></i></a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-danger btn-sm rounded-circle" href="#" data-toggle="modal" 
                                                data-target="#modal_del" data-id="<?= $user->id ?>">
                                            <i class="fas fa-fw fa-eraser"></i></a>
                                        </td>
                                    </tr>						
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modal_del" tabindex="-1" aria-labelledby="exampleModalLabel" 
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Remover usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de deseja remover este usuario?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        autofocus>Voltar</button>
                                    <a class="btn btn-primary" id="remove">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

