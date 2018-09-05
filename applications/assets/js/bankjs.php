<script type="text/javascript">
$("#Country-modal").click(function(){
    $('#Counterparty-Konfiguration').modal('show');
});
jQuery(document).ready(function() {
    jQuery('.client_group_checkbox').change(function() {
      var value = $(this).val();
        if ($(this).prop('checked')) {
      status = 'access_value='+value+'&status=Y';
      $.ajax({
      url:"<?php echo base_url(); ?>instimatch/updateaccessclient",
      method:"post",
      data:status,
      cache:false,
      success:function(htnlstr){
      }
      });
        }else {
      status = 'access_value='+value+'&status=N';
      $.ajax({
      url:"<?php echo base_url(); ?>instimatch/updateaccessclient",
      method:"post",
      data:status,
      cache:false,
      success:function(htnlstr){
      }
      });
        }
    });
});



//     $(".editable").keydown(function (e) {
//         // Allow: backspace, delete, tab, escape, enter and .
//         if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
//              // Allow: Ctrl+A, Command+A
//             (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
//              // Allow: home, end, left, right, down, up
//             (e.keyCode >= 35 && e.keyCode <= 40)) {
//                  // let it happen, don't do anything
//                  return;
//         }
//         // Ensure that it is a number and stop the keypress
//         if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
//           alert("good");
//             e.preventDefault();
//         }
//     });

// return false;



$('.editable').on('click', function() {
    var $this = $(this);
    var $input = $('<input>', {
        value: $this.text(),
        type: 'text',
        class: 'edittext',
        maxlength:'6',
        blur: function(e) {
if(this.value != ''){
if (/^[0-9-+., ]+$/.test(this.value) == false) {
alert('Your Interest Contains illegal Characters.');
$this.text('');
}else{
      var intere = this.value.replace(/,/g, '.');
      var splitting = intere.split(".");
      if(intere.charAt(intere.length -1) == '.'){
      var interes = intere+'00';
      }else if(intere.charAt(0) == '.'){
      var interes = '0'+intere;
      }else if (intere.indexOf('.') == -1) { 
      var interes = intere+'.00';
      }else if(splitting[1].length == 1){
      var interes = intere+'0';
      }else if(splitting[1].length > 3){
        var interes = '';
        alert("Maximum Three Decimal");
      }
      else{
      var interes = intere;
      }
}
}else{
  var interes = '';
}
$this.text(interes);

           
        },
        keyup: function(e) {
           if (e.which === 13) $input.blur();
        }
    }).appendTo( $this.empty() ).focus();
});

$(".infoon").click(function(){
      var lenderId = $(this).attr("data-id");
      var status = $(this).attr("data-value");
      if(status == "N"){
        $(this).text("OFF");
        $(this).attr('data-value', 'Y');
      }else if(status == "Y"){
        $(this).text("ON");
        $(this).attr('data-value', 'N');
      }
      status = 'status='+status+'&lenderId='+lenderId;
      $.ajax({
      url:"<?php echo base_url(); ?>instimatch/updatelenderstatus",
      method:"post",
      data:status,
      cache:false,
      success:function(htnlstr){
      }
      });
    });
    $(".plus-btn").click(function()
    {
   
        var id = $(this).attr("data-id");
        var number = $("#interests #"+id+"").text();
       
        var number = parseFloat(number) + parseFloat(0.01);
        var number = number.toFixed(2);
        $("#interests #"+id+"").text(number);
    });

    $(".min-btn").click(function()
    {
        var id = $(this).attr("data-id");
        var number = $("#interests #"+id+"").text();
        var number = parseFloat(number) - parseFloat(0.01);
        var number = number.toFixed(2);
        $("#interests #"+id+"").text(number);


    });
    $(".infoLender").click(function(){
    $('#info-lender').modal('show');

    var lenderId = $(this).attr("data-id");
    var lender = 'lenderId='+ lenderId;
    $.ajax({
    url:"<?php echo base_url(); ?>instimatch/lenderdetails",
    method:"post",
    data:lender,
    cache:false,
    success:function(htnlstr){
    $("#info-lender .modal-body").html(htnlstr);
    }
    });
    });
$("#publish").click(function(){
        $("#status_live").val("SATATUS: ON");
        $("#status_live").css("display","block");
        $( "#stop_publish" ).prop( "disabled", false );
        var Tagesgeld = $("#interests #Tagesgeld").text();
        var oneWoche = $("#interests #1Woche").text();
        var twoWoche = $("#interests #2Woche").text();
        var threeWoche = $("#interests #3Woche").text();
        var oneMonat = $("#interests #1Monat").text();
        var twoMonat = $("#interests #2Monat").text();
        var threeMonat = $("#interests #3Monat").text();
        var fourMonat = $("#interests #4Monat").text();
        var fiveMonat = $("#interests #5Monat").text();
        var sixMonat = $("#interests #6Monat").text();
        var sevenMonat = $("#interests #7Monat").text();
        var eightMonat = $("#interests #8Monat").text();
        var nineMonat = $("#interests #9Monat").text();
        var tenMonat = $("#interests #10Monat").text();
        var elevenMonat = $("#interests #11Monat").text();
        var twelevMonat = $("#interests #12Monat").text();
        var twoJahre = $("#interests #2Jahre").text();
        var threeJahre = $("#interests #3Jahre").text();
        var fourJahre = $("#interests #4Jahre").text();
        var fiveJahre = $("#interests #5Jahre").text();
        var Interests = 'Tagesgeld='+ Tagesgeld +'&oneWoche='+ oneWoche +'&twoWoche=' +twoWoche+'&threeWoche='+threeWoche+'&oneMonat=' +oneMonat+'&twoMonat='+twoMonat+'&threeMonat='+threeMonat+'&fourMonat='+fourMonat+'&fiveMonat='+fiveMonat+'&sixMonat='+sixMonat+'&sevenMonat='+sevenMonat+'&eightMonat='+eightMonat+'&nineMonat='+nineMonat+'&tenMonat='+tenMonat+'&elevenMonat='+elevenMonat+'&twelevMonat='+twelevMonat+'&twoJahre='+twoJahre+'&threeJahre='+threeJahre+'&fourJahre='+fourJahre+'&fiveJahre='+fiveJahre;
        $.ajax({
        url:"<?php echo base_url(); ?>instimatch/interestsofbank",
        method:"post",
        data:Interests,
        cache:false,
        success:function(htnlstr){
            if(htnlstr == 'true'){
            }else{
                alert("Try Again");
            }
        }
        });
});
$("#stop_publish").click(function(){
$("#status_live").val("SATATUS: OFF");
var Id = "<?php echo $_SESSION['user_id']; ?>";
$( "#publish" ).prop( "disabled", false );
    $.ajax({
    url:"<?php echo base_url(); ?>instimatch/unpublishInterest",
    method:"post",
    cache:false,
    success:function(htnlstr){
    if(htnlstr == 'true'){
    }else{
    alert("Try Again");
    }
    }
    });
});
var temp2 = "";
function Notifications()
{
$.ajax({
url:"<?php echo base_url(); ?>instimatch/Notifications",
cache:false,
success:function(htnlstr){
    // console.log(htnlstr);
    // return false;
  if(temp2 != htnlstr && htnlstr != 'false'){
    $('#notificationModal').modal({ keyboard: false,show: true});
    $('#notificationmodaldialog').draggable({handle: "#notificationmodalheader"});
    $("#requestmessage1").html("");
    $("#lendrequestmodal").modal("hide");
    $("#notificationModal").modal("show");  
    $("#notificationbody").html(htnlstr);
    $(".sendborrowerRequest").click(function(){
    var requestId = $(this).attr("data-id");
    var interest = $(".intrestrate-"+requestId).val();
   // var interest_rate = $(".interests-"+requestId).val();
    var data_to_send = 'requestId='+requestId+'&interest_rate='+interest; 
    $.ajax({
    url:"<?php echo base_url(); ?>instimatch/updateborrowerRequest",
    method:"post",
    data:data_to_send,
    cache:false,
    success:function(htnlstr){
         $("#requestmessage1").html("INTEREST RATE SENT SUCCESSFULLY. PLEASE WAIT FOR LENDER TO RESPOND");
         $("#sendborroreq").prop("disabled",true);     
    }
    });
    });

  }
  temp2 = htnlstr;
}
});
}
var temp4 = "";
function AcceptDealsRequeest()
{
        $.ajax({
        url:"<?php echo base_url(); ?>instimatch/AcceptedDeals",
        method:"post",
        cache:false,
        success:function(htnlstr){
          // alert(htnlstr);
          // return false;
          if(htnlstr != 'false' && temp4 != htnlstr){
          $('#requestresponseModal').modal({ keyboard: false,show: true});
          $('#requestresponsedialog').draggable({handle: "#requestresponseheader"});
          $("#requestresponseModal").modal("show");
          $('#notificationModal').modal('hide');
          $("#requestresponsebody").html(htnlstr);
          $(".acceptdeal").click(function(){
            var userId = $(this).attr("data-id");
            var userids = 'userId='+userId;
            // alert(userids);
            // return false;
            $.ajax({
            url:"<?php echo base_url(); ?>instimatch/updateAcceptResponse",
            method:"post",
            cache:false,
            data:userids,
            success:function(htnlstr){
              $('#notificationModal').modal('hide');
              $("#requestresponseModal").modal("hide");
            }
            });
          });
          }
          var temp4 = htnlstr;
        }
        });
}
var tempe5 = "";
function DeclineDealsRequeest()
{
        $.ajax({
        url:"<?php echo base_url(); ?>instimatch/DeclinedDeals",   
        method:"post",
        cache:false,
        success:function(htnlstr){  
        //  alert(htnlstr);
        //  return false;  
         if(htnlstr != 'false' && tempe5 != htnlstr)
         {
          $('#requestresponseModal').modal({ keyboard: false,show: true});
          $('#requestresponsedialog').draggable({handle: "#requestresponseheader"});
            $("#requestresponseModal").modal("show");
            $('#notificationModal').modal('hide');
            $("#requestresponsebody").html(htnlstr);
            $(".declinedeal").click(function()
            {
              var userId = $(this).attr("data-id");  
              var userids = 'userId='+userId;
              // alert(userids);
              // return false;
              $.ajax(
              {
                url:"<?php echo base_url(); ?>instimatch/updateDeclineResponse",
                method:"post",
                cache:false,
                data:userids,
                success:function(htnlstr)
                {
                  // alert(htnlstr);
                  $('#notificationModal').modal('hide');
                  $("#requestresponseModal").modal("hide");
            //alert(htnlstr);
                }
              });
           // alert(userId);

            });
          }
          var tempe5 = htnlstr;

          //alert(htnlstr);
         
        }
        });
  
  
}
function getAdminResponse(){
  $.ajax({
url:"<?php echo base_url(); ?>instimatch/getAdminResponse",
cache:false,
success:function(htnlstr){
  if(htnlstr != 'false'){
    $("#ChatForsaModal").modal("hide");
    $('#adminResponseModal').modal({ keyboard: false,show: true});
    $('#adminResponsedialog').draggable({handle: "#adminResponseheader"});

    //$("#adminResponseModal").modal("hide");
    $("#adminResponseModal").modal("show");
  $("#adminresponsebody").html(htnlstr);
  $(".admin").click(function(){

    var datavalue = $(this).attr("data-value");
    var dataid = $(this).attr("data-id");
    var data_to_send = 'dataid='+dataid+'&datavalue='+datavalue;
   
    $.ajax({
    url:"<?php echo base_url(); ?>instimatch/updateAdminResponses",
    data:data_to_send,
    method:"post",
    cache:false,
    success:function(htnlstr){
      $("#adminResponseModal").modal("hide");
    }
    });

    
    
  });

  }

    //alert(htnlstr);
}
});
}

$("#eigene").click(function(){

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
  $("#showInterest").click(function(){
    $("#interests").css("display","block");
    $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","none");

  });
  $("#Ansehen").click(function(){
    // $(this).addClass("activebutton");
    // $("#settings_start_page").removeClass("activebutton");
    // $("#view_all_price").removeClass("activebutton");
    // $("#best_price_view").removeClass("activebutton");
    // $("#all_banks_price").removeClass("activebutton");
    // $(".dropbtn").addClass("activebutton");
    // $(".dropbtn").text("Ansehen und downloaden eigene Fälligkeitsliste");
    // $("#eigene").removeClass("activebutton");
    // $("#Ansehen1").removeClass("activebutton");
    // $("#Ansehenund").removeClass("activebutton");
    // $("#Ansehenund1").removeClass("activebutton");
     $("#maturity_table").css("display","block");
     $("#history_maturity_table").css("display","none");
     $("#showInterest").css("display","block");
    // $("#best_price_view1").css("display","none");
    $("#interests").css("display","none");
    // $("#all_interest_table").css("display","none");
    // $("#BANKENAUSWAHL").css("display","none");
    // $("#company_name").css("display","none");
  });
  $("#Ansehenund").click(function(){
    // $(this).addClass("activebutton");
    // $(".dropbtn").addClass("activebutton");
    // $(".dropbtn").text("Ansehen und downloaden in der Vergangenheit getätigter Geschäfte");
    // $("#settings_start_page").removeClass("activebutton");
    // $("#view_all_price").removeClass("activebutton");
    // $("#best_price_view").removeClass("activebutton");
    // $("#all_banks_price").removeClass("activebutton");
    // $("#Ansehenund1").removeClass("activebutton");
    // $("#eigene").removeClass("activebutton");
    // $("#Ansehen").removeClass("activebutton");
    // $("#Ansehen1").removeClass("activebutton");
     $("#maturity_table").css("display","none");
    $("#history_maturity_table").css("display","block");
    $("#showInterest").css("display","block");
    // $("#best_price_view1").css("display","none");
    $("#interests").css("display","none");
    // $("#all_interest_table").css("display","none");
    // $("#BANKENAUSWAHL").css("display","none");
    // $("#company_name").css("display","none");
  });
  tempering12 = '';
  function MaturityTable()
  {
    $.ajax({
      url:"<?php echo base_url(); ?>instimatch/Borrowermaturities",
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
              url:"<?php echo base_url(); ?>instimatch/getmaturityborrowerdescendingsortedData",
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
              url:"<?php echo base_url(); ?>instimatch/getmaturityborrowersortedData",
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
      url:"<?php echo base_url(); ?>instimatch/Borrowerhistorymaturities",
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
              url:"<?php echo base_url(); ?>instimatch/getborrowerdeschistorymaturitysortedData",
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
              url:"<?php echo base_url(); ?>instimatch/getborrowerhistorymaturitysortedData",
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
$(document).ready(function(){
    //Notifications();
    
    setInterval("HistoryMaturityTable()",1000);
    setInterval("MaturityTable()",1000);
    setInterval("getuserpdf()",1000);
    setInterval("Notifications()",1000);
    setInterval("AcceptDealsRequeest()",1000);
    setInterval("DeclineDealsRequeest()",1000);
    setInterval("getAdminResponse()",1000);
    // setInterval("LenderNotification()",1000);
    // setInterval("AcceptDealsRequeest()",1000);
    // setInterval("DeclineDealsRequeest()",1000);
    // setInterval("getAdminResponse()",1000);
    // setInterval("lendersBanks()", 1000);
    // setInterval("getAdminRequestResponse()", 1000);
    // setInterval("getlatestdata()", 1000);
    // setInterval("getAllBanks()", 1000);
  });



</script>