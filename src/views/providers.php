<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header">
                    <h4 class="mb-0 ml-2 font-weight-bold text-primary">Fornecedor</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-0 card-title text-center">
                            <h1 class="h4 text-gray-900 my-2">Lista de Fornecedores</h1>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>Nome</th>
                                    <th>Contato</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Serviço</th>
                                    <th>Editar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($providers as $provider) { ?>
                                    <tr>
                                        <td><?= $provider->business_name ?></td>
                                        <td class="align-middle"><?= $provider->contact ?></td>
                                        <td class="text-center align-middle"><?= $provider->phone ?></td>
                                        <td class="align-middle"><?= $provider->email ?></td>
                                        <td class="align-middle"><?= $provider->service ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning btn-sm rounded-circle" 
                                                href="manage_provider.php?update=<?= $provider->id ?>">
                                                <i class="fas fa-fw fa-edit"></i></a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-danger btn-sm rounded-circle" data-toggle="modal" 
                                                data-target="#modal_del" data-id="<?= $provider->id ?>">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Remover fornecedor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de deseja remover este fornecedor?
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
