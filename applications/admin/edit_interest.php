<?php include_once 'header.php';?>
<!-- Wrapper Start -->
<div class="wrapper">
	<div class="structure-row">
        <!-- Sidebar Start -->
        <?php include_once 'side_bar.php';?>
        <!-- Sidebar End -->
        <!-- Right Section Start -->
        <div class="right-sec">
            <!-- Right Section Header Start -->
            <?php include_once 'top_right.php';?>
            <!-- Right Section Header End -->
            <?php
            $msg = '';
            if(isset($_GET['id']))
            {
                 $id = $_GET['id'];
            }
            if(isset($_POST['update']))
            {
                     $mid = $_POST['mid'];
              $swap = $_POST['swap'];
              $kurve = $_POST['kurve'];
              $other = date("d.m.Y");
              $insert_interest = mysql_query("update tbl_interest set mid = '".$mid."',swap='".$swap."',kurve='".$kurve."', other = '".$other."' where id='".$id."'");
              //$id = mysql_insert_id();
              if($insert_interest)
              {
                  $msg = "You have Updated successfully";
              }
              else
              {
                  $msg = "Please try again";
              }
            }
            ?>
            <?php
               // echo "select tbl_users.*,tbl_fedafin_rating.rating_name from tbl_users inner join  tbl_fedafin_rating on tbl_fedafin_rating.id=tbl_users.fedafin_rating where id='$id'";
                $select_query  = mysql_query("select * from tbl_interest where id='$id'");
                $select_data = mysql_fetch_array($select_query);
            
            ?>
            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Update</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <form name="update_user" method="post">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                    if($msg != '')
                                                    {
                                                        echo "<div class='alert alert-success'>".$msg."</div>";
                                                    }
                                                   
                                                    ?>
                                                <!--<div class="alert alert-success"></div>-->
                                                   <tr>
                                                    <td class="col-md-4">Mid</td>
                                                    <td class="col-md-4">
                                                        <select class="form-control" id="mid" name="mid" id="fedral_rating_verified">
                                                            <?php
                                                            $selected = '';
                                                           
                                                            for($i=1;$i<=10;$i++)
                                                            {
                                                                if($select_data['mid'] == $i)
                                                                {
                                                                    $selected = "selected";
                                                                }
                                                                else
                                                                {
                                                                    $selected = '';
                                                                }
                                                                echo "<option value=".$i." ".$selected.">".$i."</option>";
                                                            }
                                                                ?>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Swap</td>
                                                    <td class="col-md-8"><input type="text" placeholder="" id="swap" name="swap" value="<?php echo $select_data['swap']?>" class="form-control" required></td>
                                                    <div name="add_interest_swap_errorloc" class="errorstring"></div>
                                                </tr>
                                               <tr>
                                                    <td class="col-md-4">Kurve</td>
                                                    <td class="col-md-8"><input type="text" id="kurve" name="kurve" placeholder="" value="<?php echo $select_data['kurve']?>" class="form-control" required></td>
                                                </tr>
                                               
                                               <tr>
                                                    <td class="col-md-1"><input type="submit" placeholder="" name="update" value="Update" class="btn btn-primary style2"></td>
                                                </tr>
                                               
<!--                                                <tr>
                                                    <td class="col-md-4">Input Field [type = File]</td>
                                                    <td class="col-md-8"><input type="file"></td>
                                                </tr>-->
<!--                                                <tr>
                                                    <td class="col-md-4">Textarea</td>
                                                    <td class="col-md-8"><textarea rows="3" class="form-control"></textarea></td>
                                                </tr>-->
<!--                                                <tr>
                                                    <td class="col-md-4">Select</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control">
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                        </select>
                                                    </td>
                                                </tr>-->
<!--                                                <tr>
                                                    <td class="col-md-4">Select - Disabled</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control" id="disabledSelect" disabled="disabled">
                                                            <option>Disabled select</option>
                                                        </select>
                                                    </td>
                                                </tr>-->
<!--                                                <tr>
                                                    <td class="col-md-4">Error Field</td>
                                                    <td class="col-md-8">
                                                        <div class="form-group has-error">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Warning field</td>
                                                    <td class="col-md-8">
                                                        <div class="form-group has-warning">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>-->
<!--                                                <tr>
                                                    <td class="col-md-4">Success field</td>
                                                    <td class="col-md-8">
                                                        <div class="form-group has-success">
                                                            <input type="text" class="form-control">
                                                        </div>
                                                    </td>
                                                </tr>-->
                                       
                                            </tbody>
                                        </table>
                                             </form>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row End -->
                </div>
            </div>
            <!-- Content Section End -->
        </div>
        <!-- Right Section End -->
    </div>
</div>
<!-- Wrapper End -->
</body>
</html>
