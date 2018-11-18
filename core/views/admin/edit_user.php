<?php session_start()?>
<?php include 'core/views/template/header.php'; ?>
    <div class="container">
    <div class="row">
    <div class="col-lg-12">
    <header style=" background-color: wheat">
        <h2>Менеджер материалов: Изменить пользователя</h2>
    </header>
    <div style="border-bottom: 5px solid brown;"></div>
    <div class="form-group">
            <form method="post" action="/admin/updateordeleteuser/">
                <label for="title">Логин:</label> <br>
                <input type="text" name="login" value="<?=$data['author']['login']?>" class="form-control"><br>
                <label for="title">Почта:</label> <br>
                <input type="email" name="email" value="<?=$data['author']['email']?>" class="form-control"><br>
                <label for="password">Введите старый пароль:</label> <br>
                <input type="password" name="password_old" class="form-control"><br>
                <label for="password_new">Введите новый пароль:</label> <br>
                <input type="password" name="password" class="form-control"><br>
                <label for="password_confirm">Повторите новый пароль:</label> <br>
                <input type="password" name="password_confirm" class="form-control"><br>
                <select name="role" id="role" class="form-control">
                    <option value="user" <?=($data['author']['role'] == 'user') ? 'selected':''?>> Пользователь </option>
                    <option value="moderator" <?=($data['author']['role'] == 'moderator') ? 'selected':''?>> Модератор </option>
                </select><br>
                <input type="hidden" name="id" value="<?=$data['author']['id']?>" class="form-control">
                <p><input type="submit" value="Сохранить" name="update_user" class="btn btn-primary"></p>
                <p><input type="submit" value="Удалить" name="delete_user" class="btn btn-danger"></p>
            </form>
            <?php
                if (!empty($data['error'])){
                    foreach ($data['error'] as $key => $error){
                        switch ($key){
                            case 'isEmpty':echo $error;break;
                            case 'change_password':echo $error;break;
                            case 'passwordCheckConfirm':echo $error;break;
                        }
                    }
                }
            ?>
    </div>
    </div>
    </div>
    </div>
