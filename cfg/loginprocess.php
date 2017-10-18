﻿
<?php

    class loginprocess{
        
       function __construct(){
		  @session_start();
	   }
       
        function infoUser(){
            ?>
            <div class="jumbotron">
                <h1>Hi!</h1>
                <p>Это простая и очень выразительная часть с большим экраном, для привлечения дополнительного внимания к вашей информации</p>
                <p><a class="btn btn-primary btn-lg" role="button">Узнать больше</a></p>
            </div>

            <?php
        }
        
        function logIn($alert){
            if(!$alert){
                ?>
                <div class="alert alert-danger">
  				      <strong>Bad password or login.</strong>
			     </div>
                <?php
            }else{
            ?>
<div class="row">
 <div class="col-lg-6">
     <div class="well bs-component">
            <form  action="" method="post" class="form-horizontal">
            <fieldset>
            <legend>Log in </legend>
            <div class="imgcontainer">
                <img src="img_avatar2.png" alt="Avatar" class="avatar">
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label"><b>Username</b></label>
                <div class="col-lg-10">
                    <input type="text" placeholder="Enter Username" name="username" required
               class="form-control" id="inputEmail" placeholder="Email" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                </div>
                </div>
                <div class="form-group">
                    <label  for="inputPassword" class="col-lg-2 control-label"><b>Password</b></label>
                    <div class="col-lg-10">
                        <input type="password" placeholder="Enter Password" name="userpassword" required
           class="form-control" id="inputPassword" placeholder="Password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                    </div>
                </div>
                <input type="hidden" name="action" value="login"><!--  action login contol here  -->
                <div class="form-group">
                    <div class="col-lg-10 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary" name="loginFromUser">Login</button>
                        <button type="reset" class="btn btn-default" class="cancelbtn">Cancel</button>
                    </div>
                </div>
<!--                <div class="form-group">-->
<!--                    <input type="checkbox" checked="checked"> Remember me-->
<!--                    <span class="psw">Forgot <a href="#">password?</a></span>-->
<!--                </div>-->
                </fieldset>
         </form>
     </div>
 </div>
</div>
            <?php
        }
        
    }
    }
?>
