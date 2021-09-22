<?php

include_once("classes/input.class.php");
include_once("classes/validate.class.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation Class</title>
    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-md-center">
            <div class="col-md-8">
                <?php
                if (INPUT::exist()) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'ad' => array(
                            'name' => "Kullanıcı Adı",
                            'required' => true,
                            'min' => 2,
                            'max' => 50
                        ),
                        'mail' => array(
                            'name' => "Email",
                            'required' => true,
                            'email' => true
                        ),
                        'sifre' => array(
                            'name' => "Şifre",
                            'required' => true,
                            'min' => 8,
                            'max' => 15
                        ),
                        'sifreTekrar' => array(
                            'matches' => 'sifre'
                        )
                    ));
                    if ($validate->passed())
                        echo 'Tüm değerler uyuyor';
                    else {
                        $validate->showError();
                    }
                } else {
                    echo 'Post yok';
                }
                ?>
                <h1>Form Control</h1>
                <form action="" method="POST">
                    <div class="form-group col-md-4">
                        <label for=""> Ad:</label>
                        <input type="text" name="ad" class="form-control">
                        <label for=""> Mail:</label>
                        <input type="text" name="mail" class="form-control">
                        <label for=""> Şifre:</label>
                        <input type="text" name="sifre" class="form-control">
                        <label for=""> Şifre Tekrar:</label>
                        <input type="text" name="sifreTekrar" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Gönder">
                </form>

            </div>
        </div>
    </div>
</body>
<!-- BOOSTRAP SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>

</html>