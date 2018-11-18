<?php session_start()?>
<?php $authorid = $data['article']['author_id'];?>
<?php include 'core/views/template/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <header style=" background-color: wheat">
                <h2>Менеджер материалов: Создать материал</h2>
            </header>
            <div style="border-bottom: 5px solid brown;"></div>
            <div class="form-group">
                <form method="post" action="/admin/updateOrDeletePost/">
                    <label for="title">Заголовок:</label> <br>
                    <input type="text" name="title" class="form-control" value="<?=$data['article']['title']?>"><br>
                    <label for="content">Статья: </label><br>
                    <textarea name="content" id="content" cols="60" rows="15" class="form-control"><?= $data['article']['content']?></textarea><br>
                    Категория:
                    <select name="category_id" id="catId" class="form-control">
                        <?php foreach ($data['categories'] as $category):?>
                            <option value="<?=$category['id']?>"><?=$category['title'];?></option>
                        <?endforeach;?>
                    </select><br>
                    Автор:
                    <select name="author_id" id="author_id" class="form-control">
                        <?php foreach ($data['authors'] as $author):?>
                            <option value="<?=$author['id']?>"<?php echo $author['id'] == $authorid ?  'selected':''?>>
                                <?=$author['login'];?> </option>
                        <?endforeach;?>
                    </select><br>
                    Статус:
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?=$data['article']['status']== '1' ? 'selected' : null;?>>Опубликовано</option>
                        <option value="0" <?=$data['article']['status'] == '0' ? 'selected' : null;?>>Не опубликовано </option>
                    </select><br>
                    <p>
                        <label for="publication">Дата публикации: </label><br>
                        <input type="text" name="publication" value="<?=$data['article']['pubdate']?>" class="form-control">
                    </p>
                    <input type="hidden" name="id" value="<?=$data['article']['id']?>" >
                    <input type="hidden" name="action" value="edit_article">
                    <p><input type="submit" value="Обновить" name="update_post" class="btn btn-primary"></p>
                    <p><input type="submit" value="Удалить" name="delete_post" class="btn btn-danger"></p>
                </form>
            </div>
        </div>
    </div>
</div>