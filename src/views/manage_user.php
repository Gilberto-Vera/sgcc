<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Usuário</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1">Gerenciar usuário</h1>
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
                                    <div class="form-group form-floating mb-3">
                                        <input type="text" class="form-control
                                            <?= $errors['email'] ? 'is-invalid' : '' ?>" id="email"
                                            name="email" placeholder="Email" value="<?= $email ?>"
                                            <?= $disabledInput ? 'disabled' : ''?>>
                                        <label for="name">Email</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['email'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-0 mb-2">
                                        <div class="form-floating col-6 pl-0 mb-2">
                                            <input type="text" class="form-control
                                                <?= $errors['phone'] ? 'is-invalid' : '' ?>" id="phone"
                                                name="phone" placeholder="Telefone" value="<?= $phone ?>">
                                                <label for="name">Telefone</label>
                                                <div class="invalid-feedback">
                                                    <?= $errors['phone'] ?>
                                                </div>
                                        </div>
                                        <div class="form-floating col-6 mb-2 px-0">
                                            <select class="form-control
                                                <?= $errors['role'] ? 'is-invalid' : '' ?>"
                                                name="role">
                                                <option value="">Selecione...</option>
                                                <?php
                                                    foreach($roles as $role) {
                                                        $selected = $role->id === $selectedRoleId ? 'selected' : '';
                                                        echo "<option value='{$role->id}' {$selected}>{$role->descricao}</option>";
                                                    }
                                                ?>
                                            </select>
                                            <label for="name">Função</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['role'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-0 mb-2">
                                        <div class="form-floating col-6 mb-3 pl-0">
                                            <input type="password" class="form-control
                                                <?= $errors['password'] ? 'is-invalid' : '' ?>" id="password"
                                                name="password" placeholder="Senha" autocomplete="on">
                                            <label for="name">Senha</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['password'] ?>
                                            </div>
                                        </div>
                                        <div class="form-floating col-6 mb-3 px-0">
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
                                            <a href="user.php" class="btn btn-primary">Listar Clientes</a>
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