<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Cliente</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 my-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1">Cadastrar cliente</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user
                                            <?= $errors['name'] ? 'is-invalid' : '' ?>" id="name"
                                            name="name" placeholder="Nome" value="<?= $name ?>">
                                            <div class="invalid-feedback">
                                                <?= $errors['name'] ?>
                                            </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user
                                            <?= $errors['cpf'] ? 'is-invalid' : '' ?>" id="cpf"
                                                name="cpf" placeholder="CPF" value="<?= $cpf ?>">
                                                <div class="invalid-feedback">
                                                    <?= $errors['cpf'] ?>
                                                </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user
                                            <?= $errors['phone'] ? 'is-invalid' : '' ?>" id="phone"
                                                name="phone" placeholder="Telefone" value="<?= $phone ?>">
                                                <div class="invalid-feedback">
                                                    <?= $errors['phone'] ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user
                                        <?= $errors['address'] ? 'is-invalid' : '' ?>" id="address"
                                            name="address" placeholder="Endereço" value="<?= $address ?>">
                                                <div class="invalid-feedback">
                                                    <?= $errors['address'] ?>
                                                </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user
                                        <?= $errors['email'] ? 'is-invalid' : '' ?>" id="email"
                                            name="email" placeholder="Email" value="<?= $email ?>">
                                                <div class="invalid-feedback">
                                                    <?= $errors['email'] ?>
                                                </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user
                                            <?= $errors['password'] ? 'is-invalid' : '' ?>" id="password"
                                            name="password" placeholder="Senha" autocomplete="on">
                                                <div class="invalid-feedback">
                                                    <?= $errors['password'] ?>
                                                </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user
                                            <?= $errors['confirm_password'] ? 'is-invalid' : '' ?>" id="confirm_password"
                                            name="confirm_password" placeholder="Confirmar Senha" autocomplete="on">
                                                <div class="invalid-feedback">
                                                    <?= $errors['confirm_password'] ?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <button class="btn btn-secondary btn-user" type="button" id="clear_client">Limpar</button>
                                        </div>
                                        <div class="col text-right">
                                            <button class="btn btn-primary btn-user" type="submit" id="save_add_client">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#clear_client").click(function(){
            const fields = ['name', 'cpf', 'phone', 'address', 'email', 'password', 'confirmPassword'];
            fields.forEach(function(element){
                    $("#" + element).removeClass('is-invalid');
                    $("#" + element).removeClass('is-valid');
                    $("#" + element).val('');
                    $("#feedback_" + element).html('');
            });
        });
    });
</script>