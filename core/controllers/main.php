<?php

function action_index()
{
    //get number of rows from article table
    $num_rows = getAllArticlesAndCat();
    //set page number
    if(!isset($_GET['page'])){
        $page = 1;
    }else{
        echo $page = clearInt($_GET['page']);
    }
    if ($num_rows->rowCount() != 0){
        $res_per_pages = 4;
        $limit = ($page-1)*$res_per_pages;
        $articles = getAllArticlesAndCatLimit($limit,$res_per_pages);
        renderView('index',['articles'=>$articles,'num_rows'=>$num_rows->rowCount()]);
    }else{
         $errors = 'Нет записей в базе данных!';
         renderView('index',$errors);
    }
}

function action_articles()
{
    $articles = getAllArticles();
    if (isEmptyData($articles)==false){
        $data = ['articles'=>$articles];
        renderView('articles',$data);
    }else{
        $data = ['articles'=>'Пусто'];
        renderView('articles',$data);
    }
}

function action_contacts()
{
    renderView('contacts',$data=[]);
}

function action_addComment()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = clearStr($_POST['post_id']);
        if ($_POST['imgstring'] == $_SESSION['string']){
            unset($_SESSION['error_captcha']);
            addCommentsFromQuest($_POST);
            header('Location: /main/getArticle/?id='.$id);
        }else{
            session_start();
            $_SESSION['error_captcha'] = 'Пожалуйста, проверьте правильность введенных символов';
            header('Location: /main/getArticle/?id='.$id);
        }
    }
}

function action_getArticle()
{
    $id = clearInt($_GET['id']);
    $article = getArticleById($id);
    $comments = getCommentsByPostId($id);
    if (!isEmptyData($article)){
        $data = ['article'=>$article,'comments' => $comments];
        renderView('article',$data);
    }else{
        $data = ['error_article' => 'Данная статья не найден!'];
        renderView('article',$data);
    }
}

function action_registration()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dataForm = ['login' => htmlspecialchars(trim($_POST['login'])),
                    'password'=> trim($_POST['password']),
                    'email'=> trim($_POST['email'])];
        $rules = [
            'login' => ['required','login'],
            'password' => ['required','password'],
            'email'=>['required','email']
        ];
        $formErrors = validateForm($rules,$dataForm);
        if (empty($formErrors)){
            $sql = 'INSERT INTO users (login,password,email) VALUES (:login,:password,:email)';
            //проверка на уникальность логина и почты
            $sql2 = "SELECT id FROM users WHERE login = :login OR email =:email";
            $res = selectFromDb($sql2,[':login'=>$dataForm['login'],
                                        ':email' => $dataForm['email']]);
           if (!$res){
               $pass = password_hash($dataForm['password'].SECRET_KEY,PASSWORD_DEFAULT);
               if (insertUpdateDelete($sql,[':login'=>$dataForm['login'],
                                            ':password'=>$pass,
                                            ':email'=>$dataForm['email']])){
                header('Location: /main/success');
            }else{
                echo "Ошибка";
            }
           }else{
               $formErrors['shop'] = 'Такой пользователь зарегистрирован!';
           }
        }
    }
    renderView('registration',$formErrors);
}

function action_success()
{
    echo "Поздравляем с удачной регистрацией!";
}

function action_auth()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dataForm = ['login' => htmlspecialchars(trim($_POST['login'])),
            'password'=> trim($_POST['password'])];
        $sql2 = "SELECT * FROM users WHERE login = :login";
        $res = selectFromDb($sql2,[':login' => $dataForm['login']]);

        $pass = password_verify($dataForm['password'].SECRET_KEY,$res['password']);
        if ($pass){
            $_SESSION['user'] = $res;
            header('Location: /');
        }else{
            echo "не верный парол или логин";
        }
    }
    renderView('auth',[]);
}

function action_logout(){
    session_unset();
    session_destroy();
    header('Location: /');
}

