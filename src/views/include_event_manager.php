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
                            <h1 class="h4 text-gray-900 my-2">Incluir responsável pelo Evento</h1>
                        </div>
                        <div class="container-fluid pt-1 pb-3 px-3">
                            <div class="row align-items-center">
                                <div class="col pr-0">
                                    <a href="create_event.php?clientId=<?=$clientId?>&clientName=<?=$clientName?>&name=<?=$name?>&date=<?=$date?>&numGuests=<?=$numGuests?>&providerId=<?=$providerId?>&providerName=<?=$providerName?>&serviceId=<?=$serviceId?>&userName=<?=$userName?>&userId=<?=$userId?>&situation=<?=$situation?>"
                                        class="btn btn-light btn-sm btn-user">
                                    <i class="fas fa-solid fa-angle-left text-success"></i> Voltar </a>
                                </div>
                                <div class="col pr-0 text-center">
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center bg-secondary text-white">
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) { ?>
                                    <tr>
                                        <td class="align-middle"><?= $user->name ?></td>
                                        <td class="text-center align-middle"><?= $user->email ?></td>
                                        <td class="text-center py-0 align-middle">
                                            <a class="btn btn-warning text-dark btn-sm btn-block" 
                                                href="create_event.php?clientId=<?=$clientId?>&clientName=<?=$clientName?>&name=<?=$name?>&date=<?=$date?>&numGuests=<?=$numGuests?>&providerId=<?=$providerId?>&providerName=<?=$providerName?>&serviceId=<?=$serviceId?>&userName=<?=$user->name?>&userId=<?=$user->id?>&situation=<?=$situation?>">
                                                Incluir</a>
                                        </td>
                                    </tr>						
                                <?php }; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </div>
