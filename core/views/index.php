<?php include 'core/views/template/header.php'?>
<?php include 'core/views/template/menu.php'?>
<section id="ban" class="ban">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (!empty($errors)){
                    echo "<h1>{$errors}</h1>";
                }
                    while ($row = $data['articles']->fetch(PDO::FETCH_ASSOC)){
                        echo <<<ROW
                        <h2><a href="/main/getArticle/?id={$row['id']}">{$row['title']}</a></h2>
                        <p><div style="font-size: 11px; display: inline-block; color: indigo;">{$row['catname']}<br>{$row['pubdate']}</div></p>
                        <p>{$row['content']}</p>
ROW;
   }
                $res_per_pages = 4;
                $number_pages = ceil($data['num_rows']/$res_per_pages);
                ?>
            </div>
            <div class="col-lg-12">
                <hr>
                <ul class="pagination">
                    <?php
                    for ($page = 1; $page<=$number_pages;$page++){
                        echo ' <li class="page-item"><a href="/main/?page='.$page.'"  class="page-link">'.$page.'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php include 'core/views/template/footer.php'?>