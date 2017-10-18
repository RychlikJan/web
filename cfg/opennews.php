<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 13.10.2017
 * Time: 18:11
 */
    class viewNews{
        function __construct(){
            @session_start();
        }

        function getNewsTemplate($news){
            $date=date_create($news['date']);

            if($news['image_url'] != null){
                echo "image exist";
            }?>
            <div class="col-lg-12">
                <img src="<?php echo $news['image_news_url'] ?>" height="60%" width="60%">
            </div>
            <h2><?php echo $news['title']?></h2>
            <div>
                <p><span class="text-muted"><?php echo date_format($date, 'd.m.Y');?> </span>
                <span  class="text-success"><?php echo $news['login']?></span ></p>
            </div>
            <p><?php echo $news['note'];
                echo '<pre>', print_r($news, true), '</pre>';?></p>

            <?php
        }

        function viewSmallNews($arrayNews){
            ?>
            <div class="posts">
            <?php
            foreach ($arrayNews as $news){
                $date=date_create($news['date']);

                ?>
                <div class="row post text">
                    <div class="col-lg-2">
                        <br>
                        <div class="date">
                            <span class="text-muted"><?php echo date_format($date, 'd.m.Y');?> </span>
                        </div>
                        <div>
                            <p>
                                <span  class="text-success"><?php echo $news['login']?></span ></p>
                        </div>
                    </div>
                    <div class="col-lg-6 entry">
                        <div class="title">
                            <h2><a href='index.php?page=page&&newsid=<?php echo $news['id'] ?>' action="open_news"><?php echo $news['title']?></a></h2>
                        </div>
                        <div class="POST">
                            <figure class="tmblr-full">
                                <img src="<?php echo $news['image_news_url'] ?>" alt="image" width="500" height="303">
                                <br>
                            </figure>
                        </div>
                    </div>
                <div> <p>
                        <?php if($news['category_name'] != null){
                            ?>
                    <p><span class="text-info"><?php echo $news['category_name']?></span></p>

                            <?php
                        }?>

                </div>
                </div>
                <br>
                <?php

            }
            ?>
            </div>
            <?php
        }

        function viewSmallNewsByCategory($category, $arrayNews){
            ?>
            <div class="col-lg-12">
                <div class="page-header">
                    <img src="<?php echo $category['image_url'] ?>" height="75%" width="75%">
                    <h1><?php echo $category['category_name'] ?></h1>
                </div>
            </div>
            <br>
            <?php
            $this->viewSmallNews($arrayNews);
        }
    }

?>