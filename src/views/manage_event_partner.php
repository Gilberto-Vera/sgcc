<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Parceiro</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1">Gerenciar parceiro</h1>
                                </div>
                                <div class="container-fluid pt-1 pb-3 px-3">
                                    <div class="row align-items-center">
                                        <div class="col pr-0">
                                            <a href="event_partner.php?event=<?= $eventId ?>" class="btn btn-light btn-sm btn-user">
                                            <i class="fas fa-solid fa-angle-left text-success"></i> Voltar </a>
                                        </div>
                                        <div class="col pr-0 text-center">
                                        </div>
                                        <div class="col pl-0 text-right">
                                        </div>
                                    </div>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="provider_id" value="<?= $provider_id ?>">
                                    <input type="hidden" name="event_id" value="<?= $eventId ?>">
                                    <div class="form-group row">
                                        <div class="col-3 mb-3 mb-sm-0">
                                            <input type="text" class="form-control rounded-pill
                                                <?= $errors['business_name'] ? 'is-invalid' : '' ?>"
                                                name="business_name" placeholder="Nome Fantasia" value="<?= $business_name ?>"
                                                <?= $disabledInput ? 'disabled' : ''?>>
                                                <div class="invalid-feedback">
                                                    <?= $errors['business_name'] ?>
                                                </div>
                                        </div>
                                        <div class="col-3 mb-3 mb-sm-0">
                                            <select class="form-control rounded-pill
                                                <?= $errors['service_id'] ? 'is-invalid' : '' ?>" name="service_id">
                                                    <option value=''>Selecione um serviço...</option>
                                                    <?php
                                                        foreach($services as $service) {
                                                            $selected = $service->id === $selectedServiceId ? 'selected' : '';
                                                            echo "<option value='{$service->id}' {$selected}>{$service->service}</option>";
                                                        }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $errors['service_id'] ?>
                                            </div>
                                        </div>
                                        <div class="col-2 mb-3 mb-sm-0">
                                            <input type="text" class="form-control rounded-pill
                                                <?= $errors['num_collaborators'] ? 'is-invalid' : '' ?>" id="num_collaborators"
                                                name="num_collaborators" placeholder="Números de colaboradores" value="<?= $num_collaborators ?>">
                                            <div class="invalid-feedback">
                                                <?= $errors['num_collaborators'] ?>
                                            </div>
                                        </div>
                                        <div class="col-2 pt-3 text-center">
                                            Parceiro confirmado?
                                        </div>
                                        <div class="col-1 pt-3 form-check text-center">
                                            <input type="radio" class="form-check-input
                                                <?= $errors['situation'] ? 'is-invalid' : '' ?>" id="radio1" name="situation" value="t"
                                                <?= $situation == 't' ? 'checked' : '' ?>>
                                            <label for="radio1">Sim</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['situation'] ?>
                                            </div>
                                        </div>
                                        <div class="col-1 pt-3 form-check text-center">
                                            <input type="radio" class="form-check-input
                                                <?= $errors['situation'] ? 'is-invalid' : '' ?>" id="radio2" name="situation" value="f"
                                                <?= $situation == 'f' ? 'checked' : '' ?>>
                                            <label for="radio2">Não</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['situation'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                        </div>
                                        <div class="col text-center">
                                            <button class="btn btn-primary btn-user" type="submit">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>