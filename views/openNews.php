<?php
/**
 * Created by PhpStorm.
 * User: Jan Rychlik
 * Date: 11.01.2018
 * Time: 17:58
 */
class NewsView{

    /**
     * vytvoreni noveho prispevku
     */
    function getForm(){
?>
        <div class="row">
            <div class="col-lg-10">
                <div class="well bs-component">
                    <form  action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Nový příspěvek </legend>
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">Název</label>
                                <input type="text" placeholder="Title" required class="form-control" name="newTitle" id="inputDefault">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">Obrázek</label>
                                <input type="text" placeholder="Image" required class="form-control" name="imageNews" id="inputDefault">
                            </div>


                            <div class="form-group">
                                <label for="textArea" class="control-label">Text</label>
                                <textarea  class="form-control"  name="newText" id="textArea"></textarea>
                                <script>
                                    CKEDITOR.replace( 'newText' );
                                </script>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile" >Vložení souboru</label>
                                <input type="file" class="form-control-file" accept="application/pdf"
                                       name="fileToUpload" id="fileToUpload" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Lze nahrát jen PDF soubor</small>
                            </div>
                            <br/>
                            <input type="hidden" name="action" value="addnews"><!--  action contol here  -->
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-10">
                                    <button type="submit" class="btn btn-primary">Přidat příspěvek</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

<?php
    }

    /**Editace prispevku
     * @param $news
     */
    function getEditionNews($news){
        ?>
        <div class="row">
            <div class="col-lg-10">
                <div class="well bs-component">
                    <form  action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <fieldset>
                            <legend> Editace </legend>
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">Název</label>
                                <input type="text" placeholder="Title" required class="form-control" name="newTitle" value="<?php echo $news["title"]?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="inputDefault">Obrázek</label>
                                <input type="text" placeholder="Image" required class="form-control" name="imageNews" value="<?php echo $news["image"]?>">
                            </div>


                            <div class="form-group">
                                <label for="textArea" class="control-label">Text</label>
                                <textarea  class="form-control"  name="newText" id="textArea"><?php echo $news["text"]?>"</textarea>
                                <script>
                                    CKEDITOR.replace( 'newText' );
                                </script>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile" >Vložení souboru</label>
                                <input type="file" class="form-control-file" accept="application/pdf"
                                       name="fileToUpload" id="fileToUpload" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Lze nahrát PDF soubor</small>
                            </div>
                            <br/>
                            <input type="hidden" name="action" value="update_news">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-10">
                                    <button type="submit" class="btn btn-primary">Uložit</button>
                                </div>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }

    /**Hodnocení příspěvku
     * @param $news
     * @param $ratings
     */
    function getPageNews($news, $ratings){
        $user_can_change_rating = false;
        if($ratings != null){
            foreach ($ratings as $rating){
                if($rating["user_id"] == @$_SESSION["user"]["id"]) $user_can_change_rating=true;
            }
        }
        ?>
        <div style="padding-top: 50px;">
            <?php
            if(@$_SESSION["user"]["isAdmin"] == 1){
                if($news["status_id"]!=2){
                    ?>
                    <a href='index.php?page=editace&action=accept&&news_id=<?php echo $news['id']?>' action="accept" class="btn btn-success" role="button">Přijmout </a>
                    <a href='index.php?page=login&action=tableusers&&news_id=<?php echo $news['id']?>&&autor_id=<?php echo $news['user_id']?>' action="tableusers" role="button" class="btn btn-info">Přidat pro hodnocení</a>
                    <a href='index.php?page=editace&action=decline&&news_id=<?php echo $news['id']?>' action="decline" role="button" class="btn btn-warning">Odmítnut</a>
                    <?php
                }
                ?>
        <a href='index.php?page=editace&action=deletenews&&news_id=<?php echo $news['id']?>' action="deletenews" role="button" class="btn btn-danger">Smazat</a>
            <?php }?>

            <?php if((@$_SESSION["user"]["id"] == $news["user_id"])&&  $news["status_id"]==1){?>
                <a href='index.php?page=editace&action=open_form_for_edit&&news_id=<?php echo $news['id']?>' action="open_form_for_edit" class="btn btn-info" role="button">Editovat</a>
                <a href='index.php?page=editace&action=deletenews&&news_id=<?php echo $news['id']?>' action="deletenews" class="btn btn-danger" role="button">Smazat</a>
            <?php }?>

            <?php if($user_can_change_rating){?>
            <div class="well bs-component">
                <form  method="post" class="form-horizontal">
                    <fieldset>
                        <legend>Hodnocení </legend>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control" name="image_rating">
                                        <option selected="">Obrázek</option>
                                        <option value="1">Kvalitní</option>
                                        <option value="2">Dostatečný</option>
                                        <option value="3">Nekvalitní</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control" name="style_rating">
                                        <option selected="">Styl</option>
                                        <option value="1">1(Nejlepší)</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control" name="interesting_rating">
                                        <option selected="">Obsah příspěvku</option>
                                        <option value="1">1(Nejlepší)</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="save_rating">
                        <div class="form-group">
                            <div class="col-lg-12 col-lg-offset-2">
                                <button type="submit" class="btn btn-success btn-block" >Uložit</button>
                                <input type="hidden" name="news_id" value="<?php echo $news['id'] ?>"/>

                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
            <?php }?>


            <h2><?php echo $news["title"]?></h2>
        <h4><?php echo $news["date"]?></h4>
        <img style="height: 100%; width: 100%; display: block;" src="<?php echo $news["image"]?>" alt="Card image">
    <?php if($news["pdf"]!= null  || strlen ($news["pdf"])>1){?>
            <a href='index.php?page=editace&action=download&&pdf=<?php echo $news['pdf']?>' action="download"
               style="font-size:24px" role="button" class="btn btn-success" name="download">
                Stáhnout PDF <i class="fa fa-file-pdf-o"></i></a>
            </form>
    <?php }?>
            <div>
            <h2><?php echo $news["text"]?></h2>
        </div>
        </div>




        <?php
    }

    /**
     * Přidání příspevku
     */
    function addNewsWasTrue(){
        ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Přispěvek byl uložen!</strong> Mužete najít ho u sebe v  <a href='index.php?page=login' class="alert-link">profilu</a>.
        </div>

        <?php
    }

    /** Příjem příspěvku
     * @param $type
     */
    function setStatusNewsWas($type){
        if($type == "accept"){
        ?>
        <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Příspěvek byl příjat!</strong> Teď patří mezi publikované příspěvky</a>.
        </div>
        <?php
        }elseif ($type == "decline"){
            ?>
            <div class="alert alert-dismissible alert-warning">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Příspěvek byl odmítnout!</strong>
            </div>
            <?php
        }
    }

    /**Bylo provedeno ohodnoceni
     * @param $result
     */
    function addRatingToNews($result){

        if($result){
            ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Hodnocení bylo uloženo!</strong> Pokud příspěvek nebyl dosud schválen, tak své hodnocení můžete změnit.
            </div>

            <?php
        }else {
            ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Hodnocení nebylo uloženo!</strong> Musíte ohodnotit všechny položky.
            </div>
            </div>
            <?php
        }
    }

    /** Návrat do domovské stránky
     * @param $newsArray
     */
    function getHomePage($newsArray){
        ?>
        <div class="container" style="padding-top: 50px;">
<!--            slider -->
        <div class="row">
       <?php
       if($newsArray != null){
           foreach($newsArray as $news){
               if($news["status_id"] == 2){
                   $this->getOneNews($news);
               }
           }
       }

        ?>
        </div>
        </div><br><br>

        <?php
    }

    /** Prispevek
     * @param $news
     */
    function getOneNews($news){
//        echo $news['title'];

        ?>
        <div class="col-sm-4">
            <div class="card border-primary mb-3" style="max-width: 20rem;">
                <div class="card-header"><?php echo $news['date'] ?></div>
                <div class="card-body text-primary">
                    <h4 class="card-title"><a href='index.php?page=page&&news_id=<?php echo $news['id']?>&&action=open_news' action="open_news"><?php echo$news['title'] ?></a></h4>
                    <div class="card-body text-primary"><img src="<?php echo $news['image']?>" class="img-responsive" style="width:100%" alt="Image"></div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Smazani prispevku
     */
    function deleteModal(){
        ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Článek byl smazán!</strong>
        </div>

        <?php
    }

}
?>