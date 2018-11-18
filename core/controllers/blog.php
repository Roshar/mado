<?php

function action_index(){
    echo "Все посты категории";
}

function action_category(){
    $categoryId = getUrlSegment(2);
    if ($categoryId == null){
        show404page();
    }
    $resCategory = findCategoryById($categoryId);
    $getAllPosts = findAllArticlesByCategory($resCategory['id']);
    renderView('category',$data = ['articles'=>$getAllPosts,'category'=>$resCategory]);

}