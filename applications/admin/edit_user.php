<?php include_once 'header.php'; ?>
<!-- Wrapper Start -->
<div class="wrapper">
    <div class="structure-row">
        <!-- Sidebar Start -->
        <?php include_once 'side_bar.php'; ?>
        <!-- Sidebar End -->
        <!-- Right Section Start -->
        <div class="right-sec">
            <!-- Right Section Header Start -->
            <?php include_once 'top_right.php'; ?>
            <!-- Right Section Header End -->
            <?php
            $msg = '';
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            if (isset($_POST['update'])) {
                if (count($_POST['user_type']) == 2) {
                    $userType = "both";
                    $viewType = "borrower";
                } else {
                    $userType = implode(',', $_POST['user_type']);
                    $viewType = $userType;
                }

                $accessClientGroups = implode(',', $_POST['access_given_clientgroup']);
                $ClientGroups = implode(',', $_POST['client_group']);

                $company_name = mysqli_real_escape_string($mysql_connect, $_POST['company_name']);
                $street = mysqli_real_escape_string($mysql_connect, $_POST['street']);
                $zip_code = mysqli_real_escape_string($mysql_connect, $_POST['zip_code']);
                $city = mysqli_real_escape_string($mysql_connect, $_POST['cityName']);
                $owner_account = mysqli_real_escape_string($mysql_connect, $_POST['owner_account']);
                $bank = mysqli_real_escape_string($mysql_connect, $_POST['bank']);
                $iban_number = mysqli_real_escape_string($mysql_connect, $_POST['iban_number']);
                $biccode = mysqli_real_escape_string($mysql_connect, $_POST['biccode']);
                $sparesection1 = mysqli_real_escape_string($mysql_connect, $_POST['sparesection1']);
                $sparesection2 = mysqli_real_escape_string($mysql_connect, $_POST['sparesection2']);
                $sparesection3 = mysqli_real_escape_string($mysql_connect, $_POST['sparesection3']);
                $sparesection4 = mysqli_real_escape_string($mysql_connect, $_POST['sparesection4']);
                $Prefex = mysqli_real_escape_string($mysql_connect, $_POST['prefex']);
                $Title = mysqli_real_escape_string($mysql_connect, $_POST['Title']);
                $fname = mysqli_real_escape_string($mysql_connect, $_POST['fname']);
                $lname = mysqli_real_escape_string($mysql_connect, $_POST['lname']);
                $email = mysqli_real_escape_string($mysql_connect, $_POST['email']);
                $uname = mysqli_real_escape_string($mysql_connect, $_POST['uname']);
                $usersparesection1 = mysqli_real_escape_string($mysql_connect, $_POST['usersparesection1']);
                $usersparesection2 = mysqli_real_escape_string($mysql_connect, $_POST['usersparesection2']);
                $usersparesection3 = mysqli_real_escape_string($mysql_connect, $_POST['usersparesection3']);
                $user_type = mysqli_real_escape_string($mysql_connect, $_POST['user_type']);
                $Ratingagentur1 = mysqli_real_escape_string($mysql_connect, $_POST['Ratingagentur1']);
                $Ratingagentur2 = mysqli_real_escape_string($mysql_connect, $_POST['Ratingagentur2']);
                $ratesRating1 = mysqli_real_escape_string($mysql_connect, $_POST['ratesRating1']);
                $ratesRating2 = mysqli_real_escape_string($mysql_connect, $_POST['ratesRating2']);
                $Einlagen = mysqli_real_escape_string($mysql_connect, $_POST['Einlagen']);
                $access_given_clientgroup = mysqli_real_escape_string($mysql_connect, $_POST['access_given_clientgroup']);
                $clientgroup = mysqli_real_escape_string($mysql_connect, $_POST['clientgroup']);
                $client_sub_group = mysqli_real_escape_string($mysql_connect, $_POST['client_sub_group']);

                $update = "update tbl_users set `company_name` = '" . $company_name . "',`street` = '" . $street . "',`zip_code` = '" . $zip_code . "',`city` = '" . $city . "' ,`owner_account` = '" . $owner_account . "',`bank` = '" . $bank . "',`iban_number` = '" . $iban_number . "',`biccode` = '" . $biccode . "',`LEI_Nummber` = '" . $sparesection1 . "',`commission` = '" . $sparesection2 . "',`sparesection3` = '" . $sparesection3 . "',`sparesection4` = '" . $sparesection4 . "',`Prefex` = '" . $Prefex . "',`Title` = '" . $Title . "',`fname` = '" . $fname . "',`lname` = '" . $lname . "',`email` = '" . $email . "',`uname` = '" . $uname . "',`usersparesection1` = '" . $usersparesection1 . "',`usersparesection2` = '" . $usersparesection2 . "',`usersparesection3` = '" . $usersparesection3 . "',`user_type` = '" . $userType . "',`Ratingagentur1` =  '" . $Ratingagentur1 . "',`Ratingagentur2` =  '" . $Ratingagentur2 . "',`ratesRatinga1` =  '" . $ratesRating1 . "',`ratesRatinga2` =  '" . $ratesRating2 . "',`Einlagen` =  '" . $Einlagensicherung . "',`access_given_clientgroup` = '" . $accessClientGroups . "',`clientgroup` = '" . $ClientGroups . "' ,`client_sub_group` = '" . $client_sub_group . "',`viewtype` = '" . $viewType . "'  where id = " . $id . "";
// echo $update;
// exit();

               // echo "update tbl_users set `company_name` = '" .$_POST['company_name'] . "',`street` = '".mysqli_real_escape_string($_POST['street'])."',`zip_code` = '".mysqli_real_escape_string($_POST['zip_code'])."',`city` = '" . mysqli_real_escape_string($_POST['cityName']) . "' ,`owner_account` = '".mysqli_real_escape_string($_POST['owner_account'])."',`bank` = '".mysqli_real_escape_string($_POST['bank'])."',`iban_number` = '".mysqli_real_escape_string($_POST['iban_number'])."',`biccode` = '".mysql_real_escape_string($_POST['biccode'])."',`sparesection1` = '".mysqli_real_escape_string($_POST['sparesection1'])."',`sparesection2` = '".mysqli_real_escape_string($_POST['sparesection2'])."',`sparesection3` = '".mysqli_real_escape_string($_POST['sparesection3'])."',`sparesection4` = '".mysqli_real_escape_string($_POST['sparesection4'])."',`Prefex` = '".mysqli_real_escape_string($_POST['prefex'])."',`Title` = '".mysqli_real_escape_string($_POST['Title'])."',`fname` = '" . mysqli_real_escape_string($_POST['fname']) . "',`lname` = '" . mysqli_real_escape_string($_POST['lname']) . "',`email` = '".mysqli_real_escape_string($_POST['email'])."',`uname` = '".mysqli_real_escape_string($_POST['uname'])."',`usersparesection1` = '".mysqli_real_escape_string($_POST['usersparesection1'])."',`usersparesection2` = '".mysqli_real_escape_string($_POST['usersparesection2'])."',`usersparesection3` = '".mysqli_real_escape_string($_POST['usersparesection3'])."',`user_type` = '".mysqli_real_escape_string($userType)."',`Ratingagentur1` =  '".mysqli_real_escape_string($_POST['Ratingagentur1'])."',`Ratingagentur2` =  '".mysqli_real_escape_string($_POST['Ratingagentur2'])."',`ratesRatinga1` =  '".mysqli_real_escape_string($_POST['ratesRating1'])."',`ratesRatinga2` =  '".mysqli_real_escape_string($_POST['ratesRating2'])."',`Einlagen` =  '".mysqli_real_escape_string($_POST['Einlagensicherung'])."',`access_given_clientgroup` = '".mysqli_real_escape_string($accessClientGroups)."',`clientgroup` = '".mysqli_real_escape_string($ClientGroups)."' ,`client_sub_group` = '".mysqli_real_escape_string($_POST['client_sub_group'])."' where id = " . $id . "";
               // exit();
                $mysql = mysqli_query($mysql_connect, $update);
                $msg = "updated successfully";

            }
            ?>
            <?php

            $select_query = mysqli_query($mysql_connect, "select * FROM tbl_users WHERE id='$id'");
            $select_data = mysqli_fetch_array($select_query);
            $accessclientgroup = explode(",", $select_data['access_given_clientgroup']);
            $clientgroup = explode(",", $select_data['clientgroup']);
            $userType = explode(",", $select_data['user_type']);
            $Einlagen_query = mysqli_query($mysql_connect, "select title FROM tbl_Einlagensicherung");
            $Ratingagentur_query = mysqli_query($mysql_connect, "select title FROM tbl_Ratingagentur");
            $Ratingagentur_query2 = mysqli_query($mysql_connect, "select title FROM tbl_Ratingagentur");
            $clientsubgroupquery = mysqli_query($mysql_connect, "select category FROM tbl_category WHERE active = 'Y'");
            ?>
            <style>

                .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                    padding: 5px 18px;
                    vertical-align: top;
                }

            </style>
            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="sec-box">
                              <span id="add"><a href="user_detail.php" class="btn btn-primary style2" style="float: right;">Back to list</a></span>
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Update</h2>

                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="col-md-4">Description</th>
                                                    <th class="col-md-8">Form Elements</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <form id="updateUserData" name="update_user" method="post">
<?php
if ($msg != '') {
    echo "<div class='alert alert-success'>" . $msg . "</div>";
}
?>
                                                
                                                <tr>
                                                    <td class="col-md-4"><?php if ($select_data['category'] != "1") { ?>Name Unternehmen<?php 
                                                                                                                                    } else { ?>Bank Name <?php 
                                                                                                                                                                } ?></td>
                                                    <td class="col-md-8"><input type="text" placeholder="" name="company_name" value="<?php echo $select_data['company_name']; ?>" class="form-control" ></td>
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Straße</td>
                                                    <td class="col-md-8"><input type="text" placeholder="street" name='street' value="<?php echo $select_data['street'];; ?>" class="form-control" ></td>
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Postleitzahl</td>
                                                    <td class="col-md-8"><input type="text" placeholder="ZIP" name='zip_code' value="<?php echo $select_data['zip_code'];; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Ort</td>
                                                    <td class="col-md-8"><input type="text" placeholder="City" name="cityName" value="<?php echo $select_data['city']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Kontoinhaber</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Owner of Account" name="owner_account" value="<?php echo $select_data['owner_account']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Bank</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Bank" name="bank" value="<?php echo $select_data['bank']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">IBAN Number</td>
                                                    <td class="col-md-8"><input type="text" placeholder="IBAN" name="iban_number" value="<?php echo $select_data['iban_number']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">BIC Code</td>
                                                    <td class="col-md-8"><input type="text" placeholder="biccode" name="biccode" value="<?php echo $select_data['biccode']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">LEI Nummber</td>
                                                    <td class="col-md-8"><input type="text" placeholder="LEI Nummber" name="sparesection1" value="<?php echo $select_data['LEI_Nummber']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr >
                                                    <td class="col-md-4">Commission</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Commission" name="sparesection2" value="<?php echo $select_data['commission']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td class="col-md-4">Weiteres Feld 3</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Spare section " name="sparesection3" value="<?php echo $select_data['sparesection3']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td class="col-md-4">Weiteres Feld 4</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Spare section " name="sparesection4" value="<?php echo $select_data['sparesection4']; ?>" class="form-control" ></td>
                                                </tr>


                                                <tr>
                                                    <td class="col-md-4">Anrede</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Anrede" name="prefex" value="<?php echo $select_data['Prefex']; ?>" class="form-control" ></td>
                                                </tr>

                                                <tr>
                                                    <td class="col-md-4">Titel</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Title" name="Title" value="<?php echo $select_data['Title']; ?>" class="form-control" ></td>
                                                </tr>                                                <tr>
                                                    <td class="col-md-4">Vorname</td>
                                                    <td class="col-md-8"><input type="text"  placeholder="" name="fname" value="<?php echo $select_data['fname']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Nachname</td>
                                                    <td class="col-md-8"><input type="text" placeholder="lname" name='lname' value="<?php echo $select_data['lname']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Mail-Adresse</td>
                                                    <td class="col-md-8"><input type="text" placeholder="email" name='email' value="<?php echo $select_data['email']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Benutzername (nach eigener Wahl) </td>
                                                    <td class="col-md-8"><input type="text" placeholder="uname" name='uname' value="<?php echo $select_data['uname']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td class="col-md-4">Weiteres Feld 1</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Spare section " name="usersparesection1" value="<?php echo $select_data['usersparesection1']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td class="col-md-4">Weiteres Feld 2</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Spare section " name="usersparesection2" value="<?php echo $select_data['usersparesection2']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td class="col-md-4">Weiteres Feld 3</td>
                                                    <td class="col-md-8"><input type="text" placeholder="Spare section " name="usersparesection3" value="<?php echo $select_data['usersparesection3']; ?>" class="form-control" ></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Benutzertyp Schuldscheine </td>
                                                    <td class="col-md-8"><input type="checkbox" <?php if ($select_data['user_type'] == "borrower" || $select_data['user_type'] == "both") {
                                                                                                    echo "checked";
                                                                                                } ?> name="user_type[]" value="borrower" > &nbsp Darlehensnehmer <br>
                                                    <input type="checkbox" <?php if ($select_data['user_type'] == "lender" || $select_data['user_type'] == "both") {
                                                                                echo "checked";
                                                                            } ?> name="user_type[]" value="lender" >    &nbsp Darlehensgeber
                                                    </td>
                                                    
                                                </tr>

                                                <?php if ($select_data['user_type'] == "borrower" || $select_data['user_type'] == "both") { ?>
                                                <tr>
                                                    <td class="col-md-4">Ratingagentur1</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control" name="Ratingagentur1">
                                                            <option value="">--Select Ratingagentur--</option>
                                                            <?php 
                                                            while ($rows = mysqli_fetch_assoc($Ratingagentur_query)) { ?>
                                                                    <option <?php if ($rows['title'] == $select_data['Ratingagentur1']) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $rows['title']; ?></option>
                                                                <?php 
                                                            }
                                                            ?>
                                                        </select>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Rates Rating1</td>
                                                    <td class="col-md-8"><input type="text" placeholder="ratesRating1" name="ratesRating1" value="<?php echo $select_data['ratesRatinga1']; ?>" class="form-control" ></td>
                                                </tr>

                                                <tr>
                                                    <td class="col-md-4">Ratingagentur2</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control" name="Ratingagentur2">
                                                            <option value="">--Select Ratingagentur--</option>
                                                            <?php 
                                                            while ($rows = mysqli_fetch_assoc($Ratingagentur_query2)) { ?>
                                                                    <option <?php if ($rows['title'] == $select_data['Ratingagentur2']) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $rows['title']; ?></option>
                                                                <?php 
                                                            }
                                                            ?>
                                                        </select>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Rates Rating2</td>
                                                    <td class="col-md-8"><input type="text" placeholder="ratesRating2" name="ratesRating2" value="<?php echo $select_data['ratesRatinga2']; ?>" class="form-control" ></td>
                                                </tr>

                                               <tr>
                                                    <td class="col-md-4">Einlagensicherung</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control" name="Einlagensicherung">
                                                            <option value="">--Select Einlagensicherung--</option>
                                                            <?php 
                                                            while ($rows = mysqli_fetch_assoc($Einlagen_query)) { ?>
                                                                <option <?php if ($rows['title'] == $select_data['Einlagen']) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $rows['title']; ?></option>
                                                                <?php 
                                                            }
                                                            ?>
                                                        </select>
                                                        </td>
                                                    </tr>
                                                  
                                                <tr>
                                                    <td class="col-md-4">ACCESS given to Clientgroup:</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control" name="access_given_clientgroup[]" multiple="multiple">
                                                            <option value=""></option>
                                                        <option value="Unternehmen GmbH" <?php if (isset($select_data['access_given_clientgroup']) && in_array("Unternehmen GmbH", $accessclientgroup)) {
                                                                                            echo "selected";
                                                                                        } ?>>Kommunale Unternehmen (GmbH)</option>
                                                        <option value="Unternehmen AöR KdöR" <?php if (isset($select_data['access_given_clientgroup']) && in_array("Unternehmen AöR KdöR", $accessclientgroup)) {
                                                                                                echo "selected";
                                                                                            } ?>>Kommunale Unternehmen (KdöR - AöR)</option>   
                                                        <option value="Kommunen" <?php if (isset($select_data['access_given_clientgroup']) && in_array("Kommunen", $accessclientgroup)) {
                                                                                    echo "selected";
                                                                                } ?>>Kommunen</option>
                                                    </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                } ?>
                                                    <td class="col-md-4">Client group</td>
                                                    <td class="col-md-8">
                                                       <!--  <input type="text" class="form-control"  name="clientgroup"> -->

                                                        <select class="form-control" name="client_group[]">
                                                            <option value="">--Select Client Group--</option>
                                                            <option value="Bank" <?php if (isset($select_data['clientgroup']) && in_array("Bank", $clientgroup)) {
                                                                                    echo "selected";
                                                                                } ?>>Bank</option>
                                                        <option value="Unternehmen GmbH" <?php if (isset($select_data['clientgroup']) && in_array("Unternehmen GmbH", $clientgroup)) {
                                                                                            echo "selected";
                                                                                        } ?>>Kommunale Unternehmen (GmbH)</option>
                                                        <option value="Unternehmen AöR KdöR" <?php if (isset($select_data['clientgroup']) && in_array("Unternehmen AöR KdöR", $clientgroup)) {
                                                                                                echo "selected";
                                                                                            } ?>>Kommunale Unternehmen (KdöR - AöR)</option>   
                                                        <option value="Kommunen" <?php if (isset($select_data['clientgroup']) && in_array("Kommunen", $clientgroup)) {
                                                                                    echo "selected";
                                                                                } ?>>Kommunen</option>
                                                    </select>

                                                    </td>
                                                    
                                                </tr>  
                                                <tr>
                                                    <td class="col-md-4">Client Sub Group</td>
                                                    <td class="col-md-8">
                                                        <select class="form-control" name="client_sub_group">
                                                        <option value="">--Select Client Sub Group--</option>
                                                            <?php 
                                                            while ($rows = mysqli_fetch_assoc($clientsubgroupquery)) { ?>
                                                                    <option <?php if ($rows['category'] == $select_data['client_sub_group']) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $rows['category']; ?></option>
                                                                <?php 
                                                            }
                                                            ?>
                                                        </select>
                                                        </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-md-4">Ich akzeptiere die AGB’s</td>
                                                    <td class="col-md-8"><input type="checkbox" disabled="disabled" <?php if ($select_data['termsconditions'] == 'Y') {
                                                                                                                        echo "checked";
                                                                                                                    } ?> >
                                                    
                                                    </td>
                                                    
                                                </tr>
                                                <?php if ($select_data['user_type'] == "borrower" || $select_data['user_type'] == "both") { ?>
                                                <tr>
                                                    <td class="col-md-4">Ich stimme den Datenschutzbestimungen zu</td>
                                                    <td class="col-md-8"> <input type="checkbox" disabled="disabled" <?php if ($select_data['PrivacyPolicy'] == 'Y') {
                                                                                                                        echo "checked";
                                                                                                                    } ?> >
                                                    
                                                    </td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">Ich stimme zu, dass Ratings zu unserem Unternhemen veröffentlicht werden dürfen </td>
                                                    <td class="col-md-8"><input type="checkbox" disabled="disabled" <?php if ($select_data['ratings'] == 'Y') {
                                                                                                                        echo "checked";
                                                                                                                    } ?> >
                                                    
                                                    </td>
                                                    
                                                </tr>
                                                 <tr>
                                                    <td class="col-md-4">dass Informationen zu unserem Unternehmen auf der Plattform veröffentlicht werden dürfen</td>
                                                    <td class="col-md-8"><input type="checkbox" disabled="disabled" <?php if ($select_data['information'] == 'Y') {
                                                                                                                        echo "checked";
                                                                                                                    } ?> >
                                                    
                                                    </td>
                                                    
                                                </tr>
                                                <?php 
                                            } ?>
                                                     <tr>
                                                     <td class="col-md-1"><input type="submit" placeholder="" name="update" value="Update" class="btn btn-primary style2"></td>
                                                    
                                                </tr>
                                            </form>
                                            

                                            </tbody>
                                        </table>
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