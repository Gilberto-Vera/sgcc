<!doctype html>
<html lang="en">
    <head>
        <title>SGCC</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/signin.css">
        <link rel="stylesheet" href="css/sb-admin-2.min.css" >
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    </head>

    <body class="bg-gradient-primary text-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="p-5">
                                <img class="mb-4" src="image/ring.png" alt="" width="100" height="121">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Entre, por favor!</h1>
                                </div>
                                <?php include(TEMPLATE_PATH . '/messages.php') ?>
                                <form class="user needs-validation" action="#" method="POST">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user 
                                            <?= $errors['email'] ? 'is-invalid' : '' ?>"
                                            name="email" placeholder="Email" value="<?= $email ?>">
                                        <div class="text-left invalid-feedback">
                                            <?= $errors['email'] ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user 
                                            <?= $errors['senha'] ? 'is-invalid' : '' ?>"
                                            name="senha" placeholder="Senha">
                                        <div class="text-left invalid-feedback">
                                                <?= $errors['senha'] ?>
                                        </div>
                                    </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-user btn-block" type="submit" id="login">Acessar</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>