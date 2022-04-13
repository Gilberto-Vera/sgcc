<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header">
                    <h4 class="mb-0 ml-2 font-weight-bold text-primary">Convidados</h4>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="mb-0 card-title text-center">
                            <h1 class="h4 text-gray-900 my-0">Lista de convidados</h1>
                        </div>
                        <div class="container-fluid pt-1 pb-3 px-3">
                            <div class="row align-items-center">
                                <div class="col pl-0">
                                    <a href="manage_event_guest.php?event=<?= $event_id ?>" class="btn btn-primary btn-sm btn-user">
                                        <i class="fas fa-fw fa-plus"></i> Cadastrar convidado</a>
                                </div>
                                <div class="col pr-0">
                                    <table class="table-bordered" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr class="text-center bg-secondary text-white">
                                                <th>Estimados</th>
                                                <th>Confirmados</th>
                                                <th>Não Confirmados</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center align-middle"><?= $guestsTotal[0]->initial ?></td>
                                                <td class="text-center align-middle"><?= $guestsTotal[0]->confirmed ?></td>
                                                <td class="text-center align-middle"><?= $guestsTotal[0]->guests - $guestsTotal[0]->confirmed ?></td>
                                                <td class="text-center align-middle"><?= $guestsTotal[0]->guests ?></td>
                                            </tr>						
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-secondary text-white">
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Acompanhantes</th>
                                    <th>Confirmado</th>
                                    <th>Editar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($guests as $guest) { ?>
                                    <tr>
                                        <td class="align-middle"><?= $guest->name ?></td>
                                        <td class="text-center align-middle"><?= $guest->phone ?></td>
                                        <td class="text-center align-middle"><?= $guest->num_accompany ?></td>
                                        <td class="text-center py-0 align-middle"><?= $guest->confirm == 't' ? 
                                            '<i class="fas fa-fw fa-check align-middle confirm">' : 
                                            '<i class="fas fa-fw fa-times align-middle no_confirm">' ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning btn-sm rounded-circle" 
                                                href="manage_event_guest.php?update=<?= $guest->id ?>&event=<?= $event_id ?>">
                                                <i class="fas fa-fw fa-edit"></i></a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-danger btn-sm rounded-circle" data-toggle="modal" 
                                                data-target="#modal_del" data-id="<?= $guest->id ?>">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Remover convidado</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de deseja remover este convidado?
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

