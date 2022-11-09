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
                                    <div class="form-group form-floating mb-3">
                                        <input type="text" class="form-control
                                            <?= $errors['corporate_name'] ? 'is-invalid' : '' ?>"
                                            name="corporate_name" placeholder="Razão Social" value="<?= $corporate_name ?>">
                                        <label for="name">Razão Social</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['corporate_name'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating mb-3">
                                        <input type="text" class="form-control
                                            <?= $errors['business_name'] ? 'is-invalid' : '' ?>"
                                            name="business_name" placeholder="Nome Fantasia" value="<?= $business_name ?>">
                                        <label for="name">Nome Fantasia</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['business_name'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-0">
                                        <div class="form-floating col-6 mb-0 pl-0">
                                            <input type="text" class="form-control
                                                <?= $errors['cnpj'] ? 'is-invalid' : '' ?>"
                                                name="cnpj" placeholder="CNPJ" value="<?= $cnpj ?>"
                                                <?= $disabledInput ? 'disabled' : ''?>>
                                            <label for="name">CNPJ</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['cnpj'] ?>
                                            </div>
                                        </div>
                                        <div class="form-floating col-6 mb-0 px-0">
                                            <input type="text" class="form-control
                                                <?= $errors['phone'] ? 'is-invalid' : '' ?>"
                                                name="phone" placeholder="Telefone" value="<?= $phone ?>">
                                            <label for="name">Telefone</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['phone'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating mb-3">
                                        <input type="text" class="form-control
                                            <?= $errors['address'] ? 'is-invalid' : '' ?>"
                                            name="address" placeholder="Endereço" value="<?= $address ?>">
                                        <label for="name">Endereço</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['address'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating mb-3">
                                        <input type="text" class="form-control
                                            <?= $errors['email'] ? 'is-invalid' : '' ?>"
                                            name="email" placeholder="Email" value="<?= $email ?>"
                                            <?= $disabledInput ? 'disabled' : ''?>>
                                        <label for="name">Email</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['email'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-0 mb-2">
                                        <div class="form-floating col-6 mb-3 pl-0">
                                            <input type="text" class="form-control
                                                <?= $errors['contact'] ? 'is-invalid' : '' ?>"
                                                name="contact" placeholder="Contato" value="<?= $contact ?>">
                                            <label for="name">Contato</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['contact'] ?>
                                            </div>
                                        </div>
                                        <div class="form-floating col-6 mb-3 px-0">
                                            <select class="form-control
                                                <?= $errors['service_id'] ? 'is-invalid' : '' ?>"
                                                name="service_id">
                                                <option value="">Selecione...</option>
                                                <?php
                                                    foreach($services as $service) {
                                                        $selected = $service->id === $selectedServiceId ? 'selected' : '';
                                                        echo "<option value='{$service->id}' {$selected}>{$service->servico}</option>";
                                                    }
                                                ?>
                                            </select>
                                            <label for="name">Serviço</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['service_id'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="provider.php" class="btn btn-primary">Listar Fornecedores</a>
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