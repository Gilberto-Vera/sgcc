<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Sequência</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1"></i>Gerenciar sequência</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="roadmapId" value="<?= $roadmapId ?>">
                                    <input type="hidden" name="eventId" value="<?= $eventId ?>">
                                    <input type="hidden" name="order" value="<?= $order ?>">
                                    <div class="form-group row mb-3 ml-0">
                                        <div class="form-floating col-6 px-0">
                                            <input type="text" class="form-control
                                                <?= $errors['description'] ? 'is-invalid' : '' ?>" id="description"
                                                name="description" placeholder="Descrição" value="<?= $description ?>">
                                            <label for="name">Descrição</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['description'] ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-floating">
                                        <input type="text" class="form-control
                                            <?= $errors['note'] ? 'is-invalid' : '' ?>" id="note"
                                            name="note" placeholder="Observação" value="<?= $note ?>">
                                            <label for="name">Observação</label>
                                        <div class="invalid-feedback">
                                            <?= $errors['note'] ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="event_sequence.php?roadmap=<?= $roadmapId ?>&event=<?= $eventId ?>"
                                                class="btn btn-primary"> Voltar </a>
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