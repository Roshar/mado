<?php include 'core/views/template/header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <header style=" background-color: wheat">
                    <h2>Вход в панель управления</h2>
                </header>
                <div style="border-bottom: 5px solid brown;"></div>
                <div class="form-group">
                    <form action="/admin/check_auth" method="post">
                        <input type="text" name="login" placeholder="логин" class="form-control"><br>
                        <input type="password" name="password" class="form-control"><br>
                        <input type="submit" value="Войти" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?=(!empty($data)) ? $data: '';?>