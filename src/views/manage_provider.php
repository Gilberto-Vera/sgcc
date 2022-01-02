<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Fornecedor</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1">Gerenciar fornecedor</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control rounded-pill
                                            <?= $errors['corporate_name'] ? 'is-invalid' : '' ?>"
                                            name="corporate_name" placeholder="Razão Social" value="<?= $corporate_name ?>">
                                            <div class="invalid-feedback">
                                                <?= $errors['corporate_name'] ?>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control rounded-pill
                                            <?= $errors['business_name'] ? 'is-invalid' : '' ?>"
                                            name="business_name" placeholder="Nome Fantasia" value="<?= $business_name ?>">
                                            <div class="invalid-feedback">
                                                <?= $errors['business_name'] ?>
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control rounded-pill
                                            <?= $errors['cnpj'] ? 'is-invalid' : '' ?>"
                                                name="cnpj" placeholder="CNPJ" value="<?= $cnpj ?>"
                                                <?= $disabledInput ? 'disabled' : ''?>>
                                                <div class="invalid-feedback">
                                                    <?= $errors['cnpj'] ?>
                                                </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control rounded-pill
                                            <?= $errors['phone'] ? 'is-invalid' : '' ?>"
                                                name="phone" placeholder="Telefone" value="<?= $phone ?>">
                                                <div class="invalid-feedback">
                                                    <?= $errors['phone'] ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control rounded-pill
                                        <?= $errors['address'] ? 'is-invalid' : '' ?>"
                                            name="address" placeholder="Endereço" value="<?= $address ?>">
                                                <div class="invalid-feedback">
                                                    <?= $errors['address'] ?>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control rounded-pill
                                        <?= $errors['email'] ? 'is-invalid' : '' ?>"
                                            name="email" placeholder="Email" value="<?= $email ?>"
                                            <?= $disabledInput ? 'disabled' : ''?>>
                                                <div class="invalid-feedback">
                                                    <?= $errors['email'] ?>
                                                </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control rounded-pill
                                            <?= $errors['contact'] ? 'is-invalid' : '' ?>"
                                                name="contact" placeholder="Contato" value="<?= $contact ?>">
                                                    <div class="invalid-feedback">
                                                        <?= $errors['contact'] ?>
                                                    </div>
                                        </div>
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <select class="form-control rounded-pill
                                                <?= $errors['service_id'] ? 'is-invalid' : '' ?>"
                                                name="service_id">
                                                <option value="">Selecione um serviço...</option>
                                                <?php
                                                    foreach($services as $service) {
                                                        $selected = $service->id === $selectedServiceId ? 'selected' : '';
                                                        echo "<option value='{$service->id}' {$selected}>{$service->servico}</option>";
                                                    }
                                                ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                <?= $errors['service_id'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="provider.php" class="btn btn-secondary btn-user">Listar Fornecedores</a>
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