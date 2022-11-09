<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Cliente</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1">Gerenciar cliente</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <div class="form-group form-floating mb-3">
                                        <input type="text" class="form-control
                                            <?= $errors['name'] ? 'is-invalid' : '' ?>" id="name"
                                            name="name" placeholder="Nome" value="<?= $name ?>">
                                            <label for="name">Nome</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['name'] ?>
                                            </div>
                                    </div>
                                    <div class="form-group row mx-0 mb-2">
                                        <div class="form-floating col-6 mb-2 pl-0">
                                            <input type="text" class="form-control
                                            <?= $errors['cpf'] ? 'is-invalid' : '' ?>" id="cpf"
                                                name="cpf" placeholder="CPF" value="<?= $cpf ?>"
                                                <?= $disabledInput ? 'disabled' : ''?>>
                                                <label for="name">CPF</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['cpf'] ?>
                                                </div>
                                        </div>
                                        <div class="form-floating col-6 mb-2 px-0">
                                            <input type="text" class="form-control
                                            <?= $errors['phone'] ? 'is-invalid' : '' ?>" id="phone"
                                                name="phone" placeholder="Telefone" value="<?= $phone ?>">
                                                <label for="name">Telefone</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['phone'] ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating">
                                        <input type="text" class="form-control
                                        <?= $errors['address'] ? 'is-invalid' : '' ?>" id="address"
                                            name="address" placeholder="Endereço" value="<?= $address ?>">
                                                <label for="name">Endereço</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['address'] ?>
                                                </div>
                                    </div>
                                    <div class="form-group form-floating">
                                        <input type="text" class="form-control
                                        <?= $errors['email'] ? 'is-invalid' : '' ?>" id="email"
                                            name="email" placeholder="Email" value="<?= $email ?>"
                                            <?= $disabledInput ? 'disabled' : ''?>>
                                                <label for="name">Email</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['email'] ?>
                                                </div>
                                    </div>
                                    <div class="form-group row mx-0 mb-3">
                                        <div class="form-floating col-6 pl-0">
                                            <input type="password" class="form-control
                                            <?= $errors['password'] ? 'is-invalid' : '' ?>" id="password"
                                            name="password" placeholder="Senha" autocomplete="on">
                                                <label for="name">Senha</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['password'] ?>
                                                </div>
                                        </div>
                                        <div class="form-floating col-6 px-0">
                                            <input type="password" class="form-control
                                            <?= $errors['confirm_password'] ? 'is-invalid' : '' ?>" id="confirm_password"
                                            name="confirm_password" placeholder="Confirmar Senha" autocomplete="on">
                                                <label for="name">Confirmar Senha</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['confirm_password'] ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="client.php" class="btn btn-primary">Listar clientes</a>
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