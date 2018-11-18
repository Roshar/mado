<?php ob_start()?>
<?php include 'core/views/template/header.php'; ?>
<?php include 'core/views/template/menu.php'?>
<section id="ban" class="ban">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

            <div class="col-lg-12">
                <h2><?= $data['article']['title']?></h2>
                <p style="font-size: 12px; color: darkolivegreen;">Категория: <?=$data['article']['catname']?></p>
                <p style="font-size: 12px; color: darkolivegreen;">Опубликовано: <?= $data['article']['pubdate']?></p>
                <p style="font-size: 12px; color: darkolivegreen;">Автор: <?= $data['article']['login']?></p>
                <p><?= $data['article']['content']?></p>
            </div>
                <hr>
                <h2>КОММЕНАТРИИ:</h2>
                <?php
                foreach ($data['comments'] as $comment):?>
                    <div style="display: block;">
                        <?=$comment['name']?>
                        <br>
                        <span style="color:darkolivegreen; font-size: 12px; border-bottom: 1px solid grey"><?=$comment['pubdate']?></span>
                    </div>
                    <div>
                        <?=$comment['content']?>
                    </div>
                <?endforeach;
                ?>
            </div>
            <div class="col-lg-12">
                <br>
                <?php if (!empty($_SESSION['error_captcha'])){
                    echo "<div style='background-color: crimson;color: #FFF; font-weight:bold;padding: 20px; width: 50%;'>
                          ".$_SESSION['error_captcha']."</div>";
                    unset($_SESSION['error_captcha']);
                }
                    ?>
                <?php include 'core/views/template/comments.php'?>
            </div>
        </div>
    </div>
</section>
<?php include 'core/views/template/footer.php'; ?>
