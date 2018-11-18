<?php

function addCommentsFromQuest($data)
{
    $name = clearStr($data['name']);
    $content = clearStr($data['content']);
    $post_id = clearStr($data['post_id']);
    $sql = "INSERT INTO questcomments(name,content,post_id) VALUES (:name,:content,:post_id)";
    insertUpdateDelete($sql,[':name'=>$name,
                                ':content' => $content,
                                ':post_id'=> $post_id]);
}

function getCommentsByPostId($id)
{
    $post_id = clearInt($id);
    $sql = "SELECT * FROM questcomments WHERE post_id = :post_id";
    return selectFromDb($sql,[':post_id' => $post_id]);

}