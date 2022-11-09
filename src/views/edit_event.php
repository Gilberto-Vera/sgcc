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
                                    <h1 class="h4 text-gray-900 p-1">Editar evento</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <div class="form-group">
                                        <div class="form-group row mx-0 mb-3">
                                            <div class="col-8 form-floating pl-0">
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
                                            <div class="col-4 form-floating pl-0 pr-1">
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
                                        </div>
                                        <div class="row">
                                            <div class="col text-center">
                                                <a href="event.php" class="btn btn-primary">Voltar</a>
                                            </div>
                                            <div class="col text-center">
                                                <button class="btn btn-success" type="submit">Salvar</button>
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