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
                            <h1 class="h4 text-gray-900 my-0">Lista de roteiros</h1>
                        </div>
                        <div class="container-fluid pt-1 pb-3 px-3">
                            <div class="row align-items-center">
                                <div class="col pl-0">
                                    <a href="manage_event_roadmap.php?event=<?= $event_id ?>" class="btn btn-primary btn-sm btn-user">
                                        <i class="fas fa-fw fa-plus"></i> Cadastrar roteiro</a>
                                </div>
                                <div class="col pr-0">
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
                                    <th>Editar</th>
                                    <th>Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($roadmaps as $roadmap) { ?>
                                    <tr>
                                        <td class="align-middle"><?= $roadmap->name ?></td>
                                        <td class="align-middle text-center">
                                            <?= !$roadmap->minute ? $roadmap->hour . ':' . '00' : $roadmap->hour . ':' . $roadmap->minute ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-primary btn-sm btn-block" href="#">Sequência</a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning btn-sm rounded-circle" 
                                                href="manage_event_roadmap.php?update=<?= $roadmap->id ?>&event=<?= $event_id ?>">
                                                <i class="fas fa-fw fa-edit"></i></a>
                                        </td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-danger btn-sm rounded-circle" data-toggle="modal" 
                                                data-target="#modal_del" data-id="<?= $roadmap->id ?>">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Remover roteiro</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
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
                </div>
            </div>  
        </div>
    </div>

