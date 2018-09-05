<style>
    nav.navigation {
        background: #323641 none repeat scroll 0 0;
    }
    .custom-nav {
        background: #323641 none repeat scroll 0 0;
    }
    .shadows {
        height: 0 !important;
    }
    .navi-acc li a::before {

	display: none;
}
.navi-acc a {

	padding: 17px 21px 20px 15px;

}
</style>
<aside class="sidebar">
    <div class="sidebar-in">
        <!-- Sidebar Header Start -->
        <header>
            <!-- Logo Start -->
            <div class="logo">
                <a href="dashboard.php"><img src="assets/images/logo.png" alt="Logo" style="width:180px;"/></a>
            </div>
            <!-- Logo End -->
            <!-- Toggle Button Start -->
            <a href="#" class="togglemenu">&nbsp;</a>
            <!-- Toggle Button End -->
            <div class="clearfix"></div>
        </header>
        <!-- Sidebar Header End -->
        <!-- Sidebar Navigation Start -->
        <nav class="navigation">
            <ul class="<?php echo (isset($showCustomNav)) ? 'custom-nav' : 'navi-acc'; ?>" id="nav2">
                <li>
                    <a href="dashboard.php" class="dashboard"><img src="assets/images/dashboard.png"> Dashboard</a>

                </li>

                <li>
                    <a href="user_detail.php" class="ui-elements"> <img src="assets/images/users.png"> Users</a>
                    </li>
                    <li>
                    <a href="only_view_users.php" class="ui-elements"> <img src="assets/images/users.png"> View only Users</a>
                    </li>

                <li>
                 <a href="all_deals.php" class="ui-elements"><img src="assets/images/complete_deal.png"> Completed Deals</a>
                 <!-- </li>
                               <li>
                    <a href="reset_password.php" class="ui-elements"><img src="assets/images/reset_user_password.png"> Reset User Password </a>
                </li> -->

                <!-- <li>
                    <a href="sendEmails.php" class="ui-elements"><img src="assets/images/send_emails.png"> SEND E-MAIL TO USERS</a>
                </li>
                <li>
                    <a href="emailsHistory.php" class="ui-elements"><img src="assets/images/send_emails_history.png"> HISTORY USER E-MAIL</a>
                </li>
                <li>
                    <a href="KontaktesendEmails.php" class="ui-elements"><img src="assets/images/send_emails.png">
                    SEND E-MAIL TO KONTAKTE</a>
                </li>
                <li>
                    <a href="KontakteemailsHistory.php" class="ui-elements"><img src="assets/images/send_emails_history.png"> HISTORY KONTAKTE E-MAIL</a>
                </li> -->
                <li>
                 <a href="sent_kontakte_mail.php" class="ui-elements"><img src="assets/images/send_emails.png"> Sent Kontakte Mail</a>
                </li>
                <li>
                  <a href="sent_password_mail.php" class="ui-elements"><img src="assets/images/send_emails.png"> PASSWORD MAILS FOR KONTAKTE</a>
                </li>
                <li>
                  <a href="sent_asking_onboard_mail.php" class="ui-elements"><img src="assets/images/send_emails.png"> EXTERNAL ONBOARDING MAILS</a>
                </li>
                <li>
                  <a href="sent_confirmation_mail.php" class="ui-elements"><img src="assets/images/send_emails.png"> Sent Confirmations Mail</a>
                </li>
                <li>
                  <a href="deleted_mails.php" class="ui-elements"><img src="assets/images/send_emails.png"> Deleted Emails</a>
                </li>
                
                <li>
                    <a href="live_user_status.php" class="ui-elements"><img src="assets/images/user_status.png"> LIVE USER STATUS</a>
                </li>
                <li>
                    <a href="view_user_status.php" class="ui-elements"><img src="assets/images/user_status.png"> VIEW ONLY USER STATUS</a>
                </li>
        <li>
        <a href="livedeleteduser.php" class="ui-elements"><img src="assets/images/deleted_user.png"> LIVE DELETED USERS</a>
        </li>
        <li>
        <a href="viewdeletedUsers.php" class="ui-elements"><img src="assets/images/deleted_user.png"> VIEW ONLY DELETED USERS</a>
        </li>

        <li>
            <a href="client_sub_group.php" class="ui-elements"><img src="assets/images/chat_with_user.png"> CLIENT SUB GROUPS </a>
        </li>
                <li>
            <a href="customers.php" class="ui-elements"><img src="assets/images/chat_with_user.png"> Kontakte </a>
        </li>


            </ul>
            <div class="clearfix"></div>
        </nav>
        <!-- Sidebar Navigation End -->
        <!-- Shadow Start -->
        <span class="shadows"></span>
        <!-- Shadow End -->
    </div>
</aside>