<?php include 'core/views/template/header.php'; ?>
<?php include 'core/views/template/menu.php'?>
    <section id="ban" class="ban">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Регистрация</h1>
                    <form method="post">
                        <input type="text" name="login" placeholder="login" value="<?=(isset($_POST['login']) ? $_POST['login'] : null);?>" class="<?=(isset($formErrors['login'])? 'error': null);?>">
                        <input type="text" placeholder="email" name="email">
                        <input type="password" name="password">
                        <input type="submit">
                        <?php if (!empty($formErrors)){
                            var_dump($formErrors['login']);
                            var_dump($formErrors['shop']);
                        }?>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include 'core/views/template/footer.php'?>