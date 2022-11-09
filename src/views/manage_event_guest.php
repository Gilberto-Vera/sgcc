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
                                    <div class="form-group form-floating">
                                        <input type="text" class="form-control
                                            <?= $errors['name'] ? 'is-invalid' : '' ?>" id="name"
                                            name="name" placeholder="Nome" value="<?= $name ?>">
                                        <label for="providerName">Nome</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['name'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating">
                                        <input type="text" class="form-control
                                            <?= $errors['email'] ? 'is-invalid' : '' ?>" id="email"
                                            name="email" placeholder="Email" value="<?= $email ?>"
                                            <?= $disabledInput ? 'disabled' : ''?>>
                                        <label for="providerName">Email</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['email'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 ml-0">
                                        <div class="form-floating col-4 pl-0">
                                            <input type="text" class="form-control
                                                <?= $errors['phone'] ? 'is-invalid' : '' ?>" id="phone"
                                                name="phone" placeholder="Telefone" value="<?= $phone ?>">
                                            <label for="providerName">Telefone</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['phone'] ?>
                                            </div>
                                        </div>
                                        <div class="form-floating col-4 px-0">
                                            <input type="text" class="form-control
                                                <?= $errors['num_accompany'] ? 'is-invalid' : '' ?>" id="num_accompany"
                                                name="num_accompany" placeholder="Números de acompanhantes" value="<?= $num_accompany ?>">
                                            <label for="providerName">Número de acompanhantes</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['num_accompany'] ?>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="search-btn btn-group btn-group-toggle btn-block
                                                <?= $errors['confirm'] ? 'is-invalid' : '' ?>" data-toggle="buttons">
                                                <label class="btn btn-outline-success pt-3">
                                                    <input type="radio" name="confirm" id="radio1" value="t"
                                                    <?= $confirm == 't' ? 'checked' : '' ?>> Confirmado
                                                </label>
                                                <label class="btn btn-outline-danger pt-3">
                                                    <input type="radio" name="confirm" id="radio2" value="f"
                                                    <?= $confirm == 'f' ? 'checked' : '' ?>> Não confirmado
                                                </label>
                                            </div>
                                            <div class="invalid-feedback">
                                                <?= $errors['confirm'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="event_guest.php?event=<?= $event_id ?>" class="btn btn-primary">Voltar</a>
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