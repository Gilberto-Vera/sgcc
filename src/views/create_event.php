<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Evento</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1">Criar evento</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="clientId" value="<?= $clientId ?>">
                                    <input type="hidden" name="providerId" value="<?= $providerId ?>">
                                    <input type="hidden" name="userId" value="<?= $userId ?>">
                                    <input type="hidden" name="serviceId" value="<?= $serviceId ?>">
                                    <div class="form-group">
                                        <div class="form-group mx-0 mb-4">
                                            <div class="form-floating pl-0">
                                                <input type="text" class="form-control
                                                    <?= $errors['name'] ? 'is-invalid' : '' ?>" id="name"
                                                    name="name" placeholder="Nome" value="<?= $name ?>">
                                                <label for="name">Nome</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['name'] ?>
                                                </div>
                                            </div>
                                        </div>    
                                        <div class="form-group row mx-0 mb-2">
                                            <div class="col-3 form-floating pl-0 mb-3">
                                                <input type="text" class="form-control
                                                    <?= $errors['date'] ? 'is-invalid' : '' ?>" id="date"
                                                    name="date" placeholder="Data" value="<?= $date ?>">
                                                <label for="date">Data</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['date'] ?>
                                                </div>
                                            </div>
                                            <div class="col-7 form-floating pl-0 pr-1 mb-3">
                                                <input type="text" class="form-control
                                                    <?= $errors['clientName'] ? 'is-invalid' : '' ?>" id="clientName"
                                                    name="clientName" placeholder="Cliente" value="<?= $clientName ?>">
                                                <label for="clientName">Noiva</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['clientName'] ?>
                                                </div>
                                            </div>
                                            <div class="col-2 pl-1 pr-0 mb-3">
                                                <button type="submit" class="search-btn btn btn-outline-primary btn-block"
                                                    formaction="include_client_event.php">
                                                    Pesquisar cliente
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-0 mb-0">
                                            <div class="col-3 form-floating pl-0">
                                                <input type="text" class="form-control
                                                    <?= $errors['numGuests'] ? 'is-invalid' : '' ?>" id="numGuests"
                                                    name="numGuests" placeholder="Convidados" value="<?= $numGuests ?>">
                                                <label for="numGuests">Convidados *</label>
                                                <small class="form-text text-muted">* Número aproximado de convidados</small>
                                                <div class="invalid-feedback">
                                                    <?= $errors['numGuests'] ?>
                                                </div>
                                            </div>
                                            <div class="col-7 form-floating pl-0 pr-1">
                                                <input type="text" class="form-control
                                                    <?= $errors['providerName'] ? 'is-invalid' : '' ?>" id="providerName"
                                                    name="providerName" placeholder="Local" value="<?= $providerName ?>">
                                                <label for="providerName">Local</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['providerName'] ?>
                                                </div>
                                            </div>
                                            <div class="col-2 pl-1 pr-0 pb-3 mb-2">
                                                <button type="submit" class="search-btn btn btn-outline-primary btn-block"
                                                    formaction="include_place_event.php">
                                                    Pesquisar local
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group row mx-0 mb-3">
                                            <div class="col-3 form-floating pl-0">
                                                <select class="form-control <?= $errors['situation'] ? 'is-invalid' : '' ?>" 
                                                    id="situation" name="situation">
                                                    <option value="">Selecione uma situação</option>
                                                    <?php
                                                        foreach($situations as $situation) {
                                                            $selected = $situation->id === $selectedSituationId ? 'selected' : '';
                                                            echo "<option value='{$situation->id}' {$selected}>{$situation->description}</option>";
                                                        }
                                                        ?>
                                                </select>
                                                <label for="situation">Situação</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['situation'] ?>
                                                </div>
                                            </div>
                                            <div class="col-7 form-floating pl-0 pr-1">
                                                <input type="text" class="form-control
                                                    <?= $errors['userName'] ? 'is-invalid' : '' ?>" Name="userName"
                                                    name="userName" placeholder="Local" value="<?= $userName ?>">
                                                <label for="userName">Responsável **</label>
                                                <small class="form-text text-muted">** Usuário responsável pelo evento</small>
                                                <div class="invalid-feedback">
                                                    <?= $errors['userName'] ?>
                                                </div>
                                            </div>
                                            <div class="col-2 pl-1 pr-0 pb-3 mb-2">
                                                <button type="submit" class="search-btn btn btn-outline-primary btn-block"
                                                    formaction="include_event_manager.php">
                                                    Pesquisar usuário
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <a href="event.php" class="btn btn-secondary">Voltar</a>
                                            </div>
                                            <div class="col text-center">
                                                <button class="btn btn-primary" type="submit">Salvar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>