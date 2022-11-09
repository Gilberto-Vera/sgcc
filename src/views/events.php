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
                                <tr class="text-center bg-secondary text-white">
                                    <th>Nome</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th>Situação</th>
                                    <th>Convidado</th>
                                    <th>Roteiro</th>
                                    <th>Parceiro</th>
                                    <th>Responsável</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($events as $event) { ?>
                                    <tr>
                                        <td class="text-center align-middle py-2"><?= $event->name ?></td>
                                        <td class="text-center align-middle py-2"><?= $event->client ?></td>
                                        <td class="text-center align-middle py-2"><?= formatDate($event->data) ?></td>
                                        <td class="text-center align-middle py-2"><?= $event->situation ?></td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-warning text-dark btn-sm btn-block shadow-sm py-0 px-0" href="event_guest.php?event=<?= $event->id ?>">
                                            Convidados</a>
                                        </td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-warning text-dark btn-sm btn-block shadow-sm py-0 px-0" href="event_roadmap.php?event=<?= $event->id ?>">
                                            Roteiro</a>
                                        </td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-warning text-dark btn-sm btn-block shadow-sm py-0 px-0" href="event_partner.php?event=<?= $event->id ?>" >
                                            Parceiros</a>
                                        </td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-warning text-dark btn-sm btn-block shadow-sm py-0 px-0" href="event_manager.php?event=<?= $event->id ?>" >
                                            Responsável</a>
                                        </td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-warning btn-sm btn-block text-dark shadow-sm py-0 px-0" 
                                                href="edit_event.php?event=<?=$event->id?>">
                                                <i class="fas fa-fw fa-edit"></i></a>
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

