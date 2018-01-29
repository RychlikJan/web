<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.01.2018
 * Time: 18:24
 */

class UserView{

    /**Nacteni informaci o uzivateli
     * Zda je user zablokovan
     */
    function getUserDetails(){
        $user_type = "AUTOR";
        $unblock = true;
        if(@$_SESSION["user"]["isBlock"] == 1){
            $user_type = "ZABLOKOVAN/Á";
            $unblock = false;
        }

        ?>
        <div class="jumbotron">
            <h2 >Ahoj, <?php echo  @$_SESSION["user"]["login"] ?>!</h2>
            <p class="lead">Jste <?php echo $user_type?></p>
            <?php
            if($unblock){
                ?>
                <p>Vy mužete přidat nový přispevek a nebo ohodnotit přispěvky přidaný administratorem.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href='index.php?page=editace&action=openform' action="openform" role="button">Přidat nový přispevek</a>
                </p>
                <?php
            }
            ?>
        </div>


        <?php
    }

    /**Vytvoreni tabulky s prispevky
     * @param $newsArray
     * @param $ratingNewsArray
     * @param $statusArray
     */
    function getNewsTable($newsArray, $ratingNewsArray, $statusArray){
        ?>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Datum</th>
                <th scope="col">Název</th>
                <th scope="col">Status </th>
                <th scope="col">Hodnocení </th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($newsArray as $news){
            ?>
            <tr>
                <th scope="row"><?php echo $news["date"]?></th>
                <td><a href='index.php?page=page&&news_id=<?php echo $news['id']?>&&action=open_news' action="open_news"><?php echo $news["title"]?></a></td>
                <td><?php
                    foreach($statusArray as $status ){
                        if($status["id"] == $news["status_id"]){
                            echo $status["name"];
                        }
                    }
                    ?></td>
                <td><?php

                    if($ratingNewsArray != null){
                        $result = "";
                        $sum = 0;
                        $numberOf = 0;

                        foreach ($ratingNewsArray as $rating){
                            if($news["id"]== $rating["news_id"]){
                                $numberOf++;
                                $sum = ($rating["interesting"]+$rating["image"]+$rating["style"])/3;
                            }
                        }
                        if($numberOf != 0){
                            $result = $sum/$numberOf;
                            if($result != 0) echo $result;
                            else  echo "bez hodnocení";
                        }else{
                            echo "bez hodnocení";
                        }

                    }else{
                        echo "bez hodnocení";
                    }
                    ?></td>
            </tr>
            <?php
}

            ?>
            </tbody>
        </table>

        <?php

    }

    /**Vzled pro ohodnoceni tabulky
     * @param $newsArray
     */
    function getNewsTableForRating($newsArray){
        ?>

        <h3>Prosím ohodnotit přispěvky od administratora</h3>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Datum</th>
                <th scope="col">Název</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($newsArray as $news){
                ?>
                <tr>
                    <th scope="row"><?php echo $news["date"]?></th>
                    <td><a href='index.php?page=page&&news_id=<?php echo $news['id']?>&&action=open_news' action="open_news"><?php echo $news["title"]?></a></td>
                </tr>
                <?php
            }

            ?>
            </tbody>
        </table>

        <?php

    }

}