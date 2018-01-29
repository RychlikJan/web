<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.01.2018
 * Time: 17:56
 */
class LoginView{
    /**
     * Přihlašovací okno
     */
    function getLoginForm(){
?>
        <div class="row">
            <div class="col-lg-6" style="transform: translate(50%, 10%);">
                <div class="well bs-component">
                    <form  action="" method="post" class="form-horizontal">
                        <fieldset>
                            <legend>Přihlášení</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label"><b>Uživatelské jméno</b></label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="Login" name="username" required
                                           class="form-control" id="inputEmail" placeholder="Email" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  for="inputPassword" class="col-lg-2 control-label"><b>Heslo</b></label>
                                <div class="col-lg-10">
                                    <input type="password" placeholder="Heslo" name="userpassword" required
                                           class="form-control" id="inputPassword" placeholder="Password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                                </div>
                            </div>
                            <input type="hidden" name="action" value="login">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" >Přihlásit se</button>
                                </div>
                            </div>
                            <label>Pokud ještě nemáte účet, tady si ho <a href='index.php?page=login&action=registrationopen' action="registrationopen">vytvoříte</a>.</label>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        <?php
    }

    /**
     * Okno registrace
     */
    function getRegistrationForm(){
        ?>
        <div class="row">
            <div class="col-lg-6" style="transform: translate(50%, 10%);">
                <div class="well bs-component">
                    <form action="" method="post" class="form-horizontal">
                        <fieldset>
                            <legend>Registrace</legend>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label"><b>Uživatelské jméno</b></label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="Login" name="userlogin" required
                                           class="form-control" id="inputLogin" placeholder="Login" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label"><b>E-mail</b></label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="E-mail adresa" name="useremail" required
                                           class="form-control" id="inputEmail" placeholder="Email" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label  for="inputPassword" class="col-lg-2 control-label"><b>Heslo</b></label>
                                <div class="col-lg-10">
                                    <input type="password" placeholder="Heslo" name="password1" required
                                           class="form-control" id="inputPassword1" placeholder="Password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  for="inputPasswordRepeat" class="col-lg-2 control-label"><b>Zopakujte heslo</b></label>
                                <div class="col-lg-10">
                                    <input type="password" placeholder="Heslo ještě jednou" name="password2" required
                                           class="form-control" id="inputPassword2" placeholder="Password" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAAAXNSR0IArs4c6QAAAPhJREFUOBHlU70KgzAQPlMhEvoQTg6OPoOjT+JWOnRqkUKHgqWP4OQbOPokTk6OTkVULNSLVc62oJmbIdzd95NcuGjX2/3YVI/Ts+t0WLE2ut5xsQ0O+90F6UxFjAI8qNcEGONia08e6MNONYwCS7EQAizLmtGUDEzTBNd1fxsYhjEBnHPQNG3KKTYV34F8ec/zwHEciOMYyrIE3/ehKAqIoggo9inGXKmFXwbyBkmSQJqmUNe15IRhCG3byphitm1/eUzDM4qR0TTNjEixGdAnSi3keS5vSk2UDKqqgizLqB4YzvassiKhGtZ/jDMtLOnHz7TE+yf8BaDZXA509yeBAAAAAElFTkSuQmCC&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;" autocomplete="off">
                                </div>
                            </div>
                            <input type="hidden" name="action" value="registration">
                            <div class="form-group">
                                <div class="col-lg-10 col-lg-offset-2">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" >Přihlásit se</button>
                                </div>
                            </div>
                            <label>Pokud už účet máte, stačí se <a href='index.php?page=login&action=loginopen' action="loginopen">přihlásit</a>.</label>

                        </fieldset>
                    </form>
                </div>
        </div>
        </div>
    <?php
    }

    /**
     * Zobrazeni err
     */
    function errorLogin(){
        ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Něco bylo špatně</strong> zkontrolujte login nebo heslo...
        </div>

        <?php
    }

}
?>