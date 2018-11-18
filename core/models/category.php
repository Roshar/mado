<?php

function findCategoryById($id)
{
    $sql = 'SELECT * FROM category WHERE id = :id';
    $id = [':id' => $id];
    return $res = selectFromDbById($sql,$id);
}
function getAllCategories(){
    $sql = 'SELECT id,title,parent_id FROM category';
    return $res = selectAllCategoriesDb($sql);
}
function getAllCategoriesTree()
{
    $sql = 'SELECT id,title,parent_id FROM category';
    $res = selectAllCategoriesDbTree($sql);
    $arr_cat = [];
    if ($res->rowCount() != 0){
        for ($i = 0; $i < $res->rowCount(); $i++){
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $arr_cat[$row['parent_id']][] = $row;
        }
    }
    return $arr_cat;
}

function addCategoryInTable($data)
{

        $sql = 'INSERT INTO category (title,parent_id)
            VALUES(:title,:parent_id)';
        insertUpdateDelete($sql,[':title'=>$data['title'],':parent_id' => $data['parent_id']]);
}
function updateCategoryInTable($data)
{
    $sql = 'UPDATE category SET title=:title  WHERE id = :id';
    insertUpdateDelete($sql,[':id' => $data['id'],':title'=>$data['title']]);
}
function deleteCategoryInTable($data)
{
    $sql = 'DELETE FROM category WHERE id = :id';
    insertUpdateDelete($sql,[':id' => $data['id']]);
}