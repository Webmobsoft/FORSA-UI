<script>
    function changeLanguage(language){
        $.ajax({
            url: "<?php echo base_url(); ?>login/changeLanguage/" + language,
            method: "post",
            cache: false,
            success: function () {
                location.reload(true);
            }
        });
    }
    function update_user_detail() {
        $(".update_detail_error").text("");
        $(".update_detail_success").show().text("");
        var data_to_send = $("#UpdateregisterForm").serialize();
        alert(data_to_send);
        return false;
        $.ajax({
            url: "<?php echo base_url() . "register/update_user_detail" ?>",
            method: "post",
            data: data_to_send,
            cache: false,
            success: function (result) {
                $(".update_detail_success").show().text("<?php echo $this->lang->line('text_youHaveUpdatedSuccessfully'); ?>");
                window.location.href = window.location.href;
            }
        });
    }
    function checkOldPwd()
    {
      
        var password = $("#password").val();
        $("#change_password_pwd_errorloc").text("");
        if (password != '')
        {
            var data_to_send = 'password=' + password;
            $.ajax({
                url: "<?php echo base_url() . "register/checkOldPwd" ?>",
                method: "post",
                data: data_to_send,
                cache: false,
                success: function (result)
                {
                    alert(result);
                    return false;
                    if (result == '1') {
                        $(".password_error").text("");
                        $("#btn_update").prop('disabled', false);
                    }
                    else {
                        $(".password_error").text("<?php echo $this->lang->line('text_passwordDoesNotMatch'); ?>");
                    }
                }

            });
        }
    }
</script>