<?php include_once 'header.php'; ?>
<script src="ckeditor/ckeditor.js"></script>
<style>
    .chatUl {
        float: left;
        list-style: outside none none;
        margin: 0;
        min-height: 100px;
        padding: 0;
        width: 100%;
    }
    .chatUl li {
        float: left;
        width: 100%;
    }
    .chatUl {
        max-height: 488px;
        overflow-x: auto;
    }
    .chatUl li {
        cursor: default;
    }
    .chatUl li div {
        word-wrap: break-word;
        max-width: 500px;
    }
</style>
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
            if (isset($_POST['submit'])) {
                if (!empty($_POST['userId']) && !empty($_POST['chatMessage'])) {
                    $userId = $_POST['userId'];
                    $chatMessage = $_POST['chatMessage'];

                    mysql_query("INSERT INTO `tbl_messages` (`from`, `to`, `msg`, `time_stamp`, `readed`) VALUES ('1', '$userId', '$chatMessage', '" . date("Y-m-d h:i:s") . "', `N`);");
                    echo'<div class="alert alert-success">Message sent successfully.</div>';
                } else {
                    echo'<div class="alert alert-danger">Some error occur please try again.</div>';
                }
            }
            ?>

            <!-- Content Section Start -->
            <div class="content-section">

                <div class="container-liquid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Chat with user</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <div class="table-box">
                                        <!--<form name="chatWithUserForm" action="" method="post" id="add_interest">-->
                                        <table class="table">
                                            <tbody>
                                                <!--<div class="alert alert-success"></div>-->
                                                <tr>
                                                    <td class="col-md-4">Select User</td>
                                                    <td class="col-md-8">
                                                        <select id="userId" name="userId" class="form-control" >
                                                            <option value="0">Please select user</option>
                                                            <?php
                                                            $users = mysql_query("SELECT id, email, concat((fname), (' '), (lname)) as name , user_type , company_name FROM `tbl_users` where status = 'Y' and tbl_users.is_archieve = 'n' and user_type not like 'admin' order by user_type desc");
                                                            if (mysql_num_rows($users) > 0) {
                                                                while ($user = mysql_fetch_assoc($users)) {																																		 $fullName = $string = $user['name'];																		$string = urlencode($string);       /* used for special chractrs  */																		$string = str_replace('%DF','ß',$string);																		$string = str_replace('%E4','ä',$string);																		$string = str_replace('%F6','ö',$string);																		$string = str_replace('%2B','+',$string);																		$string = str_replace('%FC','ü',$string);																		$string = str_replace('%26','&',$string);																		$string = str_replace('%2F','/',$string);																		$string = str_replace('%0A','',$string);																		$string = str_replace('%0D','',$string);																		$string = str_replace('%40','@',$string);																		$string = str_replace('%2C',',',$string);																		$string = str_replace('%E1','á',$string);																		$string = str_replace('%D3','ó',$string);																		$string = str_replace('+',' ',$string);
                                                                    echo '<option value="' . $user['id'] . '">' . $string . ' - ', ucfirst($user['user_type']), ' ('.$user['company_name'].')</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <span name="chatWithUserForm_userId_errorloc" class="errorstring"></span>
                                                    </td>
                                                </tr>
<!--                                                    <tr>
                                                    <td class="col-md-4">Message</td>
                                                    <td class="col-md-8">
                                                        <textarea id="chatMessage" class="form-control ckeditor-" name="chatMessage"></textarea>
                                                        <span name="chatWithUserForm_chatMessage_errorloc" class="errorstring"></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td class="col-md-1"  >
                                                        <input type="submit" placeholder="" name="submit" value="Send" class="btn btn-primary style2">
                                                    </td>
                                                </tr>-->
                                            </tbody>
                                        </table>
                                        <!--</form>-->
<!--                                        <script  type="text/javascript">
                                            var frmvalidator = new Validator("chatWithUserForm");
                                            frmvalidator.addValidation("userId","req","Please select user");
                                            frmvalidator.addValidation("chatMessage","req","Please enter message");
                                        </script>-->
                                    </div>
                                </div>
                                <!-- Content Section End -->
                            </div>
                            <!-- Right Section End -->
                        </div>
                    </div>
                </div>
                <div class="container-liquid chatContainer" style="display: none;">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="sec-box">
                                <a class="closethis">Close</a>
                                <header>
                                    <h2 class="heading">Chat</h2>
                                </header>
                                <div class="contents">
                                    <a class="togglethis">Toggle</a>
                                    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
                                    <div class="table-box">
                                        <ul class="chatUl"></ul>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12-">
                                            <br>
                                            <input id="selectedUserId" type="hidden" value="">
                                            <div class="col-md-11">
                                                <input id="messageForUser" type="text" class="form-control" placeholder="Type message here" value="">
                                            </div>
                                            <div class="col-md-1">
                                                <input onclick="javascript:sendChatMessage();" type="button" class="pull-right btn btn-defaul hideMyDiv" value="Send">
                                            </div>
                                            <div class="clearfix"></div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<script>
var intervalObj;
$(document).ready(function(){
    $('.chatUl').animate({scrollTop : (($('.chatUl li').length * 20) + 1200) },800);
    $('#userId').change(function(){
        if($(this).val() != 0) {
            getAllChatMessages($(this).val());
            $('.chatContainer').show();
            $('.chatUl').animate({scrollTop : (($('.chatUl li').length * 20) + 1200) },800);
        }
        else {
            $('.chatContainer').hide();
        }
    });
    $("#messageForUser").keypress(function(e){
        if(e.keyCode == 13) {
            sendChatMessage();
        }
    });
    intervalObj = setInterval(function(){
                            if($("#selectedUserId").val() != '') {
                                $('.chatUl').animate({scrollTop : (($('.chatUl li').length * 20) + 1200) },800);
                            }
                        }, 2000);
    setInterval(function(){
        if($("#selectedUserId").val() != '') {
            getAllChatMessages($("#selectedUserId").val());
        }
    }, 2000);
    $(".chatUl").scroll(function() {
        clearTimeout(intervalObj);
        console.log("Here!");
    });
});
function sendChatMessage() {
    var data_to_send = 'messageForUser=' + $("#messageForUser").val() + '&userId=' + $("#selectedUserId").val() +'&function=sendChatMessage';
    $.ajax({
        url: "ajax_function.php",
        method: "post",
        data: data_to_send,
        cache: false,
        success: function(result) {
            $("#messageForUser").val('');
            getAllChatMessages($("#selectedUserId").val());
            $('.chatUl').animate({scrollTop : (($('.chatUl li').length * 20) + 1200) },800);
        }
    });
}
function getAllChatMessages(userId) {
    var data_to_send = 'userId=' + userId +'&function=getAdminChatWithUser';
    $.ajax({
        url: "ajax_function.php",
        method: "post",
        data: data_to_send,
        cache: false,
        success: function(result) {
            $("#selectedUserId").val($('#userId').val());
            $('.chatUl').html(result);
        }
    });
}
</script>
    <!-- Wrapper End -->
</body>
</html>
