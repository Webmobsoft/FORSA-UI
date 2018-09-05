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
          if(isset($_POST['add']))
          {
              $mid = $_POST['mid'];
              $swap = $_POST['swap'];
              $kurve = $_POST['kurve'];
              $other = $_POST['other'];
              $insert_interest = mysql_query("insert into tbl_interest(mid,swap,kurve, other)values('".$mid."','".$swap."','".$kurve."', '".$other."')");
              $id = mysql_insert_id();
              if($id > 0)
              {
                  $msg = "You have added successfully";
              }
              else
              {
                  $msg = "Please try again";
              }
          }
            ?>
           <?php
           
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
                                         <form name="add_interest" method="post" id="add_interest">
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
                                                           
                                                            for($i=1;$i<=15;$i++)
                                                            {
                                                                echo "<option value=".$i.">".$i."</option>";
                                                            }
                                                                ?>
                                                            <option value="20">20</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Swap</td>
                                                    <td class="col-md-8"><input type="text" placeholder="" id="swap" name="swap" value="" class="form-control" required></td>
                                                    <div name="add_interest_swap_errorloc" class="errorstring"></div>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Kurve</td>
                                                    <td class="col-md-8"><input type="text" id="kurve" name="kurve" placeholder="" value="" class="form-control" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4"></td>
                                                    <td class="col-md-8"><input type="text" id="other" name="other" placeholder="" value="" class="form-control"></td>
                                                </tr>
                                              
                                                
                                               <tr>
                                                    
                                                    <td class="col-md-1"><input type="submit" placeholder="" name="add" value="Add" class="btn btn-primary style2"></td>
                                                </tr>
                                                </tbody>
                                                </table>
                                                </form>
<!--                                            <script  type="text/javascript">
                                            var frmvalidator = new Validator("add_interest");
                                            frmvalidator.addValidation("swap","req","Please enter Swap");
                                            frmvalidator.addValidation("kurve","req","Please enter kurve");
                                            </script>-->
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
