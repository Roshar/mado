<?php

function show404page()
{
    header('HTTP/1.1 404 Not Found');
    //todo заменить на view
    echo "404 Not Found!";
}

function AccessIsDenied()
{
    renderView('access',[]);
}

function renderView($viewName,$data=[])
{
    include 'core/views/'.$viewName.'.php';
}

function is_auth()
{
    if (isset($_SESSION['user']) and !empty($_SESSION['user'])){
        return true;
    }
    return false;
}

function is_admin(){
    session_start();
    if ($_SESSION['user']['role'] == 'admin'){
        return true;
    }else{
        return false;
    }
}

function getUrlSegment($num)
{
    $url = strtolower($_GET['url']);
    $urlPart = explode('/',$url);
    return $urlPart[$num];
}

function isEmptyData($data){
    if (empty($data)){
        return true;
    }else{
        return false;
    }
}

function clearInt($id)
{
    return abs((int)$id);
}

function clearStr($data)
{
    return trim(strip_tags($data));
}

//CATEGORY RECURSIVE TREE LIST
function  recursive_tree_list($data,$parent_id=0,$mark = 0 )
{
    if (empty($data[$parent_id]))
        return;
    for ($i = 0; $i < count($data[$parent_id]); $i++){
        echo "<option value='".$data[$parent_id][$i]['id']."'>".str_repeat('-',$mark).
            $data[$parent_id][$i]['title'] ."</option>";
        recursive_tree_list($data,$data[$parent_id][$i]['id'],$mark+2);
    }
}