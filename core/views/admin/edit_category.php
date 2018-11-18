<?php session_start()?>
<?php include 'core/views/template/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <header style=" background-color: wheat">
                <h2>Менеджер материалов: Изменить материал</h2>
            </header>
            <div style="border-bottom: 5px solid brown;"></div>
                    <form method="post" action="/admin/updateordeletecat/">
                        <label for="title">Заголовок:</label> <br>
                        <input type="text" name="title" value="<?=$data['category']['title']?>" class="form-control"><br>
                        <input type="text" name="title" value="<?=$data['category']['parent_id']?> class="form-control""><br>

                        <input type="hidden" name="id" value="<?=$data['category']['id']?>">
                        <p><input type="submit" value="Обновить" name="update_cat" class="btn btn-primary"></p>
                        <p><input type="submit" value="Удалить" name="delete_cat" class="btn btn-danger"></p>
                    </form>
        </div>
    </div>
</div>