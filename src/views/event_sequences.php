<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header">
                    <h4 class="mb-0 ml-2 font-weight-bold text-primary">Sequências</h4>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="mb-0 card-title text-center">
                            <h1 class="h4 text-gray-900 my-0">Lista de sequências</h1>
                        </div>
                        <div class="container-fluid pt-1 pb-3 px-3">
                            <div class="row">
                                <div class="col pr-0">
                                    <a href="event_roadmap.php?event=<?= $eventId ?>" class="btn btn-primary"> Voltar </a>
                                </div>
                                <div class="col pr-0"></div>
                                <div class="col pl-0 text-right">
                                    <a href="manage_event_sequence.php?roadmap=<?= $roadmapId ?>&event=<?= $eventId ?>"
                                        class="btn btn-primary">
                                        <!-- <i class="fas fa-fw fa-plus"></i>  -->
                                        Cadastrar sequência</a>
                                </div>
                            </div>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-secondary text-white">
                                    <th>Ordem</th>
                                    <th>Descrição</th>
                                    <th>Observação</th>
                                    <th>Editar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sequences as $sequence) { ?>
                                    <tr>
                                        <td class="text-center align-middle py-2"><?= $sequence->order ?></td>
                                        <td class="align-middle py-2"><?= $sequence->description ?></td>
                                        <td class="align-middle py-2"><?= $sequence->note ?></td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-warning btn-sm btn-block text-dark shadow-sm py-0 px-0" 
                                                href="manage_event_sequence.php?update=<?= $sequence->id ?>&roadmap=<?= $roadmapId ?>&event=<?= $eventId ?>">
                                                <i class="fas fa-fw fa-edit"></i></a>
                                        </td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-danger btn-sm btn-block text-dark shadow-sm py-0 px-0" data-toggle="modal" 
                                                data-target="#modal_del" data-id="<?= $sequence->id ?>">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Remover sequência</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de deseja remover esta sequência?
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

