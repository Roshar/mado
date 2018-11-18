<?php

function getAllUsers(){
    $sql = 'SELECT * FROM users';
    return $res = selectAllRowsDb($sql);
}

function checkUserInDb($data){
    $sql = 'SELECT * FROM users WHERE login = :login';
    $data = [':login' => $data['login']];
    $res = selectFromDbById($sql,$data);
//    if (password_verify($data['password'].SECRET_KEY,$res['password'])){
//
//    }
    if ($res['role'] == 'admin'){
        return true;
    }
    return false;

}

function getUserById($id){
    $sql = 'SELECT * FROM users WHERE id =:id';
    $id = [':id' => $id];
    return $res = selectFromDbById($sql,$id);
}

function updateForUserDatas($data){
    $sql = 'UPDATE users SET login =:login, email=:email, password = :password, role = :role WHERE id = :id';
    insertUpdateDelete($sql,[':id' => $data['id'],
                             ':login'=>$data['login'],
                             ':email' => $data['email'],
                             ':password' => password_hash($data['password'].SECRET_KEY,PASSWORD_DEFAULT),
                             ':role' => $data['role']]);
}

function deleteUser($data){
    $sql = 'DELETE FROM users WHERE id = :id';
    insertUpdateDelete($sql,[':id' => $data['id']]);
}

function addUserInDB($data){
    $sql = 'INSERT INTO users (login,email,password,role)
            VALUES(:login,:email,:password,:role)';
    insertUpdateDelete($sql,[':login'=>$data['login'],
        ':email' =>$data['email'],
        ':password' => password_hash($data['password'].SECRET_KEY,PASSWORD_DEFAULT),
        ':role' => $data['role']]);
}