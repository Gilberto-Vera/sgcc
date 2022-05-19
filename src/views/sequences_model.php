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
                            <h1 class="h4 text-gray-900 my-0">Lista de modelo de sequências</h1>
                        </div>
                        <div class="container-fluid pt-1 pb-3 px-3">
                            <div class="row">
                                <div class="col pr-0">
                                    <a href="roadmap_model.php?event=<?= $eventId ?>" class="btn btn-secondary btn-sm btn-user">
                                        </i> Voltar </a>
                                </div>
                                <div class="col pr-0"></div>
                                <div class="col pl-0 text-right">
                                </div>
                            </div>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-light text-dark">
                                    <th>Ordem</th>
                                    <th>Descrição</th>
                                    <th>Observação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($sequences as $sequence) { ?>
                                    <tr>
                                        <td class="text-center align-middle"><?= $sequence->order ?></td>
                                        <td class="align-middle"><?= $sequence->description ?></td>
                                        <td class="align-middle"><?= $sequence->note ?></td>
                                    </tr>						
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </div>

