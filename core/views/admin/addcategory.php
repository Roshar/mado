<?php session_start()?>
<?php include 'core/views/template/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <header style=" background-color: wheat">
                <h2>Менеджер материалов: Добавить категорию</h2>
            </header>
            <div style="border-bottom: 5px solid brown;"></div>
            <div class="form-group">
                <form method="post" action="/admin/savecat/">
                    <label for="title">Заголовок:</label> <br>
                    <input type="text" name="title" class="form-control"><br>
                    <label for="title">Категория:</label> <br>
                    <select name="parent_id" id="parent_id" class="form-control">
                        <option value="0">Нет родителя</option>
                        <?php
                        recursive_tree_list($data['categories'])
                        ?>
                    </select><br>
                    <p><input type="submit" value="Добавить" class="btn btn-primary"></p>
                </form>
            </div>
        </div>
    </div>
</div>

