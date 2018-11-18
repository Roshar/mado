<?php include 'core/views/template/header.php'; ?>
<header id="header" class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <img src="" alt="logoMy" class="logoMy">
            </div>
            <div class="col-lg-5 ml-auto">
                <div class="nav">
                    <?php include 'core/views/template/menu.php'?>
                </div>
            </div>
        </div>
    </div>
</header>
<section id="ban" class="ban">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php foreach ($data['articles'] as $article):?>
                    <h2><a href="/main/getArticle/?id=<?=$article['id']?>"><?=$article['title']?></a></h2>
                    <p><div style="font-size: 11px; display: inline-block; color: #cccccc;">Категория:</div> <?=$article['catname']?></p>
                    <p><?= $article['content']?></p>
                    <p><?= $article['pubdate']?></p>
                <?endforeach;?>
            </div>
        </div>
    </div>
</section>

<?php include 'core/views/template/footer.php'; ?>
