<?php

function validateForm($dataRules, $data)
{
    $errorForms = [];
    $fields = array_keys($dataRules);

    foreach ($fields as $fieldName) {
        $dataForms = $data[$fieldName];
        $rules = $dataRules[$fieldName];
        foreach ($rules as $ruleName) {
            if (!$ruleName($dataForms)){
                $errorForms[$fieldName] = $ruleName;
            }
        }
    }
    return $errorForms;
}

function change_password($data,$pass)
{

    return (password_verify($pass.SECRET_KEY,$data['password'])? true : false);

}

function isEmpty($data)
{
    if (empty($data['login']) || empty($data['email'])
        || empty($data['password'])
        || empty($data['password_confirm'])
        || empty($data['role'])){
        return false;
    }
    return true;
}

function passwordCheckConfirm($data)
{
    if ($data['password'] != $data['password_confirm']){
        return false;
    }
    return true;
}

function checkUserDataUnique($users,$inputData)
{
    foreach ($users as $user){
        if ($user['login'] == $inputData['login'] or $user['email'] == $inputData['email'] ){
            return false;
        }
    }
    return true;
}

function passwordCheckLen($data)
{
    if (strlen($data['password']) < 6){
        return false;
    }
    return true;
}
