<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.01.2018
 * Time: 18:23
 */

class AdminView{
    /** hlavicka stránky
     * @param $number_of_user pocet uziv.
     * @param $number_of_news pocet prispevku.
     */
    function getPanel($number_of_user, $number_of_news){
        ?>
        <div class="jumbotron">
            <h2 >Přihlášen jako ADMINISTRÁTOR!</h2>
            <?php
            ?>
            <p>Vy zde <?php echo $number_of_user?> uživatelů a <?php echo $number_of_news?> příspěvků.</p>
            <?php

            ?>
        </div>

        <?php
    }

    /** Vytvoreni tabulky s prispevky
     * @param $newsArray prispevky
     * @param $ratingNewsArray hodnoceni prispevku
     */
    function getNewsTable($newsArray, $ratingNewsArray){
    ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Datum</th>
                <th scope="col">Název</th>
                <th scope="col">Status </th>
                <th scope="col">Hodnocení </th>
                <th scope="col">Počet hodnotících uživatelů</th>

            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($newsArray as $news){
                $number_of_rating = 0;
                ?>
                <tr>
                    <th scope="row"><?php echo $news["date"]?></th>
                    <td><a href='index.php?page=page&&news_id=<?php echo $news['id']?>&&action=open_news' action="open_news"><?php echo $news["title"]?></a></td>
                    <td><?php switch($news["status_id"]){
                            case 1: ?>
                                <p class="text-warning">
                                <?php echo "v recenzním řízení";
                            break;
                            case 2: ?>
                                <p class="text-info">
                            <?php echo "přijat";
                            break;
                            case 3:?>
                                <p class="text-danger">
                            <?php  echo "odmítnut ";
                            break;
                        }?>
                                </p>
                    </td>
                    <td><?php

                        if($ratingNewsArray != null){
                            $sum = 0;
                            $numberOf = 0;

                            foreach ($ratingNewsArray as $rating){
                                if($news["id"]== $rating["news_id"]){
                                    $numberOf++;
                                    $sum = ($rating["interesting"]+$rating["image"]+$rating["style"])/3;
                                }
                            }
                            if($numberOf != 0){
                                $number_of_rating +=$numberOf;
                                echo $sum/$numberOf;
                            }else{
                                echo "bez hodnocení";
                            }

                        }else{
                            echo "bez hodnocení";
                        }
                        ?></td>
                    <td><?php echo $number_of_rating ?></td>
                </tr>
                <?php
            }

            ?>
            </tbody>
        </table>

        <?php

    }

    /**Tabulka s uzivateli
     * @param $userArray
     * @param $newsArray
     */
    function getUserTable($userArray, $newsArray){
        ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">login</th>
                <th scope="col">e-mail </th>
                <th scope="col">počet příspěvků </th>
                <th>akce</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($userArray as $user){
                ?>
                <tr>
                    <th scope="row"><?php echo $user["id"]?></th>
                    <td><?php echo $user["login"]?></td>
                    <td><?php echo $user["email"]?></td>
                    <td><?php echo $this->numberOfNewsByUser($user, $newsArray)?></td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                        <?php
                        if( $user["isBlocked"]==1){
                            ?>
                            <a href='index.php?page=login&action=unblock&&user_id=<?php echo $user['id']?>' action="unblock" role="button" class="btn btn-info">odblokovat</a>
                            <?php
                        }else{
                            ?>
                            <a href='index.php?page=login&action=block&&user_id=<?php echo $user['id']?>' action="block" role="button" class="btn btn-warning">
                                zablokovat</a>
                            <?php
                        }
                        ?>
                            <a href='index.php?page=login&action=delete&&user_id=<?php echo $user['id']?>' action="delete" role="button" class="btn btn-danger">smazat</a>
                            <?php

                       ?>
                        </div>
                    </td>
                </tr>
                <?php
            }

            ?>
            </tbody>
        </table>

        <?php
    }

    /** pocet prispevku od uzivatele
     * @param $user uzivatel
     * @param $newsArray prispevky
     * @return int pocet prispevku uzivatele
     */
    function numberOfNewsByUser($user, $newsArray){
        $number = 0;
        foreach ($newsArray as $news){
            if($news["user_id"]== $user["id"])$number++;
        }
        return $number;
    }

    /** pridani hodnoceni uzivatele
     * @param $users uzivatel
     * @param $id_news prispevek
     * @param $autor_id autor
     * @param $ratings hodnocení
     */
    function getUserTableToNews($users, $id_news, $autor_id, $ratings){

        ?>
        <form  method="post" class="form-horizontal">
        <fieldset>
            <legend>Výběr uživatelů</legend>
            <div class="form-group">

            <?php

        foreach ($users as $user){

            if($this->canAddRating($user,  $autor_id, $id_news, $ratings)){
        ?>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" value="<?php echo $user["id"]?>" id="<?php echo $user["id"]?>" name="users[]">
                    <label class="custom-control-label" for="<?php echo $user["id"]?>"><?php echo $user["login"]?></label>
                </div>

        <?php
            }else{
                ?>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="<?php echo $user["id"]?>" disabled="">
                    <label class="custom-control-label" for="<?php echo $user["id"]?>"><?php echo $user["login"]?>
                    (<?php
                        $result = "";
                        if($user["isBlocked"]==1){
                            $result = "zablokovan";
                        }else{
                            $result = $this->getRatingByUser($id_news, $ratings, $user);
                        }
                        echo $result;
                        ?>)
                    </label>
                </div>

                <?php
            }
        }

        ?>
            </div>
            <input type="hidden" name="action" value="save_user_for_rating">
            <div class="form-group">
                <div class="col-lg-12 col-lg-offset-2">
                    <button type="submit" class="btn btn-success btn-block" >Uložit</button>
                    <input type="hidden" name="news_id" value="<?php echo $id_news ?>"/>
                </div>
            </div>

        </fieldset>
        </form>
        <?php

    }

    /** Zda muze uzivatel hodnotit prispevek
     * @param $user uzivatel
     * @param $autor_id id autora
     * @param $id_news prispevek
     * @param $ratings hodnoceni
     * @return bool ano/ne
     */
    function canAddRating($user, $autor_id, $id_news, $ratings){
        if($user["isBlocked"]==1 || $user["id"]== $autor_id ||  $user["isAdmin"]==1){
            return false;
        }

        foreach ($ratings as  $rating){
            if($rating["user_id"]==$user["id"] && $rating["news_id"]==$id_news){
                return false;
            }
        }
        return true;
    }

    /** hodnoceni uzivatelu
     * @param $id_news prispevek
     * @param $ratings hodnoceni
     * @param $user uzivatel
     * @return float|int|string
     */
    function getRatingByUser($id_news, $ratings, $user){
        $sum = 0;
        $numberOf = 0;

        foreach ($ratings as $rating){

            if($rating["user_id"]==$user["id"] && $rating["news_id"]==$id_news){
                if($rating["interesting"] != null && $rating["image"]!= null && $rating["style"]){
                    $numberOf++;
                    $sum = ($rating["interesting"]+$rating["image"]+$rating["style"])/3;
                }
            }
        }
        if($numberOf != 0){
            return $sum/$numberOf;
        }else{
            return "bez hodnocení";
        }

    }



}