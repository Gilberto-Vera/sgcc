<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header">
                    <h4 class="mb-0 ml-2 font-weight-bold text-primary">Roteiros</h4>
                </div>
                <div class="table-responsive">
                    <div class="card-body">
                        <div class="mb-0 card-title text-center">
                            <h1 class="h4 text-gray-900 my-0">Lista de modelo de roteiros</h1>
                        </div>
                        <div class="container-fluid pt-1 pb-3 px-3">
                            <div class="row align-items-center">
                                <div class="col pr-0">
                                    <a href="event_roadmap.php?event=<?= $eventId ?>" class="btn btn-primary">
                                        </i> Voltar </a>
                                </div>
                            </div>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-secondary text-white">
                                    <th>Nome</th>
                                    <th>Hora</th>
                                    <th>Sequência</th>
                                    <th>Incluir</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($roadmaps as $roadmap) { ?>
                                    <tr>
                                        <td class="align-middle py-2"><?= $roadmap->name ?></td>
                                        <td class="align-middle text-center py-2">
                                            <?= !$roadmap->minute ? $roadmap->hour . ':' . '00' : $roadmap->hour . ':' . $roadmap->minute ?></td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-primary btn-sm btn-block shadow-sm py-0 px-0" 
                                                href="sequence_model.php?roadmap=<?= $roadmap->id ?>&event=<?= $eventId ?>">
                                                Sequência</a>
                                        </td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-primary btn-sm btn-block shadow-sm py-0 px-0" data-toggle="modal"
                                                data-target="#modal_import_model" data-roadmapid="<?= $roadmap->id ?>" data-eventid="<?= $eventId ?>">Modelo</a>
                                        </td>
                                        <td class="text-center py-2 align-middle">
                                            <a class="btn btn-outline-danger btn-sm btn-block text-dark shadow-sm py-0 px-0" data-toggle="modal" 
                                                data-target="#modal_model_del" data-id="<?= $roadmap->id ?>" data-eventid="<?= $eventId ?>">
                                                <i class="fas fa-fw fa-eraser"></i></a>
                                        </td>
                                    </tr>						
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modal_model_del" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Remover roteiro</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de deseja remover este roteiro?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" 
                                        autofocus>Voltar</button>
                                    <a class="btn btn-primary" id="remove">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal_import_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Incluir Roteiro</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Deseja incluir este modelo no roteiro?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" 
                                        autofocus>Voltar</button>
                                    <a class="btn btn-primary" id="save">Incluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

