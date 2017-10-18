<?php
/**
 * Created by PhpStorm.
 * User: endem
 * Date: 13.10.2017
 * Time: 16:48
 */

class admin{

    public $cat;

    function __construct(){
        @session_start();
    }

    function getAdminTables($category, $news, $users){
        $cat = $category;

        $count_new_users = 0;
        foreach ($users as $item){
            if($item['type_name']=="new") $count_new_users++;
        }

        $count_dont_publish_news = 0;
        foreach ($news as $item){
            if($item['public']==0) $count_dont_publish_news++;
        }
        ?>
        <div>
        <ul class="nav nav-tabs">
            <li class="active"><a href="#userstable" data-toggle="tab" aria-expanded="true">User
                    <?php if($count_new_users >0 ){ ?><span class="badge"><?php echo $count_new_users ?></span>
                    <?php } ?></a> </a></li>
            <li class=""><a href="#newspanel" data-toggle="tab" aria-expanded="false">News
                    <?php if($count_dont_publish_news >0 ){ ?><span class="badge"><?php echo $count_dont_publish_news ?></span>
                    <?php } ?></a> </a></li>
            <li class=""><a href="#categorytable" data-toggle="tab" aria-expanded="true">Category</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="userstable">
                <h2>Users table</h2>
                <br>
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User login</th>
                        <th>e-mail</th>
                        <th>User type</th>
                        <th>Edit type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $item){
                        $type = 2;
                        ?>
                        <tr <?php $publiting = "";
                        if($item['type_name']== "new"){
                            $type = 0;
                            ?>
                            class = "success";
                            <?php
                        }else if($item['type_name']== "blocked") {
                            $type = 3;
                            ?>
                            class = "danger";
                            <?php
                        }else if($item['type_name']== "admin") {
                            $type = 1;
                            ?>
                            class = "info";
                            <?php
                        }
                        ?> >
                            <td><?php echo $item['id'] ?></td>
                            <td><?php echo $item['login']   ?></td>
                            <td><?php echo $item['email'] ?></td>
                            <td><?php echo $item['type_name'] ?></td>
                            <td>
<!--                                <form action="" method="POST">-->

                                <?php if($type==0){ ?> <!-- "new"-->
<!--                                    <input type="hidden" name="action" value="settype">-->
                                    <button type="submit"  class="btn btn-success btn-xs"
                                            name="confirm" data-toggle="modal" data-target="#modalConfirm<?php echo $item['id'] ?>" >Confirm</button>
                                <?php }
                                if($type == 3){ ?> <!-- "blocked"-->
                                        <input type="hidden" name="action" value="unblock">
                                        <button type="submit"  class="btn btn-warning btn-xs"
                                                name="unblock" data-toggle="modal" data-target="#modalUnBlock<?php echo $item['id'] ?>" >Unblock</button>
                                <?php }
                                if($type == 2 || $type==0){ ?>
                                        <input type="hidden" name="action" value="block">
                                        <button type="submit"  class="btn btn-warning btn-xs"
                                                name="block" name="unblock" data-toggle="modal" data-target="#modalBlock<?php echo $item['id'] ?>" >Block</button>
                                <?php }
                                if($type == 2 || $type==0 || $type==3){ ?>
                                        <input type="hidden" name="action" value="delete">
                                        <button type="submit"  class="btn btn-danger btn-xs"
                                                name="delete" name="unblock" data-toggle="modal" data-target="#modalDelete<?php echo $item['id'] ?>" >Delete</button>
                                <?php }?>
<!--                                </form>-->

                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>

            </div>
            <div class="tab-pane fade " id="newspanel">
                <h2>News table</h2>
                <br>
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Publish</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($news as $item){
                        $date=date_create($item['date']);

                        ?>
                        <tr <?php $publiting = "";
                        if($item['public']==0){
                            $publiting = "Accept";
                           ?>
                            class = "success";
                            <?php
                        }else{
                            $publiting= "Is publish";
                        }
                        ?> >
                            <td><?php echo $item['id'] ?></td>
                            <td><em><?php echo  date_format($date, 'd-m-Y') ?></em></td>
                            <td><?php echo $item['login'] ?></td>
                            <td><?php echo $item['title'] ?></td>
                            <td><?php echo $item['category_name'] ?></td>
<!--                            <input type="hidden" name="action" value="publish">-->
                            <td>
                                <?php
                                if($item['public']==1){
                                    echo $publiting;
                                }else{?>
                                    <form method="post" class="table_content_form">
                                        <button type="submit"  class="btn btn-success btn-xs" name="publish_news"><?php echo $publiting ; ?> </button>
                                        <input type="hidden" name="news_id" value="<?php echo $item['id'] ?>"/>
                                    </form>
                                    <?php }?>
                            </td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade " id="categorytable">
                <h2>Category table</h2>
                <br>
                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name category</th>
                        <th>News in category</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cat as $category){ ?>
                    <tr>
                        <td><?php echo $category['id'] ?></td>
                        <td><?php echo $category['category_name'] ?></td>
                        <td>Column content</td>
                        <td><?php echo $category['image_url'] ?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
                <button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#modalForCategory">Add new category</button>
            </div>
        </div>
        </div>

        <!-- Modal For Category -->
        <div class="modal fade" id="modalForCategory" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <p>This is a large modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal For Confirmation User -->
        <?php foreach ($users as $item) {
//                echo "ID is" .$item['id'];
            ?>
            <div class="modal fade" id="modalConfirm<?php echo $item['id'] ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to confirm user <?php echo  $item['login']?>?</p>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="POST">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="hidden" name="action" value="confirmUser">
                            <button type="submit" class="btn btn-primary" data-dismiss="modal" name="<?php echo $item['id'] ?>">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--            block user -->
            <div class="modal fade" id="modalBlock<?php echo $item['id'] ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to block user <?php echo  $item['login']?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="hidden" name="action" value="blockUser">
                            <button type="submit" class="btn btn-primary" >Block</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--            unblock user -->
            <div class="modal fade" id="modalUnBlock<?php echo $item['id'] ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to unblock user <?php echo  $item['login']?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="hidden" name="action" value="unblockUser">
                            <button type="submit" class="btn btn-primary" >Block</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--            delete user -->
            <div class="modal fade" id="modalDelete<?php echo $item['id'] ?>" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to delete user <?php echo  $item['login']?>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="hidden" name="action" value="deleteUser">
                            <button type="submit" class="btn btn-primary" >Block</button>
                        </div>
                    </div>
                </div>
            </div>


            <?php
        }



    }

    function confirmUser(){
        ?>

        <div class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body…</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>


        <?php
    }



}
?>