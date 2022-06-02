<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow mt-4 mb-4">
                <div class="card-header">
                    <h4 class="mb-0 ml-2 font-weight-bold text-primary">Parceiro</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="mb-0 card-title text-center">
                            <h1 class="h4 text-gray-900 my-2">Incluir Parceiros no Evento</h1>
                        </div>
                        <div class="container-fluid pt-1 pb-3 px-3">
                            <div class="row align-items-center">
                                <div class="col pr-0">
                                    <a href="event_partner.php?event=<?= $eventId ?>" class="btn btn-light btn-sm btn-user">
                                    <i class="fas fa-solid fa-angle-left text-success"></i> Voltar </a>
                                </div>
                                <div class="col pr-0 text-center">
                                </div>
                            </div>
                        </div>
                        <?php include(TEMPLATE_PATH . '/messages.php') ?>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-secondary text-white">
                                    <th>Nome</th>
                                    <th>Serviço</th>
                                    <th>Incluir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($includeEventPartners as $includeEventPartner) { ?>
                                    <tr>
                                        <td class="align-middle"><?= $includeEventPartner->business_name ?></td>
                                        <td class="text-center align-middle"><?= $includeEventPartner->service ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning text-dark btn-sm btn-block" 
                                                href="manage_event_partner.php?event=<?= $eventId ?>&partner=<?= $includeEventPartner->id ?>" >
                                            Fornecedor</a>
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
                                    <h5 class="modal-title" id="exampleModalLabel">Remover parceiro do evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">x</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    Tem certeza de deseja remover este parceiro?
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
