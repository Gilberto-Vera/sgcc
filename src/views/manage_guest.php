<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Convidado</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1">Gerenciar convidado</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="event_id" value="<?= $event_id ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control rounded-pill
                                            <?= $errors['name'] ? 'is-invalid' : '' ?>" id="name"
                                            name="name" placeholder="Nome" value="<?= $name ?>">
                                        <div class="invalid-feedback">
                                            <?= $errors['name'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control rounded-pill
                                            <?= $errors['email'] ? 'is-invalid' : '' ?>" id="email"
                                            name="email" placeholder="Email" value="<?= $email ?>"
                                            <?= $disabledInput ? 'disabled' : ''?>>
                                        <div class="invalid-feedback">
                                            <?= $errors['email'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4 mb-3 mb-sm-0">
                                            <input type="text" class="form-control rounded-pill
                                                <?= $errors['phone'] ? 'is-invalid' : '' ?>" id="phone"
                                                name="phone" placeholder="Telefone" value="<?= $phone ?>">
                                            <div class="invalid-feedback">
                                                <?= $errors['phone'] ?>
                                            </div>
                                        </div>
                                        <div class="col-4 mb-3 mb-sm-0">
                                            <input type="text" class="form-control rounded-pill
                                                <?= $errors['num_accompany'] ? 'is-invalid' : '' ?>" id="num_accompany"
                                                name="num_accompany" placeholder="Números de acompanhantes" value="<?= $num_accompany ?>">
                                            <div class="invalid-feedback">
                                                <?= $errors['num_accompany'] ?>
                                            </div>
                                        </div>
                                        <div class="col-2 pt-3 text-right">
                                            Confirmar presença?
                                        </div>
                                        <div class="col-1 pt-3 form-check text-center">
                                            <input type="radio" class="form-check-input
                                                <?= $errors['confirm'] ? 'is-invalid' : '' ?>" id="radio1" name="confirm" value="t"
                                                <?= $confirm == 't' ? 'checked' : '' ?>>
                                            <label for="radio1">Sim</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['confirm'] ?>
                                            </div>
                                        </div>
                                        <div class="col-1 pt-3 form-check text-left">
                                            <input type="radio" class="form-check-input
                                                <?= $errors['confirm'] ? 'is-invalid' : '' ?>" id="radio2" name="confirm" value="f"
                                                <?= $confirm == 'f' ? 'checked' : '' ?>>
                                            <label for="radio2">Não</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['confirm'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="event_guest.php?event=<?= $event_id ?>" class="btn btn-secondary btn-user">Listar convidados</a>
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