<?php

$config = require_once 'core/config/config.php';

function getConnectDb(){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=mado_blog','root','');
        $pdo->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::ATTR_ERRMODE);
        $pdo->exec('set names "utf8"');
    }catch (PDOException $e){
        echo  'Проблема с соединением с БД '.$e->getMessage();
        //todo написать viewшку для передачи ошибки
        exit();
    }
    return $pdo;
}

function insertUpdateDelete($sql,array $data=[]){
    $pdo = getConnectDb();
    $stmt = $pdo->prepare($sql);
    $res = $stmt->execute($data);
    return $res;
}

function selectFromDb($sql,array $data=[]){
    $pdo = getConnectDb();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

function selectFromDbById($sql,array $data=[]){
    $pdo = getConnectDb();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res;
}

function selectAllRowsDb($sql){
    $pdo = getConnectDb();
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function selectAllRowsDb1($sql){
    $pdo = getConnectDb();
    return $stmt = $pdo->query($sql);

}

function selectAllCategoriesDb($sql){
    $pdo = getConnectDb();
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function selectAllCategoriesDbTree($sql){
    $pdo = getConnectDb();
    return $stmt = $pdo->query($sql);

}


