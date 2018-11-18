<?php
session_start();

function action_index()
{
    if (is_admin()){
        header('Location: /admin/panel');
    }else{
        header('Location: /admin/auth');
    }
}

function action_panel()
{
    if (is_admin()) {
        $allContent = getAllArticlesAndCat();
        $allCategories = getAllCategories();
        $authors = getAllUsers();
        renderView('admin/panel',$data=['allContent'=>$allContent,'categories'=>$allCategories,'users'=>$authors]);
        exit();
    }else{
        header('Location: /admin/auth');
    }
}

function action_auth()
{
    renderView('admin/auth',[]);
}

function action_out()
{
    session_destroy();
    session_unset($_SESSION['user']);
    header('Location: /');
}

function action_check_auth()
{
    $data['auth'] = $_POST;
    $res = checkUserInDb($data['auth']);
    if ($res){
        session_start();
        $_SESSION['user']['role'] = 'admin';
        header('Location: /admin/panel');
    }else{
        $data['error'] = 'Ошибка при авторизации';
        renderView('/admin/auth',$data);
    }
}
/*
 * ///////////////////////////// MANAGER ARTICLES /////////////////////////////////////
 * create, edit, delete
 */
function action_editArticle()
{
    if (is_admin()){
        if (isset($_GET['action'])&&$_GET['action']=='edit'){
            $categories = getAllCategories();
            $authors = getAllUsers();
            $articleById = findArticleById($_GET['id']);
            renderView('admin/edit_article',$data=['article' => $articleById,
                'categories'=>$categories,'authors' => $authors]);
            exit();
        }
    }else{
        header('Location: /admin/auth');
    }
}

function action_addArticle()
{
    if (is_admin()){
        $categories = getAllCategories();
        $authors = getAllUsers();
        renderView('admin/addarticle',$data=['categories'=>$categories,'authors'=>$authors]);
        exit();
    }else{
        header('Location: /admin/auth');
    }

}

function action_savePost()
{
    if (is_admin()){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data['article'] = $_POST;
            addArticlesInTable($data['article']);
            header('Location: /admin/panel');
            exit();
        }
    }else{
        header('Location: /admin/auth');
    }
}

function action_updateOrDeletePost()
{
    if(is_admin()){
        if (isset($_POST['update_post']) and $_POST['update_post'] == 'Обновить'){
            $data['article'] = $_POST;
            updateArticleInTable($data['article']);
            header('Location: /admin/panel');
        }
        if (isset($_POST['delete_post']) and $_POST['delete_post'] == 'Удалить'){
            $data['article'] = $_POST;
            deleteArticleInTable($data['article']);
            header('Location: /admin/panel');
        }
    }else{
        header('Location: /admin/auth');
    }
}

function action_deletecat()
{

}
/*
 * //////////////////////////// MANAGER CATEGORY ////////////////////////////////////////
 */

function action_addCategory()
{
    if (is_admin()){
        $categories = getAllCategoriesTree();
        renderView('admin/addcategory',$data=['categories'=>$categories]);
        exit();
    }else{
        header('Location: /admin/auth');
    }
}

function action_editCategory()
{
    if (is_admin()){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $categoryById = findCategoryById($_POST['id']);
            renderView('admin/edit_category',$data=['category' => $categoryById]);
            exit();
        }
    }else{
        header('Location: /admin/auth');
    }
}

function action_saveCat()
{
    //todo реализовать работу с категориями
    if (is_admin()){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data['category'] = $_POST;
            addCategoryInTable($data['category']);
            header('Location: /admin/panel');
        }
    }else{
        header('Location: /admin/auth');
    }

}
function action_updateOrDeleteCat()
{
    if (is_admin()){
        if (isset($_POST['update_cat']) && $_POST['update_cat'] == 'Обновить'){
            $data['category'] = $_POST;
            updateCategoryInTable($data['category']);
            header('Location: /admin/panel');
        }
        if (isset($_POST['delete_cat']) && $_POST['delete_cat'] == 'Удалить'){
            $data['category'] = $_POST;
            deleteCategoryInTable($data['category']);
            header('Location: /admin/panel');
        }
    }else{
        header('Location: /admin/auth');
    }

}

/*
 * ////////////////////////////// MANAGER USERS /////////////////////////////////////////////////////////
 */
function action_editUser()
{
    if (is_admin()){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $author = getUserById($_POST['id']);
            renderView('admin/edit_user',$data=['author' => $author]);
            exit();
        }
    }else{
        header('Location: /admin/auth');
    }

}

function action_updateOrDeleteUser()
{
    if (is_admin()){
        if (isset($_POST['update_user']) and $_POST['update_user'] == 'Сохранить'){
            $data['new_user'] = $_POST;
            $error = [];
            $old_password = $_POST['password_old'];
            $data['old_user'] = getUserById($_POST['id']);

            if (!isEmpty($data['new_user'])){
                $error['isEmpty'] = 'Заполните все поля!';
            }else{
                if (!change_password($data['old_user'],$old_password)){
                    $error['change_password'] = 'Пароль неправильный';
                }else{
                    if (!passwordCheckConfirm($data['new_user'])) {
                        $error['passwordCheckConfirm'] = 'Пароли должны совпадать';
                    }
                }
            }
            if(!empty($error)){
                $author = getUserById($_POST['id']);
                renderView('/admin/edit_user',['error' => $error,'author' => $author]);
                exit();
            }
            updateForUserDatas($data['new_user']);
            header('Location: /admin/panel');
        }
        if (isset($_POST['delete_user']) and $_POST['delete_user'] == 'Удалить'){
            $data['user'] = $_POST;
            deleteUser($data['user']);
            header('Location: /admin/panel');
        }
    }else{
        header('Location: /admin/auth');
    }

}

function action_addUser()
{
    if (is_admin()){
        renderView('admin/add_User',[]);
    }else{
        header('Location: /admin/auth');
    }
}

function action_save()
{
    if (is_admin()){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data['article'] = $_POST;
            addArticlesInTable($data['article']);
            header('Location: /admin/panel');
        }
    }else{
        header('Location: /admin/auth');
    }

}
function action_saveUser()
{
    if (is_admin()){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['user'] = $_POST;
            $userCheck = getAllUsers();
            $error = [];
            if (!isEmpty($data['user'])){
                $error['isEmpty'] = 'Заполните все поля!';
            }else{
                if (!passwordCheckLen($data['user'])) {
                    $error['passwordCheckLen'] = 'Длина пароля должна быть больше 6 символов';
                }else{
                    if (!passwordCheckConfirm($data['user'])){
                        $error['passwordCheckConfirm'] = "Пароли должны совпадать!";
                    }else{
                        if (!checkUserDataUnique($userCheck, $data['user'])) {
                            $error['checkUserDataUnique'] = "Такой пользователь существует";
                        }
                    }
                }
            }
            if(!empty($error)){
                renderView('/admin/add_user',$error);
                exit();
            }
            addUserInDB($data['user']);
            header('Location: /admin/panel');
        }
    }else{
        header('Location: /admin/auth');
    }
}