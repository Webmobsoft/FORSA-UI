<script>
    $("#best_price_view").click(function(){                     
    $("#best_price_view1").css("display","block");
    $("#view_all_price").css("display","block");
    $("#bank_Interest").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    $("#EINSTELLUNGEN").css("display","none");
    $(this).addClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $("#Ansehen1").removeClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");

$(".dropbtn").text("COCKPIT");
$(".dropbtn").removeClass("activebutton");
//$("#best_price_view").removeClass("activebutton");
$("#Ansehenund").removeClass("activebutton");
$("#Ansehen").removeClass("activebutton");
$("#eigene").removeClass("activebutton");
$("#settings_start_page").removeClass("activebutton");
// $("#view_all_price").removeClass("activebutton");




    // $("#BANKENAUSWAHL").css("display","none");
    // $("#all_interest_table").css("display","none");
    
    //$("#buttondiv").css("display","block");
    // $("#maturity_table").css("display","none");
    // $("#history_maturity_table").css("display","none");
    // $("#interest_table").css("display","none");
    //$("#company_name").css("display","none");
    // viewterm = 'view=best';
    // $.ajax({
    // url:"<?php echo base_url(); ?>instimatch/lendersettledview",
    // method:"post",
    // data:viewterm,
    // cache:false,
    // success:function(htnlstr){


    // }
    // });


  });
  var temp = "";
  function BanksInterest()
  {
    var customerId = "<?php echo $_GET['customerid']; ?>";
      var term = 'customerid='+customerId;
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/KontakteLatestBanksInterest",
      method:"post",
      cache:false,
      data:term,
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
            term = 'term='+value+'&customerId='+customerId;
            $.ajax({
              url:"<?php echo base_url(); ?>instimatch/kontaktelendersBank",
              method:"post",
              data:term,
              cache:false,
              success:function(htnlstr){
                //   alert(htnlstr);
                //   return false;
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

  $("#view_all_price").click(function(){
    $(this).addClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $(".dropbtn").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $("#Ansehen1").removeClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
    $("#bank_Interest").css("display","block");
    $("#best_price_view1").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    $("#EINSTELLUNGEN").css("display","block");
    //$("#view_all_price").css("display","none");
    viewterm = 'view=viewa';
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/lendersettledview",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
      }
    });
  });
  $("#all_banks_price").click(function(){
    $(this).addClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $(".dropbtn").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $("#Ansehen1").removeClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
    $("#best_price_view1").css("display","none");
    $("#bank_Interest").css("display","none");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    $("#EINSTELLUNGEN").css("display","none");
    $("#all_interest_table").css("display","block");
    

    settingValue = 'allBankList';
    viewterm = 'settingValue='+settingValue;
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/allBanksListupdate",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
      }
    });
  });
  var alltempering = '';
  function getAllBanks(){
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/getAllBanksForKontakte",
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
            url:"<?php echo base_url(); ?>instimatch/getallBankkontaktesortedData",
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

  var temp1 = "";
  function lendersBanks(){
    var customerId = "<?php echo $_GET['customerid']; ?>";
      var term = 'customerid='+customerId;
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/kontaktelendersLatestBanks",
      method:"post",
      cache:false,
      data:term,
      success:function(htnlstr){
        // alert(htnlstr);
        // return false;
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
                }
                                       );
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

  $("#EINSTELLUNGEN").click(function(){
    $("#company_name").css("display","block");
    $("#BANKENAUSWAHL").css("display","block");
    $("#EINSTELLUNGEN").css("display","none");
  });
  $("#BANKENAUSWAHL").click(function(){
    $("#EINSTELLUNGEN").css("display","block");
    $("#company_name").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
  });
  $("#eigene").click(function(){
    $(this).addClass("activebutton");
    $(".dropbtn").addClass("activebutton");

    $(".dropbtn").text("Eigene Stammdatenverwaltung");
    $("#best_price_view1").css("display","none");
    $("#bank_Interest").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#EINSTELLUNGEN").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    var customerId = "<?php echo $_GET['customerid']; ?>";
      var term = 'customerid='+customerId;
     $.ajax({
       url:"<?php echo base_url(); ?>instimatch/getKontakteUserDetails",
       cache:false,
       data:term,
       success:function(htnlstr){
         $("#eigeneModal").modal("show");
         $("#eigeneBody").html(htnlstr);
         $("#updateuser").click(function(){
           var company_name = $("#company_name1").val();
           var street = $("#street").val();
           var city = $("#city").val();
           var Prefex = $("#Prefex").val();
           var Title = $("#Title").val();
           var fname = $("#fname").val();
           var lname = $("#lname").val();
           var email = $("#email").val();
           var uname = $("#uname").val();
           var contact_number = $("#contact_number").val();
           var clientgroup = $("#clientgroup").val();
           var userData = 'company_name='+company_name+'&street='+street+'&city='+city+
               '&Prefex='+Prefex+'&Title='+Title+'&fname='+fname+'&lname='+lname+'&email='+email+'&uname='+uname+'&contact_number='+contact_number+'&clientgroup='+clientgroup+'&customerid='+customerId;
           $.ajax({
             url:"<?php echo base_url(); ?>instimatch/updatekontakteUserDetails",
             method:"post",
             data:userData,
             cache:false,
             success:function(htnlstr){
              //  alert(htnlstr);
              //  return false;
               $("#successmessage").text("User details update successfully.").css("background-color","green");
             }
           });
         });

       }
     });
   });
   $("#Ansehen").click(function(){
    $("#best_price_view1").css("display","none");
    $("#bank_Interest").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#maturity_table").css("display","block");
    $("#Ansehenund1").removeClass("activebutton");
    $("#history_maturity_table").css("display","none");
    $("#EINSTELLUNGEN").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    
  });
  $("#Ansehen1").click(function(){
    $(this).addClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $(".dropbtn").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehenund1").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");

    $("#best_price_view1").css("display","none");
    $("#bank_Interest").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#maturity_table").css("display","block");
    $("#history_maturity_table").css("display","none");
    $("#EINSTELLUNGEN").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    
  });
  tempering12 = '';
  function MaturityTable()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/maturities",
      method:"post",
      cache:false,
      success:function(htnlstr){
        //   alert(htnlstr);
        //   return false;
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
  $("#Ansehenund").click(function(){
    $("#best_price_view1").css("display","none");
    $("#bank_Interest").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#maturity_table").css("display","none");
   
    $("#history_maturity_table").css("display","block");
    $("#EINSTELLUNGEN").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
   
  });
  $("#Ansehenund1").click(function(){

     $(this).addClass("activebutton");
    $("#best_price_view").removeClass("activebutton");
    $("#view_all_price").removeClass("activebutton");
    $(".dropbtn").text("COCKPIT");
    $(".dropbtn").removeClass("activebutton");
    $("#Ansehenund").removeClass("activebutton");
    $("#Ansehen").removeClass("activebutton");
    $("#eigene").removeClass("activebutton");
    $("#settings_start_page").removeClass("activebutton");
    $("#all_banks_price").removeClass("activebutton");

    $("#best_price_view1").css("display","none");
    $("#bank_Interest").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","block");
    //$("#history_maturity_table").css("display","block");
    $("#EINSTELLUNGEN").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
  });
  $("#settings_start_page").click(function(){
    $("#best_price_view1").css("display","none");
    $("#bank_Interest").css("display","none");
    $("#all_interest_table").css("display","none");
    $("#EINSTELLUNGEN").css("display","none");
    $("#BANKENAUSWAHL").css("display","none");
    $("#company_name").css("display","none");
    $("#myModal1").modal("show");
  });
  $("#setting_start_page").on('change',function(){
    var settingValue = this.value;
    // alert(settingValue);
     if(settingValue == "viewall"){
      $("#buttondiv").css("display","block");
      $("#bank_Interest").css("display","block");
      $("#best_price_view1").css("display","none");
      $("#maturity_table").css("display","none");
      $("#history_maturity_table").css("display","none");
     }
    else if(settingValue == "bestprice"){
      $("#best_price_view1").css("display","block");
      $("#buttondiv").css("display","block");
      $("#bank_Interest").css("display","none");
      $("#maturity_table").css("display","none");
      $("#history_maturity_table").css("display","none");
    }
    else if(settingValue == "allbanks"){
      //$("#company_name").css("display","block");
      $("#bank_Interest").css("display","none");
      $("#all_interest_table").css("display","block");
      $("#best_price_view1").css("display","none");
      $("#maturity_table").css("display","none");
      $("#history_maturity_table").css("display","none");
    }
    var customerId = "<?php echo $_GET['customerid']; ?>";
    // var term = 'customerid='+customerId;

    viewterm = 'settingValue='+settingValue+'&customerid='+customerId;
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/kontaktelenderviewsection",
      method:"post",
      data:viewterm,
      cache:false,
      success:function(htnlstr){
        $("#myModal1").modal("hide");
      }
    });
  });
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
  var tempering = '';
    function getlatestdata(){
      var customerId = "<?php echo $_GET['customerid']; ?>";
      var term = 'customerid='+customerId;
  $.ajax({
    url:"<?php echo base_url(); ?>instimatch/getlatestdataviewuser",
    data:term,
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
        var view = 'sort='+sorting_of+'&customerid='+customerId;
        $.ajax({
        url:"<?php echo base_url(); ?>instimatch/getCustomerSorted",
        method:"post",
        data : view,
        cache:false,
        success:function(htnlstr){
          // alert(htnlstr);
          // return false;
        $("#bank_Interest").html(htnlstr);
        $('.sorting[data-id=' + sorting_of + ']').css("background-color","green");
        }
        });
        // $.ajax({
        // url:"<?php //echo base_url(); ?>instimatch/getblanksortedData",
        // method:"post",
        // cache:false,
        // success:function(htnlstr1){
        // $("#bank_Interest1").html(htnlstr1);
        // $('.sorting[data-id=' + sorting_of + ']').css("background-color","green");
        // }
        // });
      });

      //$("#bank_Interest").html(htnlstr);
    }
    });
}
jQuery('.lendercheck').change(function() {
    var Id = $(this).attr("data-id");
    var bankId = $(this).attr("data-value");
    if ($(this).prop('checked')){
      var customerId = "<?php echo $_GET['customerid']; ?>";
      borrowerId = 'borrowerId='+Id+'&bankId='+bankId+'&customerId='+customerId;
      $.ajax({
        url:"<?php echo base_url(); ?>instimatch/adkontakteOnborrower",
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
      var customerId = "<?php echo $_GET['customerid']; ?>";
      borrowerId = 'borrowerId='+Id+'&customerId='+customerId;
      $.ajax({
        url:"<?php echo base_url(); ?>instimatch/addkontakteremoveborrower",
        method:"post",
        data:borrowerId,
        cache:false,
        success:function(htnlstr){
          // alert(htnlstr);
          // return false;
        }
      });
    }
  });
$(document).ready(function(){
 // getlatestdata();

setInterval("getlatestdata()", 1000);
});
  $(document).ready(function(){
    //getAllBanks();
    MaturityTable();
    HistoryMaturityTable();
    setInterval("BanksInterest()",1000);
    setInterval("getAllBanks()", 1000);

  });
  
    </script>