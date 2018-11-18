<?php session_start()?>
<?php include 'core/views/template/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12" style="background-color: wheat">
            <div class="col-lg-6">
                <div class="header">
                    <h2>Панель управления </h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <form action="/admin/out" method="get">
                        <input type="submit" value="Выйти из панели" class="btn btn-default">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="section">
                <h3>Менеджер материалов</h3>
                <div class="table-responsive">
                    <table  class="table">
                        <tr style="background-color: teal; color: #fff;">
                            <th>id</th>
                            <th>Заголовок</th>
                            <th>Дата публикации</th>
                            <th>Категория</th>
                            <th>Состояние</th>
                            <th></th>
                        </tr>
                        <?php foreach ($data['allContent'] as $datum):?>
                            <form action="/admin/editarticle" method="get" >
                                <tr>
                                    <td><?=$datum['id'];?></td>
                                    <td><?=$datum['title'];?></td>
                                    <td><?=$datum['pubdate'];?></td>
                                    <td><?=$datum['catname'];?></td>
                                    <td><?=$datum['status']==1?'Опубликовано': 'не опубликовано';?></td>
                                    <input type="hidden"  name="action" value="edit">
                                    <input type="hidden"  name="id" value="<?=$datum['id'];?>">
                                    <td><input type="submit" value="Редактировать"></td>
                                </tr>
                            </form>
                        <?php endforeach;?>
                    </table>
                </div>
                <h3>Менеджер категорий</h3>
                <table class="table">
                    <tr style="background-color: teal; color: #fff;">
                        <th>id</th>
                        <th>Название</th>
                        <th>Родитель</th>
                        <th>Действия</th>
                    </tr>
                    <?php foreach ($data['categories'] as $datum):?>
                        <form action="/admin/editcategory" method="post" >
                            <tr>
                                <td><?=$datum['id'];?></td>
                                <td><?=$datum['title'];?></td>
                                <td><?=$datum['parent_id'];?></td>
                                <input type="hidden"  name="id" value="<?=$datum['id'];?>">
                                <td><input type="submit" value="Редактировать"></td>
                            </tr>
                        </form>
                    <?php endforeach;?>
                </table>
                <h3>Менеджер пользователей</h3>
                <div class="table-responsive" >
                    <table class="table" width="100%">
                        <tr style="background-color: teal; color: #fff;">
                            <th>id</th>
                            <th>Логин</th>
                            <th>Роль</th>
                            <th>Действия</th>
                        </tr>
                        <?php foreach ($data['users'] as $datum):?>
                            <form action="/admin/edituser" method="post" >
                                <tr>
                                    <td><?=$datum['id'];?></td>
                                    <td><?=$datum['login'];?></td>
                                    <td><?=$datum['role'];?></td>
                                    <input type="hidden"  name="id" value="<?=$datum['id'];?>">
                                    <td><input type="submit" value="Редактировать"></td>
                                </tr>
                            </form>
                        <?php endforeach;?>
                    </table>
                </div>

                <h3><a href="/admin/addarticle"> Добавить материал</a></h3>
                <h3><a href="/admin/addcategory"> Добавить категорию</a></h3>
                <h3><a href="/admin/adduser"> Добавить пользователя</a></h3>
            </div>
            </div>
        </div>
    </div>

</div>

