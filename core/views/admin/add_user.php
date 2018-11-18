<?php session_start()?>
<?php include 'core/views/template/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <header style=" background-color: wheat">
                <h2>Менеджер материалов: Добавить пользователя</h2>
            </header>
            <div style="border-bottom: 5px solid brown;"></div>
            <div class="form-group">
                    <form method="post" action="/admin/saveuser/">
                        <label for="title">Логин:</label> <br>
                        <input type="text" name="login" class="form-control"><br>
                        <label for="email">Почта:</label> <br>
                        <input type="email" name="email" class="form-control"><br>
                        <label for="password">Пароль:</label> <br>
                        <input type="password" name="password" class="form-control"><br>
                        <label for="password_confirm">Повторите пароль:</label> <br>
                        <input type="password" name="password_confirm" class="form-control"><br>
                        <select name="role" id="role" class="form-control">
                            <option value="" selected> Выбрать роль</option>
                            <option value="user"> Пользователь </option>
                            <option value="moderator"> Модератор </option>
                        </select><br>
                        <p><input type="submit" value="Добавить пользователя" class="btn btn-primary"></p>
                    </form>
                    <?php
                    //if (!empty($data)){
                    //    switch (array_keys($data)){
                    //        case 'isEmpty': echo "ДАДА";break;
                    //    }
                    if (!empty($data)){
                        foreach ($data as $key => $errors){
                            switch ($key){
                                case 'isEmpty':echo $errors;break;
                                case 'passwordCheckLen':echo $errors;break;
                                case 'passwordCheckConfirm':echo $errors;break;
                                case 'checkUserDataUnique':echo $errors;break;
                            }
                        }
                    }
                    ?>
            </div>
        </div>
    </div>
</div>

