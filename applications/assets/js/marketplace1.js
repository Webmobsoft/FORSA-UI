
var base_url = $("#base_url").val();
 function sort_data()
    {
        //alert("hello");
        setTimeout( function(){ 
    $(".amount_numeric").click();
  }  , 0000 );
       
    }
		function myprofilepopup_hide()
    {
        $("#LanderUserData").hide();
    }
	function close_MyOpenOfferPopup()
	{
	$("#MyOpenOfferPopup").hide();
	}
	function close_LandermyChatDiv()
	{
	$("#LandermyChatDiv").hide();
	}
	function sort_myopen_offer_data()
	{
        setTimeout( function(){ 
    $(".myopen_request_data").click();
  }  , 0000 );  
    }
$(document).ready(function(){
});
/*$(document).ready(function(){   
$("#open_loan").addClass("active_tab");
		$("#close_loan").removeClass("active_tab");
    $.ajax({
          url: base_url + 'marketplace/getrequest',
          type:"post",
          cache:false,
          success:function(result){
                  if(result == 'false')
                  {
					 $("#Getrequest").html("<span><i class='empty_msg'>No records found.</i></span>");
                  }
                  else{
                         $("#old_table").hide();
                         $("#Getrequest").html(result);
                  }
          }
     });

}); */
  function InsertChatMsg(req_id,vendor_id)
    {
        var chat_msg = $("#chat").val();
        var data_to_send = 'req_id=' + req_id + '&vendor_id=' +vendor_id + '&chat_msg=' + chat_msg;
        $.ajax({
             url: base_url + 'marketplace/InsertChatMsg',
            method:"post",
            data:data_to_send,
            cache:false,
            success:function(result)
            {
                if(result == 'fales')
                {
                    $("#chatError").html("Please try again");
                }
                else
                {
                     $("#chat").val('');
                    $(".ChatDivDet").html(result);
                           // $('html, body').animate({
            //scrollTop: target.offset().top
      //  }, 1000);
//                      $("html, body").animate({ scrollTop: $(document).height() }, "slow");
//                        return false;
                   
                }
            }
        });
    }
	/*	function open_loan()
	{
	
	$("#open_loan").addClass("active_tab");
		$("#close_loan").removeClass("active_tab");
		$.ajax({
          url: base_url + 'marketplace/getrequest',
          type:"post",
          cache:false,
          success:function(result){
                  if(result == 'false')
                  {
						$("#Getrequest").html("<span><i class='empty_msg'>No records found.</i></span>");
                  }
                  else{
                         $("#old_table").hide();
                         $("#Getrequest").html(result);
                  }
          }
     });
	}*/
	
	function close_loan()
	{
	/*$(".close_loan_design").css("color","gray");
	$(".close_loan_design").css("text-decoration","underline");
	$(".open_loan_design").css("color","");
	$(".open_loan_design").css("text-decoration","");*/
	$("#close_loan").addClass("active_tab");
		$("#open_loan").removeClass("active_tab");
		$.ajax({
          url: base_url + 'marketplace/get_close_loan_request',
          type:"post",
          cache:false,
          success:function(result){
                  if(result == 'false')
                  {
						$("#Getrequest").html('<span><i class="empty_msg">No records found.</i><span>');
                  }
                  else{
                         $("#old_table").hide();
                         $("#Getrequest").html(result);
                  }
          }
     });
	}
 function chatDetail(id)
    {
	$("#LandermyChatDiv").show();
         $(".req_idds").val('');
        $(".req_idds").val(id);
        $(".ReqChatId").val(id);
        var data_to_send = 'id=' + id;
        $.ajax({
            url: base_url + 'marketplace/chatDetail',
           method:"post",
           data:data_to_send,
           cache:false,
           success:function(result)
            {
                //alert(result);
                 //$(".chatNum_"+id).html('0');
				 $(".chatNum_"+id).hide();
                $(".chatDetail").html(result);
                //$("html, body").animate({ scrollTop: $(document).height() }, "slow");
            }
             
        });
         $.ajax({
            url: base_url + 'marketplace/getChatMsg',
            data:data_to_send,
            type:"post",
            cache:false,
            success:function(result){
                    if(result == 'false')
                    {
                         $(".ChatDivDet").html("Inbox Empty");   
                    }
                    else{
                           $(".ChatDivDet").html(result);
                    }
            }
   });
       setInterval(function(){
    var id = $(".ReqChatId").val();
    var data_to_send1 = 'id=' +id;
    //alert(data_to_send1);
  $.ajax({
        url:base_url + 'marketplace/getChatMsg',
       data:data_to_send1,
       type:"post",
       cache:false,
       success:function(result){
          // alert(result);
               if(result == 'false')
               {
                      $(".ChatDivDet").html("Inbox Empty");
               }
               else{
                      $(".ChatDivDet").html(result);
               }
       }
   });

 }, 10000);
    }
function close_offer()
{
 $(".RequestTr").each(function(){
   //alert("");
     $(this).css("background","");
   $(this).css("color","");
   $(this).find("a").css("color","");
   });
	 $("#Information").css("display","none");
}
function offer_close(){
//alert("hello");
	$("#myoffers").css("display","none");
	$(".myOpenOffer").each(function(){
	$(this).css("color","");
	$(this).css("background","");
	$(this).find("a").css("color","");
	});
}
function close_offerResponsePopup()
{
$("#offerResponsePopup").hide();
}
function close_edit(){
	$("#myoffers").css("display","none");
}

   

function addoffer()
{
alert("add offer");
return false;
$("#offer").prop("disabled",false);
$("#success_msg").show();
 var req_id = $("#request_id_get").val();
 //alert(req_id);
 var data_to_send = $("#offerForm").serialize();
	// alert(data_to_send);
	 $.ajax({
			   url:base_url + 'marketplace/addoffer',
			   data:data_to_send,
			   type:"post",
			   cache:false,
			   success:function(result){
			   
				   if(result == 'false')
				   {
					   $("#error_msg").html("Request not send");
				   }
				   else
				   {
				   location.reload();
					/*$("#offer").prop("disabled",true);
							
                                       $("#open_offers").html(result);
                                      $(".vendor_"+req_id).css('color','white');
                                      $(".vendor_"+req_id).css('background','green');
                                      $("#vendor_"+req_id).find("a").css('color','white');
					   $("#success_msg").html("Request send successfully");
					   $("#success_msg").addClass("alert alert-success");*/
					  
				   }
				   $("html, body").animate({ scrollTop: 0 }, "slow");
			   }
			   });
			  
	 
}
 function withdraw_offer(id)
		{
			var con = confirm("Dou you want to withdraw.Please confirm");
			if (con == true)
			{
				var data = 'id=' + id;
				$.ajax({
					url:base_url + 'marketplace/withdraw_offer',
					method: "post",
					data: data,
					cache: "false",
					success: function(htmlstr)
					{
						location.reload();
					}

				});
			}

		}

function offerInfo(id)
{
//alert("hello");
//$("#MyOpenOfferPopupButton").click();
$("#MyOpenOfferPopup").show();
	var data_to_send = 'id=' + id;
	//alert(data_to_send);
	$.ajax({
			   url:base_url + 'marketplace/offerInfo',
			   data:data_to_send,
			   type:"post",
			   cache:false,
			   success:function(result){
                               
				   if(result == 'false')
				   {
					 
				   }
				   else
				   {
					
					   $("#myoffers").css("display","block");
					    var obj = jQuery.parseJSON(result);
					//var str_amount = obj.amount;
					//var res_money = str_amount.replace(",00000", " Million"); 
					  $("#Request_amount").text(obj.amount_display);
					  $("#offered_amount").text(obj.lender_amount_display);
					 if(obj.duration == '')
					  {
					  $("#offer_term").text(obj.years);
					  $("#offer_maturity").text(obj.maturity);
					  }
					  else
					  {
					  $("#offer_term").text(obj.duration);
					  $("#offer_maturity").text(obj.duration);
					  }
					  $("#offer_interest_sch").text(obj.interest_scheduled);
                      if(obj.status == 'closed')
					  {
						$("#amm_wit").hide();
						$("#offer_status").text(obj.status);
					  }
					  else{
						$("#amm_wit").show();
						$("#ammend").attr("onclick","edit_offer('"+ obj.id +"')");
						$("#withdraw_by_lender").attr("onclick","withdraw_offer('"+ obj.id +"')");
						  $("#offer_status").text(obj.status);
					  }
					  
					  
					   $("#offer_close_date").text(obj.close_date + " " + obj.close_time);
					  $("#offer_valid_date").text(obj.valid_date);
					  $("#openoffer_rate").text(obj.offer_rate);
					 //  $("#offer_rating").text(obj.offer_rating);
					 //alert(obj.response_notes);
					   $("#offer_notes").text(obj.response_notes);
					  
					   
					 
				   }
				   // $("html, body").animate({ scrollTop: $(document).height() }, "slow");
			
			   }
			   });
}


function edit_offer(id)
{
	
	 if(id !='-1')
	 {
		 var data_to_send = 'id=' + id ;
		
		  $.ajax({
			   url:base_url + 'marketplace/addoffer',
			   data:data_to_send,
			   type:"post",
			   cache:false,
			   success:function(result){
				 //  alert(result);
				   if(result == 'false')
				   {
					  // $("#error_msg").html("Requset not send");
				   }
				   else
				   {
					 
					  $("#edit_offer").css("display","none");
					   $("#newform").css("display","block");
					   var obj = jQuery.parseJSON(result);
					   $("#newoffer #request_id").val(obj.id);
					    $("#newoffer #valid_date1").val(obj.valid_date);
							   /********  Geeting already entered value in Offer Details table in popup  ********/
					  var my_amount_string = $('#offered_amount').text().replace(/-?[0-9]*\.?[0-9]+/, '');
        my_amount_string = $.trim(my_amount_string);
        $("#lender_partial_money_text").val(my_amount_string).prop("selected",true);
        var prev_amount = parseFloat($("#offered_amount").text());
		
        $("#lender_partial_amount").val(prev_amount);
					   /******** end Geeting already entered value in Offer Details table in popup  ********/
					    $("#newoffer #offer_rate").val(obj.offer_rate);
						$("#newoffer #response_notes").val(obj.response_notes);
					   
				   }
				 //  $("html, body").animate({ scrollTop: 0 }, "slow");
			   }
			   });
	 }
	 else{
		 var data_to_send = $("#newoffer").serialize();
		 var offer_rate = $("#newoffer #offer_rate").val();
		 var old_date = $("#newoffer #valid_date1").val();
		var valid_date = ($.datepicker.formatDate('yy-mm-dd', new Date(old_date)));
		 var id = $("#newoffer #request_id").val();
		//alert(valid_date);
		  $.ajax({
			   url:base_url + 'marketplace/updateoffer',
			   data:data_to_send,
			   type:"post",
			   cache:false,
			   success:function(result){
				 //  alert(result);
				   if(result == 'false')
				   {
					  $("#new_error_msg").html("offer not updated");
				   }
				   else
				   {
					    $("#oRes_"+ id +" .Rofferrate").text(offer_rate);
					     $("#oRes_"+ id +" .Rvaliddate").text(valid_date);
						 $("#new_success_msg").addClass("alert alert-success");
					  $("#new_success_msg").html("offer updated successfully");
					 				   
				   }
				 //  $("html, body").animate({ scrollTop: 0 }, "slow");
				//location.reload();
			   }
			   });
			   
	 }
	 
	
}