<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 11.01.2018
 * Time: 17:46
 */

class menu{

    function __construct(){

    }

    /**
     * Vzhled menu
     */
    function getMenu(){
        ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Důchody a dávky v ČR v roce 2018</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation" style="">
                            <span class="navbar-toggler-icon"></span>
                        </button>


                        <!-- vzhled titulni strany(nazvy tlacitek) -->
                        <div class="collapse navbar-collapse" id="navbarColor01">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item"><a class="nav-link" href='index.php?page=home'>Titulní strana</a></li>
                                <?php
                                if(@$_SESSION["user"] == null) {
                                    ?>
                                    <li class="nav-item"><a class="nav-link" href='index.php?page=login'>Přihlásit se</a></li>
                                    <?php
                                }else if(@$_SESSION["user"]["isAdmin"] == 0) {
                                    ?>
                                    <li class="nav-item active"><a class="nav-link" href='index.php?page=login'>Účet</a></li>
                                    <li class="nav-item"><a class="nav-link" href='index.php?page=login&action=logOut' action="logOut">Odhlásit se</a></li>

                                    <?php
                                }elseif(@$_SESSION["user"]["isAdmin"] == 1){
                                ?>
                                 <li class="active"><a class="nav-link" href='index.php?page=login'>Administrace</a></li>
                                    <li class="nav-item"><a  class="nav-link" href='index.php?page=login&action=logOut' action="logOut">Odhlásit se</a></li>

                                    <?php
                                }
                                ?>
                                <li class="nav-item"><a  class="nav-link" href='index.php?page=kontakt'>Kontakt</a></li>
                            </ul>

                        </div>
                        </div>
                </div>
            </nav>
        <?php

    }

}