<?php session_start()?>
<?php include 'core/views/template/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <header style=" background-color: wheat">
            <h2>Менеджер материалов: Создать материал</h2>
        </header>
            <div style="border-bottom: 5px solid brown;"></div>
            <div class="form-group">
                <form method="post" action="/admin/savepost/">
                    <label for="title">Заголовок:</label> <br>
                    <input type="text" name="title" class="form-control"><br>
                    <label for="title">Категория:</label> <br>
                    <select name="category_id" id="catId" class="form-control">
                        <?php foreach ($data['categories'] as $category):?>
                            <option value="<?=$category['id']?>"><?=$category['title'];?></option>
                        <?endforeach;?>
                    </select><br>
                    <label for="content">Статья: </label><br>
                    <textarea name="content" id="content" cols="60" rows="15" class="form-control"></textarea><br>
                    Статус:
                    <select name="status" id="status" class="form-control">
                        <option value="1">Опубликовано</option>
                        <option value="0">Не опубликовано </option>
                    </select><br>
                    Автор:
                    <select name="author_id" id="author_id" class="form-control">
                        <?php foreach ($data['authors'] as $author):?>
                            <option value="<?=$author['id']?>"><?=$author['login'];?></option>
                        <?endforeach;?>
                    </select><br>
                    <p>
                        <label for="pubdate">Дата публикации: </label><br>
                        <input type="text" name="pubdate" class="form-control" >
                    </p>
                    <input type="hidden" name="id" >
                    <p><input type="submit" class="btn btn-primary" value="Добавить"></p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'core/views/template/footer.php'?>
