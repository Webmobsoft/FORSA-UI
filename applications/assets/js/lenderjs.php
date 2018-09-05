<script type="text/javascript">
  var temp = "";
  function BanksInterest()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/LatestBanksInterest",
      method:"post",
      cache:false,
      success:function(htnlstr){
        if(temp != htnlstr){
          $("#interestdata").html(htnlstr);
          $(".interest").click(function(){
            var value = $(this).attr("data-value");
            if($(".interest").hasClass("active")){
              $(".interest").removeClass("active");
              $('*[data-value="'+value+'"]').addClass("active");
            }
            else{
              $('*[data-value="'+value+'"]').addClass("active");
            }
            term = 'term='+value;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/lendersBank",
              method:"post",
              data:term,
              cache:false,
              success:function(htnlstr){
                if($.trim(htnlstr) == ''){
                  $("#lendersBank").html('No records found.');
                }
                else{
                }
              }
            }
                  );
          }
                              );
          temp = htnlstr;
        }
      }
    }
          );
  }
  var temp3 = "";
  function LenderNotification()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/LenderNotification",
      method:"post",
      cache:false,
      success:function(htnlstr){
        if(htnlstr != 'false' && temp3 != htnlstr){
          $("#requestmessage1").html("");
          $('#lendrequestmodal').modal("hide");
          $('#notificationModal').modal({
            keyboard: false,show: true}
                                       );
          $('#notificationmodaldialog').draggable({
            handle: "#notificationmodalheader"}
                                                 );
          $("#notificationModal").modal("show");
          $("#notificationbody").html(htnlstr);
          $(".requestresponse").click(function(){
            var NotificationId = $(this).attr("data-id");
            var Notificationresponse = $(this).attr("data-value");
            var bankName = $(this).attr("data-bank-name");
            if(Notificationresponse == 'accept'){
              Notificationid = 'NotificationId='+NotificationId
              $.ajax({
                url:"<?php echo base_url(); ?>instimatch/EmailAcceptResponse",
                method:"post",
                data:Notificationid,
                cache:false,
                success:function(htnlstr){
                  // alert(htnlstr);
                  // return false;
                  $("#requestmessage1").html("DEAL IS ACCEPTED. PLEASE CHECK YOUR E-MAIL FOR CONFIRMATION.");
                  $("#closing").prop("disabled",false);
                  $("#request-accept").prop("disabled",true);
                  $("#request-decline").prop("disabled",true);
                  $("#chat-with-forsa").prop("disabled",true);
                }
              }
                    );
            }
            else if(Notificationresponse == 'decline')
            {
              NotificationIds = 'NotificationId='+NotificationId+'&Notificationresponse='+Notificationresponse;
              $.ajax({
                url:"<?php echo base_url(); ?>instimatch/updateNotificationResponse",
                method:"post",
                data:NotificationIds,
                cache:false,
                success:function(htnlstr){
                  // alert(htnlstr);
                  // return false;
                  $("#requestmessage1").html("REQUEST HAS BEEN DECLINED.");
                  $("#closing").prop("disabled",false);
                  $("#request-accept").prop("disabled",true);
                  $("#request-decline").prop("disabled",true);
                  $("#chat-with-forsa").prop("disabled",true);
                }
              }
                    );
            }
            else if(Notificationresponse == 'close')
            {
              NotificationIds = 'NotificationId='+NotificationId+'&Notificationresponse='+Notificationresponse;
              $.ajax({
                url:"<?php echo base_url(); ?>instimatch/updateNotificationClose",
                method:"post",
                data:NotificationIds,
                cache:false,
                success:function(htnlstr){
                  $("#notificationModal").modal("hide");
                  $("#closing").prop("disabled",false);
                }
              }
                    );
            }
            else
            {
              var tempering = "";
              $.ajax({
                url:"<?php echo base_url(); ?>instimatch/ChatWithForsa",
                method:"post",
                cache:false,
                success:function(htnls)
                {
                  if(htnls != tempering && htnls != 'false' ){
                    $('#ChatForsaModal').modal({
                      keyboard: false,show: true}
                                              );
                    $('#chatforsamodaldialog').draggable({
                      handle: "#chatforsamodalheader"}
                                                        );
                    $("#ChatForsaModal").modal("show");
                    $("#chatforsabody").html(htnls);
                    $("#request-send").click(function()
                                             {
                      var NotificationId = $(this).attr("data-id");
                      var chat_description = $("#chat_description").val();
                      var RequestData = 'NotificationId='+NotificationId+'&chatdescription='+chat_description;
                      $.ajax({
                        url:"<?php echo base_url(); ?>instimatch/UpdateChatDescription",
                        method:"post",
                        data:RequestData,
                        cache:false,
                        success:function(result)
                        {
                          $("#contactchatforsa").html("YOU WILL BE CONTACTED BY FORSA");
                          $("#notificationModal").modal("hide");
                          $("#request-send").prop("disabled",true);
                        }
                      }
                            );
                    }
                                            );
                  }
                  var tempering = htnls;
                }
              }
                    );
            }
          }
                                     );
        }
        var temp3 = htnlstr;
      }
    }
          );
  }
  function parseDate(str) {
    var mdy = str.split('/');
    return new Date(mdy[2],mdy[1]-1,mdy[0]);
  }
  function datediff(first, second) {
    return Math.round((second-first)/(1000*60*60*24));
  }
  var temp1 = "";
  function lendersBanks(){
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/lendersLatestBanks",
      method:"post",
      cache:false,
      success:function(htnlstr){
        if(temp1 != htnlstr){
          $("#lenderslatestBanks").html(htnlstr);
          $(".lendrequest").click(function(){
            var bankIds = $(this).attr("data-id");
            $("#lendrequestmodal").modal("show");
            $("#requestmessage").html("");
            bankId = 'bankId='+bankIds;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/lenderRequestSend",
              method:"post",
              data:bankId,
              cache:false,
              success:function(htnlstr){
                $('#lendrequestmodal').modal({
                  keyboard: false,show: true}
                                            );
                $('#lendermodaldialog').draggable({
                  handle: "#lendermodalheadr"}
                                                 );
                $("#lendrequestbody").html(htnlstr);
                $("#datepicker1").datepicker({
                  dateFormat:'dd/mm/yy',
                  minDate: 0,
                  onSelect: function(dateText, inst) {
                    var end_date = $(this).val();
                    var start_date = $("#datepicker").val();
                    var dateDifference = datediff(parseDate(start_date), parseDate(end_date));
                    //alert(dateDifference);
                    $(".numberDays").html(dateDifference);
                  }
                }
                                            );
                $("#datepicker").datepicker({
                  dateFormat:'dd/mm/yy',
                  minDate: 0,
                  onSelect: function(dateText, inst) {
                    var start_date = $(this).val();
                    var end_date = $("#datepicker1").val();
                    var dateDifference = datediff(parseDate(start_date), parseDate(end_date));
                    //alert(dateDifference);
                    $(".numberDays").html(dateDifference);
                  }
                }
                                           );
                $('.requestamount').on('blur', function() {
                  var number1 = $(this).val();
                  var number = parseFloat(number1).toFixed(2);
                  var withCommas = Number(number).toLocaleString('eu');
                  var amount = withCommas.replace(/,/g, ".");
                  if(amount.indexOf('.') !== -1)
                  {
                    $(this).val(amount);
                  }
                  else{
                    $(this).val(number1);
                  }
                }
                                      );
                $("#sendRequest").click(function(){
                  var lender_id = "<?php echo $_SESSION['user_id'];?>";
                  var amount = $(".requestamount").val();
                  var start_date = $("#datepicker").val();
                  var end_date = $("#datepicker1").val();
                  var no_of_days = $(".numberDays").html();
                  var payments = $("#payments").val();
                  var interest = $("#interest").val();
                  if(lender_id == "" || amount == "" || start_date == "" || end_date == "" || no_of_days == "" || payments == "" || interest == ""){
                    alert("Please Enter All Feilds");
                  }else{
                  var data_to_send = 'lenderId='+lender_id+'&amount='+amount+'&start_date='+start_date+'&end_date='+end_date+'&no_of_days='+no_of_days+'&payments='+payments+'&borrowerId='+bankIds+'&interest='+interest;
                  $.ajax({
                    url:"<?php echo base_url(); ?>instimatch/updateRequestSend",
                    method:"post",
                    data:data_to_send,
                    cache:false,
                    success:function(htnlstr){
                      $("#requestmessage").html("REQUEST SENT SUCCESFULLY. PLEASE WAIT FOR BORROWER’S RESPONSE.");
                      $("#sendRequest").prop("disabled",true);
                    }
                  });
                  } 
                });
              }
            }
                  );
          }
                                 );
        }
        temp1 = htnlstr;
      }
    }
          );
  }
  function getAdminRequestResponse()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/getAdminRequestResponse",
      method:"post",
      cache:false,
      success:function(htnlstr){
        if(htnlstr != 'false'){
          $('#adminRequestResponse').modal({
            keyboard: false,show: true}
                                          );
          $('#adminrequestdialog').draggable({
            handle: "#adminrequestheader"}
                                            );
          $("#adminRequestResponse").modal("show");
          $("#adminrequestresponsebody").html(htnlstr);
          $("#notificationModal").modal("hide");
          $(".adminacceptRequest").click(function(){
            var notificationId = $(this).attr("data-value");
            var RequestId  = 'notificationId='+notificationId;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/updateAdminAcceptResponse",
              method:"post",
              data:RequestId,
              cache:false,
              success:function(htnlstr){
                $("#adminRequestResponse").modal("hide");
                $("#notificationModal").modal("hide");
              }
            }
                  );
          }
                                        );
          $(".admindeclineRequest").click(function(){
            var notificationId = $(this).attr("data-value");
            var RequestId  = 'notificationId='+notificationId;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/updateAdminDeclineResponse",
              method:"post",
              data:RequestId,
              cache:false,
              success:function(htnlstr){
                $("#adminRequestResponse").modal("hide");
              }
            }
                  );
          }
                                         );
        }
      }
    }
          );
  }
  // ************************* COCKPIT BUTTONS **************************
  $("#cockpit").click(function(){
    $("#EINSTELLUNGEN").css("display","none");
    $("#bank_Interest").css("display","none");
  });

    // $("#settings_start_page").removeClass("activebutton");
    // $("#view_all_price").removeClass("activebutton");
    // $("#best_price_view").removeClass("activebutton");
    // $("#all_banks_price").removeClass("activebutton");
    // $("#eigene").removeClass("activebutton");
    // $("#Ansehen").removeClass("activebutton");
    // $("#maturity_table").css("display","none");
    // $("#history_maturity_table").css("display","block");
    // $("#best_price_view1").css("display","none");
    // $("#interest_table").css("display","none");
    // $("#all_interest_table").css("display","none");
    // $("#BANKENAUSWAHL").css("display","none");
    // $("#company_name").css("display","none");



    $("#eigene").click(function(){
      $("#Ansehenund1").removeClass("activebutton");
  $("#Ansehen1").removeClass("activebutton");
    $(this).addClass("activebutton");
    $(".dropbtn").addClass("activebutton");
    $(".dropbtn").text("Eigene Stammdatenverwaltung");
    $("#settings_start_page").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $("#best_price_view1").css("display","none");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#interest_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/getUserDetails",
      cache:false,
      success:function(htnlstr){
        $("#eigeneModal").modal("show");
        $("#eigeneBody").html(htnlstr);
        $("#updateuser").click(function(){
          var company_name = $("#company_name1").val();
          var street = $("#street").val();
          var zip_code = $("#zip_code").val();
          var city = $("#city").val();
          var owner_account = $("#owner_account").val();
          var bank = $("#bank").val();
          var iban_number = $("#iban_number").val();
          var biccode = $("#biccode").val();
          var Prefex = $("#Prefex").val();
          var Title = $("#Title").val();
          var fname = $("#fname").val();
          var lname = $("#lname").val();
          var email = $("#email").val();
          var uname = $("#uname").val();
          var contact_number = $("#contact_number").val();
          var clientgroup = $("#clientgroup").val();

          var userData = 'company_name='+company_name+'&street='+street+'&zip_code='+zip_code+'&city='+city+
              '&owner_account='+owner_account+'&bank='+bank+'&iban_number='+iban_number+'&biccode='+biccode+'&Prefex='+Prefex+
              '&zip_code='+zip_code+'&Title='+Title+'&fname='+fname+'&lname='+lname+'&email='+email+'&uname='+uname+'&contact_number='+contact_number+'&clientgroup='+clientgroup;
          $.ajax({
            url:"<?php echo base_url(); ?>instimatch/updateUserDetails",
            method:"post",
            data:userData,
            cache:false,
            success:function(htnlstr){
              $("#successmessage").text("User details update successfully.").css("background-color","green");
            }
          });
        });
        $("#changepassword").click(function(){
          $.ajax({
          url: "<?php echo base_url() . "register"; ?>",
          method: "post",
          cache: false,
          success: function (htmlresult) {
          $("#eigeneModal").modal("hide");
          $("#UserForm").html(htmlresult);
          $("#UserData").modal('show');
          $("#LanderUserData").show();
          }
          });
          // $("#UserData").modal('show');
          // $("#LanderUserData").show();
         // alert("dsfds");
        });
      }
    });
  });
  $("#settings_start_page").click(function(){
    $(this).addClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
  $("#Ansehen1").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $(".dropbtn").addClass("activebutton");
    $(".dropbtn").text("Einstellen Startseite");
    $("#eigene").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $("#best_price_view1").css("display","none");
    $("#myModal1").modal("show");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#interest_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
   $("#company_name").css("display","none");
  });
  
  $("#Ansehen").click(function(){
    $(this).addClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $(".dropbtn").addClass("activebutton");
    $(".dropbtn").text("Ansehen und downloaden eigene Fälligkeitsliste");
    $("#eigene").removeClass("activebutton");
    $("#Ansehen1").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
    $("#maturity_table").css("display","block");
    $("#history_maturity_table").css("display","none");
    $("#best_price_view1").css("display","none");
    $("#interest_table").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
  });
  $("#Ansehen1").click(function(){
    $(this).addClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $(".dropbtn").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");

    //$(".dropbtn").addClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    //$(".dropbtn").text("Ansehen und downloaden eigene Fälligkeitsliste");
    $("#eigene").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
    $("#maturity_table").css("display","block");
    $("#history_maturity_table").css("display","none");
    $("#best_price_view1").css("display","none");
    $("#interest_table").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
  });
  $("#Ansehenund").click(function(){
    $(this).addClass("activebutton");
    $(".dropbtn").addClass("activebutton");
    $(".dropbtn").text("Ansehen und downloaden in der Vergangenheit getätigter Geschäfte");
    $("#settings_start_page").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#Ansehen1").removeClass("activebutton");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","block");
    $("#best_price_view1").css("display","none");
    $("#interest_table").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
  });
  $("#Ansehenund1").click(function(){
    $(this).addClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    //$(this).addClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $(".dropbtn").removeClass("activebutton");
    //$(".dropbtn").addClass("activebutton");
    //$(".dropbtn").text("Ansehen und downloaden in der Vergangenheit getätigter Geschäfte");
    $("#settings_start_page").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#Ansehen1").removeClass("activebutton");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","block");
    $("#best_price_view1").css("display","none");
    $("#interest_table").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
  });

  $("#export_pdf").click(function(){
    var doc = new jsPDF();
    var specialElementHandlers = {
      '#editor': function (element, renderer) {
        return true;
      }
    };
    doc.fromHTML($('#maturityTableData').html(), 15, 15, {
      'width': 170,
      'elementHandlers': specialElementHandlers
    });
    doc.save('sample-file.pdf');
  });
  $("#historyexport_pdf").click(function(){
    var doc = new jsPDF();
    var specialElementHandlers = {
      '#editor': function (element, renderer) {
        return true;
      }
    };
    doc.fromHTML($('#historymaturityTableData').html(), 15, 15, {
      'width': 170,
      'elementHandlers': specialElementHandlers
    }
                );
    doc.save('sample-file.pdf');
  });
  $("#export_excel").click(function(){
    $("#maturityTableData").table2excel({
      exclude: ".noExl",
      name: "Results"
    });
  });
  $("#historyexport_excel").click(function(){
    $("#maturityTableData").table2excel({
      exclude: ".noExl",
      name: "Results"
    });
  });
  tempering12 = '';
  function MaturityTable()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/maturities",
      method:"post",
      cache:false,
      success:function(htnlstr){
        if(tempering12 != htnlstr){
          $("#maturityTableData").html(htnlstr);
          tempering12 = htnlstr;
        }
        $(".maturitysorting").click(function(){
          if($(this).hasClass('active')){
            var sorting_of = $(this).attr("data-id");
            $('.maturitysorting[data-id=' + sorting_of + ']').css("background-color","green");
            var view = 'sort='+sorting_of;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/getmaturitydescendingsortedData",
              method:"post",
              data : view,
              cache:false,
              success:function(htnlstr){
                $("#maturityTableData").html(htnlstr);
                $('.maturitysorting[data-id=' + sorting_of + ']').css("background-color","yellow");
                $('.maturitysorting[data-id=' + sorting_of + ']').removeClass("active");
              }
            });
          }
          else{
            var sorting_of = $(this).attr("data-id");
            $('.maturitysorting[data-id=' + sorting_of + ']').css("background-color","green");
            var view = 'sort='+sorting_of;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/getmaturitysortedData",
              method:"post",
              data : view,
              cache:false,
              success:function(htnlstr){
                $("#maturityTableData").html(htnlstr);
                $('.maturitysorting[data-id=' + sorting_of + ']').css("background-color","green");
                $('.maturitysorting[data-id=' + sorting_of + ']').addClass("active");
              }
            });
          }
        });
      }
    });
  }
  var tempering13 = '';
  function HistoryMaturityTable()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/historymaturities",
      method:"post",
      cache:false,
      success:function(htnlstr){
        if(tempering13 != htnlstr){
          $("#historymaturityTableData").html(htnlstr);
          tempering13 = htnlstr;
        }
        $(".historymaturitysorting").click(function(){
          if($(this).hasClass("active")){
            var sorting_of = $(this).attr("data-id");
            $('.historymaturitysorting[data-id=' + sorting_of + ']').css("background-color","green");
            var view = 'sort='+sorting_of;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/getdeschistorymaturitysortedData",
              method:"post",
              data : view,
              cache:false,
              success:function(htnlstr){
                $("#historymaturityTableData").html(htnlstr);
                $('.historymaturitysorting[data-id=' + sorting_of + ']').css("background-color","yellow");
                $('.historymaturitysorting[data-id=' + sorting_of + ']').removeClass("active");
              }
            }
                  );
          }
          else{
            var sorting_of = $(this).attr("data-id");
            $('.historymaturitysorting[data-id=' + sorting_of + ']').css("background-color","green");
            var view = 'sort='+sorting_of;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/gethistorymaturitysortedData",
              method:"post",
              data : view,
              cache:false,
              success:function(htnlstr){
                $("#historymaturityTableData").html(htnlstr);
                $('.historymaturitysorting[data-id=' + sorting_of + ']').css("background-color","green");
                $('.historymaturitysorting[data-id=' + sorting_of + ']').addClass("active");
              }
            });
          }
        });
      }
    });
  }
// ************************************* END COCKPIT *************************************

  $("#all_banks_price").click(function(){
    $(this).addClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $("#Ansehenund1").removeClass("activebutton");
  $("#Ansehen1").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $(".dropbtn").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#BANKENAUSWAHL").css("display","none");
    $("#all_interest_table").css("display","block");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#buttondiv").css("display","block");
    $("#interest_table").css("display","none");
    $("#best_price_view1").css("display","none");
    $("#company_name").css("display","none");
    settingValue = 'allBankList';
    viewterm = 'settingValue='+settingValue;
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/allBanksListupdate",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
      }
    }
          );
  });
  $(".interest").click(function(){
    var value = $(this).attr("data-value");
    term = 'term='+value;
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/lendersBank",
      method:"post",
      data:term,
      cache:false,
      success:function(htnlstr){
        if($.trim(htnlstr) == ''){
          $("#lendersBank").html('No records found.');
        }
        else{
        }
      }
    }
          );
  }
                      );
  jQuery('.lendercheck').change(function() {
    var Id = $(this).attr("data-id");
    var bankId = $(this).attr("data-value");
    if ($(this).prop('checked')){
      borrowerId = 'borrowerId='+Id+'&bankId='+bankId;
      $.ajax({
        url:"<?php echo base_url(); ?>instimatch/adOnborrower",
        method:"post",
        data:borrowerId,
        cache:false,
        success:function(htnlstr){
          $("#bank_Interest").append($(htnlstr));
        }
      }
            );
    }
    else {
      var element = $('#bank_Interest tr[data-id='+Id+']').hide();
      borrowerId = 'borrowerId='+Id;
      $.ajax({
        url:"<?php echo base_url(); ?>instimatch/addremoveborrower",
        method:"post",
        data:borrowerId,
        cache:false,
        success:function(htnlstr){
        }
      }
            );
    }
  });
  $("#setting_start_page").on('change',function(){
    var settingValue = this.value;
    //alert(settingValue);
    if(settingValue == "viewall"){
      $("#buttondiv").css("display","block");
      $("#interest_table").css("display","block");
      $("#best_price_view1").css("display","none");
      $("#maturity_table").css("display","none");
      $("#history_maturity_table").css("display","none");
    }
    else if(settingValue == "bestprice"){
      $("#best_price_view1").css("display","block");
      $("#buttondiv").css("display","block");
      $("#interest_table").css("display","none");
      $("#maturity_table").css("display","none");
      $("#history_maturity_table").css("display","none");
    }
    else if(settingValue == "allbanks"){
      $("#buttondiv").css("display","block");
      $("#all_interest_table").css("display","block");
      $("#company_name").css("display","none");
      $("#interest_table").css("display","none");
      $("#best_price_view1").css("display","none");
      $("#maturity_table").css("display","none");
      $("#history_maturity_table").css("display","none");
    }

    viewterm = 'settingValue='+settingValue;
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/lenderviewsection",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
        $("#myModal1").modal("hide");
      }
    });
  });
  //************************** MAIN SCREEN BUTTONS *****************************
  $("#best_price_view").click(function(){
    $(this).addClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
  $("#Ansehen1").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $(".dropbtn").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    
    $("#all_interest_table").css("display","none");
    $("#best_price_view1").css("display","block");
    $("#view_all_price").css("display","block");
    $("#buttondiv").css("display","block");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#interest_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    viewterm = 'view=best';
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/lendersettledview",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
      }
    }
          );
  }
                             );
  $("#view_all_price").click(function(){
    $(this).addClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $("#Ansehenund1").removeClass("activebutton");
  $("#Ansehen1").removeClass("activebutton");
    $(".dropbtn").removeClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $("#all_interest_table").css("display","none");
    $("#best_price_view").css("display","block");
    $("#buttondiv").css("display","block");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#EINSTELLUNGEN").css("display","block");
    $("#interest_table").css("display","block");
    $("#best_price_view1").css("display","none");
    viewterm = 'view=viewa';
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/lendersettledview",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
      }
    }
          );
  });
  $("#EINSTELLUNGEN").click(function(){
    $("#company_name").css("display","block");
    $("#BANKENAUSWAHL").css("display","block");
    $("#EINSTELLUNGEN").css("display","none");
  }
                           );
  $("#BANKENAUSWAHL").click(function(){
    $("#EINSTELLUNGEN").css("display","block");
    $("#company_name").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
  });
  
  $("#lendermodal").click(function(){
    $("#all_interest_table").css("display","none");
    $("#company_name").css("display","block");
    $("#interest_table").css("display","none");
    $("#best_price_view1").css("display","none");
    $("#view_all_price").css("display","block");
    if($("#best_price_view").hide()){
      $("#best_price_view").show();
    }
    viewterm = 'view=lend';
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/lendersettledview",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
      }
    }
          );
  }
                         );
  
  function setUserType(userType)
  {
    if(userType == "borrower"){
      $("#lenderDiv").css("display","none");
      $("#borrowerDiv").css("display","block");
      $("#checkedType").text("Darlehensnehmer");
    }
    if(userType == "lender"){
      $("#borrowerDiv").css("display","none");
      $("#lenderDiv").css("display","block");
      $("#checkedType").text("Investor");
    }
    $.ajax({
      url      : "<?php echo base_url(); ?>instimatch/setviewtype",
      data     : "userType="+userType,
      method   : "post" ,
      cache    : false ,
      success : function(result)
      {
      }
    }
          );
  }
  var tempering = '';
  function getlatestdata(){
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/getlatestdata",
      method:"post",
      cache:false,
      success:function(htnlstr){
        // alert(htnlstr);
        // return false;
        if(tempering != htnlstr){
          $("#bank_Interest").html(htnlstr);
          tempering = htnlstr;
        }
        $(".sorting").click(function(){
          var sorting_of = $(this).attr("data-id");
          $('.sorting[data-id=' + sorting_of + ']').css("background-color","green");
          var view = 'sort='+sorting_of;
          $.ajax({
            url:"<?php echo base_url(); ?>instimatch/getsortedData",
            method:"post",
            data : view,
            cache:false,
            success:function(htnlstr){
              $("#bank_Interest").html(htnlstr);
              $('.sorting[data-id=' + sorting_of + ']').css("background-color","green");
            }
          }
                );
        }
                           );
        $(".bankrows").click(function(){
          var bankIds = $(this).attr("data-id");
          $("#requestmessage").html("");
          bankId = 'bankId='+bankIds;
          $.ajax({
            url:"<?php echo base_url(); ?>instimatch/lenderRequestSend",
            method:"post",
            data:bankId,
            cache:false,
            success:function(htnlstr){
              $('#lendrequestmodal').modal({
                keyboard: false,show: true}
                                          );
              $('#lendermodaldialog').draggable({
                handle: "#lendermodalheadr"}
                                               );
              $("#lendrequestbody").html(htnlstr);
              $("#datepicker1").datepicker({
                dateFormat:'dd/mm/yy',
                minDate: 0,
                onSelect: function(dateText, inst) {
                  var end_date = $(this).val();
                  var start_date = $("#datepicker").val();
                  var dateDifference = datediff(parseDate(start_date), parseDate(end_date));
                  //alert(dateDifference);
                  $("#no_of_days").html(dateDifference);
                }
              }
                                          );
              $("#datepicker").datepicker({
                dateFormat:'dd/mm/yy',
                minDate: 0,
                onSelect: function(dateText, inst) {
                  var start_date = $(this).val();
                  var end_date = $("#datepicker1").val();
                  var dateDifference = datediff(parseDate(start_date), parseDate(end_date));
                  //alert(dateDifference);
                  $("#no_of_days").html(dateDifference);
                }
              }
                                         );
              $('.requestamount').on('blur', function() {
                var number1 = $(this).val();
                var number = parseFloat(number1).toFixed(2);
                var withCommas = Number(number).toLocaleString('eu');
                var amount = withCommas.replace(/,/g, ".");
                if(amount.indexOf('.') !== -1)
                {
                  $(this).val(amount);
                }
                else{
                  $(this).val(number1);
                }
              }
                                    );
              $("#sendRequest").click(function(){
                var lender_id = "<?php echo $_SESSION['user_id'];?>";
                var amount = $(".requestamount").val();
                var start_date = $("#datepicker").val();
                var end_date = $("#datepicker1").val();
                var no_of_days = $("#no_of_days").html();
                var payments = $("#payments").val();
                var interest = $("#interest").val();
                var data_to_send = 'lenderId='+lender_id+'&amount='+amount+'&start_date='+start_date+'&end_date='+end_date+'&no_of_days='+no_of_days+'&payments='+payments+'&borrowerId='+bankIds+'&interest='+interest;
                $.ajax({
                  url:"<?php echo base_url(); ?>instimatch/updateRequestSend",
                  method:"post",
                  data:data_to_send,
                  cache:false,
                  success:function(htnlstr){
                    $("#requestmessage").html("REQUEST SENT SUCCESFULLY. PLEASE WAIT FOR BORROWER’S RESPONSE.");
                    $("#sendRequest").prop("disabled",true);
                  }
                }
                      );
              });
            }
          });
        });
        $(".viewpdf").click(function(){
          var dataId =  $(this).attr("data-id");
          $("#showborrowerPdf").modal("show");
          borrower = 'borrower='+dataId;
          $.ajax({
            url:"<?php echo base_url(); ?>instimatch/getborroweruserpdfs",
            method:"post",
            cache:false,
            data:borrower,
            success:function(htnlstr){
              $("#showborrowerpdfbody").html(htnlstr);
            }});
          return false;
          
        });
      }
    });
  }
  var alltempering = '';
  function getAllBanks(){
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/getAllBanksList",
      method:"post",
      cache:false,
      success:function(htnlstr){
        if(alltempering != htnlstr){
          $("#all_banks_interest").html(htnlstr);
          alltempering = htnlstr;
        }
        $(".banksorting").click(function(){
          var sorting_of = $(this).attr("data-id");
          $('.banksorting[data-id=' + sorting_of + ']').css("background-color","green");
          var view = 'sort='+sorting_of;
          $.ajax({
            url:"<?php echo base_url(); ?>instimatch/getallBanksortedData",
            method:"post",
            data : view,
            cache:false,
            success:function(htnlstr){
              $("#all_banks_interest").html(htnlstr);
              $('.banksorting[data-id=' + sorting_of + ']').css("background-color","green");
            }
          });
        });
      }
    });
  }
  $("#eigenepdfBtn").click(function(){
    $("#pdfmessage").html("");
    $("#LenderPdf").modal("show");
  });
  $('form#pdfupload').on('submit',(function(e) {
        $("#pdfmessage").html("pdf is uploading.....");
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type:'POST',
            url: "<?php echo base_url(); ?>instimatch/uploadpdf",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
              
              if(data == "true")
              {
                $("#LenderPdf").modal("hide");
                

              }else{
                alert("Something Wrong");
              }
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
    }));

  function submit()
  {
    $("form#pdfupload").submit(); 
      //console.log(' form submitted');
  }
  var pdfvar = '';
  function getuserpdf()
  {
          $.ajax({
            url:"<?php echo base_url(); ?>instimatch/getuserpdf",
            method:"post",
            cache:false,
            success:function(htnlstr){
              if(pdfvar != htnlstr){
                $(".showpdf").html(htnlstr);
                $(".pdffile").click(function(){
                  var pdfName = $(this).attr("data-id");
                  var fname = "<?php echo base_url(); ?>assets/PDFFiles/"+pdfName+"";
                  $("#showPdf").modal("show");
                  $('div#showpdfbody').replaceWith("<div class='pdf'><iframe src='" + fname + "' width='600' height='500'></iframe></div>");
                });
                $(".deletedpdf").click(function(){
                  var delpdf = $(this).attr("data-id");
                  var result = confirm("Are you sure want to delete "+delpdf+" ?");
                  if (result) {
                      var view = 'pdf='+delpdf;
                      $.ajax({
                      url: "<?php echo base_url(); ?>instimatch/delupdatepdf",
                      type: 'POST',
                      data: view,
                      cache:false,
                      success: function (data) {
                          //alert(data);
                      }
                  });
                  }

                  });

                
                var pdfvar = htnlstr;
              }
              
            }
          });

  }
  
  var lenderTerm = "<?php echo $lenderTerm; ?>";
  $('#interestheading *[data-value="'+lenderTerm+'"]').addClass("active");
  $(document).ready(function(){
    //getuserpdf();
    setInterval("getuserpdf()",1000);
    setInterval("BanksInterest()",1000);
    setInterval("LenderNotification()",1000);
    setInterval("MaturityTable()",1000);
    setInterval("HistoryMaturityTable()",1000);
    setInterval("lendersBanks()", 1000);
    setInterval("getAdminRequestResponse()", 1000);
    setInterval("getlatestdata()", 1000);
    setInterval("getAllBanks()", 1000);
  }
                   );
</script>
