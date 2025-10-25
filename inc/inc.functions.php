<?php
    session_start();

    define('TL_ROOT', dirname(__DIR__));
    define('LOGIN', 'UEL311');
    define('PASSWORD', 'U31311');
    define('DB_ARTICLE', TL_ROOT.'/db/articles.json'); //enlever le s de DBALS pour une bonne définition de la constante+ Coorection du chemin avec db au lieu de dbal

    function connectUser($login = null, $password = null){
        if(!is_null($login) && !is_null($password)){
            if($login === LOGIN && $password === PASSWORD){
                return array(
                    'login'    => LOGIN,
                    'password' => PASSWORD
                );
            }
        }
        return null;
    }

    function setDisconnectUser(){
         unset($_SESSION['User']);
         session_destroy(); // Correction de session_destroy() en retirant le s
    }

    function isConnected(){
        if(array_key_exists('User', $_SESSION) 
                && !is_null($_SESSION['User'])
                    && !empty($_SESSION['User'])){
            return true;
        }
        return false;
    }

    function getPageTemplate($page = null){
        $fichier = TL_ROOT.'/pages/'.(is_null($page) ? 'index.php' : $page.'.php');

        if(!file_exists($fichier)){
            include TL_ROOT.'/pages/index.php'; // modification de "include" : sert à inclure le fichier index.php par défaut   
        }else{
            include $fichier;
        }
    }

    function getArticlesFromJson(){
        if(file_exists(DB_ARTICLE)) {
            $contenu_json = file_get_contents(DB_ARTICLE);
            return json_decode($contenu_json, true);
        }

        return null;
    }

    function getArticleById($id_article = null){ // ici on déclare uen fonction avec par défaut valeur de $id_article = null. donc pas ==
       if(file_exists(DB_ARTICLE)) {
            $contenu_json = file_get_contents(DB_ARTICLE);
            $_articles    = json_decode($contenu_json, true);

            foreach($_articles as $article){
                if($article['id'] == $id_article){
                    return $article;
                }
            }
        }

        return null;
    }
