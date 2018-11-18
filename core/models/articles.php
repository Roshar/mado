<?php

function findArticleById($id)
{
    $sql = 'SELECT * FROM articles WHERE id = :id';
    $id = [':id'=>$id];
    return $res = selectFromDbById($sql,$id);
}

function getArticleById($id)
{
    $sql = "SELECT articles.id, articles.title,content,pubdate,status,category.title as catname,users.login,users.role
            FROM articles INNER JOIN category ON articles.category_id = category.id 
            INNER JOIN users ON articles.author_id = users.id WHERE articles.id =:id";
    $id = [':id'=>$id];
    return $res = selectFromDbById($sql,$id);
}

function findAllArticlesByCategory($catId)
{
    $sql = 'SELECT * FROM articles WHERE category_id =:catId';
    $categoryId = [':id'=>$catId];
    return $res = selectFromDb($sql,$categoryId);
}

function getAllArticles()
{
    $sql = 'SELECT * FROM articles';
    return $res = selectAllRowsDb($sql);
}

function getAllArticlesAndCat(){
    $sql = 'SELECT articles.id, articles.title, articles.content, articles.path_img,articles.pubdate,articles.status,
category.title as catname FROM articles INNER JOIN category ON articles.category_id = category.id';
    return $res = selectAllRowsDb1($sql);
}
function getAllArticlesAndCatLimit($start,$lim){
    $sql = "SELECT articles.id, articles.title, articles.content, articles.path_img,articles.pubdate,articles.status,
category.title as catname FROM articles INNER JOIN category ON articles.category_id = category.id LIMIT ".$start." , ". $lim;
    return $res = selectAllRowsDb1($sql);
}

function addArticlesInTable($data)
{
    $sql = 'INSERT INTO articles (title,category_id,author_id,content,status)
            VALUES(:title,:category_id,:author_id,:content,:status)';
    insertUpdateDelete($sql,[':title'=>$data['title'],
        ':category_id' =>$data['category_id'],
        ':author_id' => $data['author_id'],
        ':content' => $data['content'],
        ':status' => $data['status']]);
}

function updateArticleInTable($data)
{
    $sql = 'UPDATE articles SET title=:title, category_id=:category_id,author_id=:author_id,content =:content, status=:status WHERE id = :id';
    insertUpdateDelete($sql,[':id' => $data['id'],
                             ':title'=>$data['title'],
                             ':category_id'=>$data['category_id'],
                             ':author_id' => $data['author_id'],
                             ':content' =>$data['content'],
                             ':status' => $data['status']]);
}

function deleteArticleInTable($data)
{
    $sql = 'DELETE FROM articles WHERE id = :id';
    insertUpdateDelete($sql,[':id' => $data['id']]);
}




