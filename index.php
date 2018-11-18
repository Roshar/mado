<?php
ob_start();
session_start();
require_once 'core/config/main.php';
require_once 'core/library/main.php';
require_once 'core/library/validator.php';
require_once 'core/library/db.php';
require_once 'core/models/comment.php';
require_once 'core/models/category.php';
require_once 'core/models/articles.php';
require_once 'core/models/users.php';

$ctrlName = ((getUrlSegment(0) == null)? 'main' : getUrlSegment(0));
$actionName = ((getUrlSegment(1) == null)? 'action_index' : 'action_'.getUrlSegment(1));

if (file_exists('core/controllers/'.$ctrlName.'.php')){
    require_once 'core/controllers/'.$ctrlName.'.php';

    if (function_exists($actionName)){
        $actionName();
    }else{
        show404page();
    }
}else{
    show404page();
}

