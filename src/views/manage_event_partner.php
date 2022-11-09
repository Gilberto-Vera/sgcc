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
                                    <div class="form-group row mb-2">
                                        <div class="form-floating col-3 pl-0">
                                            <input type="text" class="form-control
                                                <?= $errors['business_name'] ? 'is-invalid' : '' ?>"
                                                    name="business_name" placeholder="Nome Fantasia" value="<?= $business_name ?>"
                                                    <?= $disabledInput ? 'disabled' : ''?>>
                                                <label for="providerName">Nome Fantasia</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['business_name'] ?>
                                                </div>
                                        </div>
                                        <div class="form-floating col-3 pl-0">
                                            <select class="form-control
                                                <?= $errors['service_id'] ? 'is-invalid' : '' ?>" name="service_id">
                                                    <option value=''>Selecione...</option>
                                                    <?php
                                                        foreach($services as $service) {
                                                            $selected = $service->id === $selectedServiceId ? 'selected' : '';
                                                            echo "<option value='{$service->id}' {$selected}>{$service->service}</option>";
                                                        }
                                                ?>
                                            </select>
                                            <label for="providerName">Serviço</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['service_id'] ?>
                                            </div>
                                        </div>
                                        <div class="form-floating col-2 px-0">
                                            <input type="text" class="form-control
                                                <?= $errors['num_collaborators'] ? 'is-invalid' : '' ?>" id="num_collaborators"
                                                name="num_collaborators" placeholder="Número de colaboradores" value="<?= $num_collaborators ?>">
                                            <label for="providerName">Número de colaboradores</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['num_collaborators'] ?>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="search-btn btn-group btn-group-toggle btn-block
                                                <?= $errors['situation'] ? 'is-invalid' : '' ?>" data-toggle="buttons">
                                                <label class="btn btn-outline-success pt-3">
                                                    <input type="radio" name="situation" id="radio1" value="t"
                                                    <?= $situation == 't' ? 'checked' : '' ?>> confirmado
                                                </label>
                                                <label class="btn btn-outline-danger pt-3">
                                                    <input type="radio" name="situation" id="radio2" value="f"
                                                    <?= $situation == 'f' ? 'checked' : '' ?>> Não confirmado
                                                </label>
                                            </div>
                                            <div class="invalid-feedback">
                                                <?= $errors['situation'] ?>
                                            </div>
                                        </div>
                                        <!-- <div class="col-4">
                                            <input type="radio" class="form-check-input
                                                <?= $errors['situation'] ? 'is-invalid' : '' ?>" id="radio1" name="situation" value="t"
                                                <?= $situation == 't' ? 'checked' : '' ?>>
                                            <label for="radio1">Sim</label>
                                            <input type="radio" class="form-check-input
                                                <?= $errors['situation'] ? 'is-invalid' : '' ?>" id="radio2" name="situation" value="f"
                                                <?= $situation == 'f' ? 'checked' : '' ?>>
                                            <label for="radio2">Não</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['situation'] ?>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="event_partner.php?event=<?= $eventId ?>" class="btn btn-primary">
                                                <!-- <i class="fas fa-solid fa-angle-left text-success"></i>  -->
                                                Voltar </a>
                                        </div>
                                        <div class="col text-center">
                                            <button class="btn btn-success" type="submit">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>