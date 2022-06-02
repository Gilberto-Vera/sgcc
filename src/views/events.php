<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header">
                    <h4 class="mb-0 ml-2 font-weight-bold text-primary">Evento</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-0 card-title text-center">
                            <h1 class="h4 text-gray-900 my-2">Lista de Eventos</h1>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center ">
                                    <th class="align-middle bg-secondary text-white">Nome</th>
                                    <th class="align-middle bg-secondary text-white">Data</th>
                                    <th class="align-middle bg-secondary text-white" colspan="3">Gerenciar</th>
                                    <th class="align-middle bg-secondary text-white">Editar</th>
                                    <th class="align-middle bg-secondary text-white">Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($events as $event) { ?>
                                    <tr>
                                        <td class="align-middle"><?= $event->name ?></td>
                                        <td class="text-center align-middle"><?= formatDate($event->data) ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning text-dark btn-sm btn-block" href="event_guest.php?event=<?= $event->id ?>">
                                            Convidados</a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning text-dark btn-sm btn-block" href="event_roadmap.php?event=<?= $event->id ?>">
                                            Roteiro</a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning text-dark btn-sm btn-block" href="event_partner.php?event=<?= $event->id ?>" >
                                            Parceiros</a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning btn-sm rounded-circle text-dark" 
                                                href="manage_event.php?update=<?= $guest->id ?>&event=<?= $event_id ?>">
                                                <i class="fas fa-fw fa-edit"></i></a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-danger btn-sm rounded-circle" href="#" data-toggle="modal" 
                                                data-target="#modal_del" data-id="<?= $event->id ?>">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Remover evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de deseja remover este evento?
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

