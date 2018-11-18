<form action="/main/addcomment/" method="post">
    <label for="name"> Ваш имя:</label><br>
    <input type="text" name="name"><br>
    <label for="email"> Ваш email:</label><br>
    <input type="email" name="email"><br>
    <label for="content"> Ваш комментарий:</label><br>
    <input type="hidden" name="post_id" value="<?=$data['article']['id']?>">
    <textarea name="content" id="content" cols="60" rows="10"></textarea><br>
    Введите символы с картинки:<input type="text" name="imgstring"><br>
    <img src="/core/library/captcha.php" width="170" height="70"><br>
    <input type="submit" value="Отправить">
</form>