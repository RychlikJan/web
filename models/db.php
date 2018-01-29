<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.01.2018
 * Time: 17:23
 */

class db
{
    public $connection;

    /**
     * db constructor.
     */
    function __construct (){
        //database details
        $dsn = 'mysql:host=localhost;dbname=web';
        $user = 'root';
        $password = '';
        try{
            $this->connection = new PDO($dsn,$user, $password);
            if(!isset($_SESSION)) {
                session_start();
            }

        }catch(PDOException $e){
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }

    /**
     * @return array vraci vsechny uzivatele
     */
    function findAllUsersForAdmin(){
        $mysql_pdo_error = false;
        $query = "SELECT * from  user;";
        $sth = $this->connection->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** Kontroluje heslo, zda je ok
     * @param $login
     * @param $pass
     * @return null/ uzivatele databaze
     */
    function controlUser($login, $pass){
        $userFromDB = $this->findByLogin($login);
        if($userFromDB != null){
            if($userFromDB["password"] == $pass){
                return $userFromDB;
            }
        }
        return null;
    }

    /** kontrola zda je mozne vytvorit noveho uzivatzele
     * @param $login
     * @param $email
     * @param $pass
     * @return bool
     */
    function registrationUser($login, $email, $pass){
        $userFromDB = $this->findByLogin($login);
        if($userFromDB == null){
            if($this->addNewUser($login, $email, $pass)){
                return true;
            }
        }else{
            return false;
        }
    }

    /** Najde uzivatele podle loginu
     * @param $login
     * @return null
     */
    function findByLogin($login){
        $mysql_pdo_error = false;
        $query = 'SELECT * from user where login=:login;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':login', $login, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $ourUser = $sth->fetchAll(PDO::FETCH_ASSOC);
            if(count($ourUser)>0) return $ourUser[0];
            return null;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** Hleda uzivatele podle id
     * @param $id
     * @return mixed
     */
    function findUserById($id){
        $mysql_pdo_error = false;
        $query = 'SELECT * from user where id=:id;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $ourUser = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $ourUser[0];
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** Vytvori novou radku v tabulce
     * @param $login
     * @param $email
     * @param $pass
     * @return bool
     */
    function addNewUser($login, $email, $pass){
        $mysql_pdo_error = false;
        $query = 'INSERT INTO user (login, email, password, isBlocked, isAdmin)
            VALUES (:loginUser, :emailUser, :passwordUser, 0, 0 )';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':loginUser', $login, PDO::PARAM_STR);
        $sth->bindValue(':emailUser', $email, PDO::PARAM_STR);
        $sth->bindValue(':passwordUser', $pass, PDO::PARAM_STR);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** Zmeni v db ve sloupci block
     * @param $id
     * @param $block
     * @return bool
     */
    function blockOrUnblockUser($id, $block){
        $mysql_pdo_error = false;
        $query = 'UPDATE user SET isBlocked=:isBlocked WHERE user.id = :user_id;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':user_id', $id, PDO::PARAM_INT);
        $sth->bindValue(':isBlocked', $block, PDO::PARAM_INT);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    /**  Odstrani radku s  uzivatelem
     * @param $id
     * @return bool
     */
    function deleteUser($id){
        $mysql_pdo_error = false;
        $query = 'delete from user where user.id=:id_user;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id_user', $id, PDO::PARAM_INT);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** Vytvori novy radek v db s novym prispevkem
     * @param $newtitle
     * @param $newtest
     * @param $user_id
     * @param $newimg
     * @param $pdf
     * @return bool
     */
    function addNews($newtitle, $newtest, $user_id, $newimg, $pdf){
        if($pdf==null){
            $pdf="";
        }
        $mysql_pdo_error = false;
        $query = 'INSERT INTO news (title, text, pdf, image, status_id, user_id, date)
            VALUES (:title, :text, :pdf, :image, 1, :user_id, :date_today );';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':title', $newtitle, PDO::PARAM_STR);
        $sth->bindValue(':text', $newtest, PDO::PARAM_STR);
        $sth->bindValue(':pdf', $pdf, PDO::PARAM_STR);
        $sth->bindValue(':image', $newimg, PDO::PARAM_STR);
        $sth->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $sth->bindValue(':date_today', date("Y-m-d"), PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    /** Zmeni v db prispevek
     * @param $id
     * @param $newtitle
     * @param $newtest
     * @param $newimg
     * @return bool
     */
    function updateNews($id, $newtitle, $newtest, $newimg){
        $mysql_pdo_error = false;
        $query = 'update news SET title=:title, text=:text, image=:image where id = :news_id;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':title', $newtitle, PDO::PARAM_STR);
        $sth->bindValue(':text', $newtest, PDO::PARAM_STR);
        $sth->bindValue(':image', $newimg, PDO::PARAM_STR);
        $sth->bindValue(':news_id', $id, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** BNajde vsechny prispevky
     * @return array
     */
    function findAllNews(){
        $mysql_pdo_error = false;
        $query = "SELECT * from  news;";
        $sth = $this->connection->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /**Najde vsechna honoceni
     * @return array
     */
    function findAllRatings(){
        $mysql_pdo_error = false;
        $query = "SELECT * from  rating_news;";
        $sth = $this->connection->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** Najde vsechny prispevky od uzivatele
     * @param $id
     * @return array
     */
    function findAllNewsByUserId($id){
        $mysql_pdo_error = false;
        $query = "select news.id, title, pdf, news.image, status_id, news.user_id, date 
from news where news.user_id = :id;";
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }
    }

    /**Najde prispevky podle id
     * @param $id
     * @return mixed
     */
    function findNewsById($id){
        $mysql_pdo_error = false;
        $query = 'SELECT * from news where id=:id;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $all = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $all[0];
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }


    }

    /**Smaze prispevek
     * @param $id
     * @return bool
     */
    function deleteNews($id){
        $mysql_pdo_error = false;
        $query = 'DELETE FROM  rating_news where rating_news.news_id=:id_news;
                  delete from news where news.id=:id_news;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id_news', $id, PDO::PARAM_INT);
        $sth->execute();//insert to db
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            //all is ok
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }


    }

    /** Urci zda je prispevek publikovan atd
     * @param $id
     * @param $status
     * @return bool
     */
    function setStatusNews($id, $status){
        $mysql_pdo_error = false;
        $query = "UPDATE news SET status_id=:status WHERE news.id=:id;";
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':status', $status, PDO::PARAM_INT);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            return true;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
            return false;
        }

    }

    /** nalezne vsechny statusy
     * @return array
     */
    function getAllStatus(){
        $mysql_pdo_error = false;
        $query = "select * from status;";
        $sth = $this->connection->prepare($query);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** vrati hodnocei prispevku
     * @param $id
     * @return array
     */
    function getRatingByNews($id){
        $mysql_pdo_error = false;
        $query = "select * from rating_news where news_id =:id;";
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /**Vrati hodnoceni autora
     * @param $id
     * @return array
     */
    function getRatingByAutor($id){
        $mysql_pdo_error = false;
        $query = "select * from rating_news where news_id IN (select id from news where user_id=:id);";
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /**prida moznost ohodnotit prispevek
     * @param $id_user
     * @param $id_news
     * @return bool
     */
    function addNewRatingWithUserId($id_user, $id_news){
        $mysql_pdo_error = false;
        $query = 'INSERT INTO rating_news (news_id, user_id) 
          VALUES (:news_id, :user_id);';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':news_id', $id_news, PDO::PARAM_STR);
        $sth->bindValue(':user_id', $id_user, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }


    }

    /**Prida hodnoceni u prispevku
     * @param $id_user
     * @param $id_news
     * @param $interesting
     * @param $img
     * @param $style
     * @return bool
     */
    function addRatingToNews($id_user, $id_news, $interesting, $img, $style){
        $mysql_pdo_error = false;
        $query = 'update rating_news SET interesting=:interesting, image=:image, style=:style 
          where news_id = :news_id and user_id=:user_id;';
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':interesting', $interesting, PDO::PARAM_STR);
        $sth->bindValue(':style', $style, PDO::PARAM_STR);
        $sth->bindValue(':image', $img, PDO::PARAM_STR);
        $sth->bindValue(':news_id', $id_news, PDO::PARAM_STR);
        $sth->bindValue(':user_id', $id_user, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            return true;
        }else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    /** Vrati hodnoceni uzivatele
     * @param $id
     * @return array
     */
    function findRatingByUserId($id){
        $mysql_pdo_error = false;
        $query = "select id, date, title 
from  news where id in (select news_id from rating_news where user_id=:id) and status_id=1;";
        $sth = $this->connection->prepare($query);
        $sth->bindValue(':id', $id, PDO::PARAM_STR);
        $sth->execute();
        $errors = $sth->errorInfo();
        if ($errors[0] + 0 > 0){
            $mysql_pdo_error = true;
        }
        if ($mysql_pdo_error == false){
            $array = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        }
        else{
            echo "Eror - PDOStatement::errorInfo(): ";
            print_r($errors);
            echo "SQL : $query";
        }

    }

    function close() {
        $connection = null;
        unset($connection);
    }

    function run($query) {
        $this->query = $query;
        $this->result = mysql_query($this->query, $this->link);
        $this->err = mysql_error();
    }
    function row() {
        $this->data = mysql_fetch_assoc($this->result);
    }
    function fetch() {
        while ($this->data = mysql_fetch_assoc($this->result)) {
            $this->fetch = $this->data;
            return $this->fetch;
        }
    }
    function stop() {
        unset($this->data);
        unset($this->result);
        unset($this->fetch);
        unset($this->err);
        unset($this->query);
    }

}