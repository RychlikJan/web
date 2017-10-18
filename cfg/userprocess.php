<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.10.2017
 * Time: 16:59
 */


class userprocess{

    function __construct(){
        @session_start();
    }

    function getUserMainInfo($newsByUser){
        ?>

        <div class="row">
            <div class="col-lg-6">
                <div class="well bs-component">
                    <form  action="" method="post" class="form-horizontal">
            <fieldset>
                <legend>User</legend>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">Login</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputDefault"  value="<?php echo $_SESSION["user"]["login"] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="col-lg-2 control-label">E-mail</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" id="inputDefault"  value="<?php echo $_SESSION["user"]["email"] ?>">
                    </div>
                </div>

                <input type="hidden" name="action" value="edit_user_info"><!--  action here  -->
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </div>
            </fieldset>
        </form>
                </div>
            </div>
        </div>
        <h2>Your news</h2>
        <table class="table table-striped table-hover ">
            <thead>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Publish</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php foreach ($newsByUser as $item){
                $date=date_create($item['date']);

                ?>
            <tr <?php $publiting = "";
            if($item['public']==0){
                $publiting = "Edit";
                ?>
                class = "success";
                <?php
            }else{
                $publiting= "Is publish";
            }
            ?> >
                <td><em><?php echo  date_format($date, 'd-m-Y') ?></em></td>
                <td><?php echo $item['title'] ?></td>
                <td>
                    <?php
                    if($item['public']==1){
                        echo $publiting;
                    }else{?>
                        <form method="post" class="table_content_form">
                            <button type="submit"  class="btn btn-success btn-xs" name="edit_news"><?php echo $publiting ; ?> </button>
                            <input type="hidden" name="news_id" value="<?php echo $item['id'] ?>"/>
                        </form>
                    <?php }?>
                </td>
            </tr>
            <?php }?>
            </tr>
            </tbody>
        </table>

        <?php
    }


    function setUserInfoTemplate(){

        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="well bs-component">
                    <form  action="" method="post" class="form-horizontal">
                        <fieldset>
                            <legend>User</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Login</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputDefault"  value="<?php echo $_SESSION["user"]["login"] ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">E-mail</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputDefault"  value="<?php echo $_SESSION["user"]["email"] ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                <div class="col-lg-10">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                                </div>
                            </div>
                            <input type="hidden" name="action" value="save_user_info"><!--  action here  -->
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
<!--                                    <button type="reset" class="btn btn-default">Cancel</button>-->
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
<?php
    }

}
?>