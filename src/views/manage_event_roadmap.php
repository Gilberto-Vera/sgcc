<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <div class="container-fluid">
            <div class="card shadow my-4">
                <div class="card-header">
                    <h4 class="ml-2 mb-0 font-weight-bold text-primary">Roteiro</h4>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mx-3 mb-2">
                                <div class="mb-0 card-title text-center">
                                    <h1 class="h4 text-gray-900 p-1"></i>Gerenciar roteiro</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <input type="hidden" name="event_id" value="<?= $event_id ?>">
                                    <div class="form-group row mb-2">
                                        <div class="form-floating col-8 pl-0">
                                            <input type="text" class="form-control
                                                <?= $errors['name'] ? 'is-invalid' : '' ?>" id="name"
                                                name="name" placeholder="Nome" value="<?= $name ?>">
                                            <label for="name">Nome</label>
                                            <div class="invalid-feedback">
                                                <?= $errors['name'] ?>
                                            </div>
                                        </div>
                                        <div class="form-floating col-2 pl-0">
                                            <select class="form-control <?= $errors['hour'] ? 'is-invalid' : '' ?>"
                                                name="hour">
                                                <option value="">Hora</option>
                                                <?php
                                                    for ($i= 0; $i <= 23; $i++) {
                                                        $selected = (string)$i == $selectedHourId ? 'selected' : '';
                                                        if($i < 10){
                                                            echo "<option value='{$i}' {$selected}>0{$i}</option>";
                                                        }else {
                                                            echo "<option value='{$i}' {$selected}>{$i}</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="name">Hora</label>
                                            <div class="invalid-feedback"><?= $errors['hour'] ?></div>
                                        </div>
                                        <div class="form-floating col-2 pl-0">
                                            <select class="form-control <?= $errors['minute'] ? 'is-invalid' : '' ?>"
                                                name="minute">
                                                <option value="">Minuto</option>
                                                <?php
                                                    for ($i= 0; $i <= 55; $i+=5) {
                                                        $selected = (string)$i == $selectedMinuteId ? 'selected' : '';
                                                        if($i < 10){
                                                            echo "<option value='{$i}' {$selected}>0{$i}</option>";
                                                        }else {
                                                            echo "<option value='{$i}' {$selected}>{$i}</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="name">Minuto</label>
                                            <div class="invalid-feedback"><?= $errors['minute'] ?></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-center">
                                            <a href="event_roadmap.php?event=<?= $event_id ?>" class="btn btn-primary">Voltar</a>
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