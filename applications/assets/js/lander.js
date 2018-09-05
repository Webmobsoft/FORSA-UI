
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
            $("#edit_offer").show();
            $("#newform").hide();
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

    function InsertChatMsg(req_id,vendor_id) {
        var chat_msg = $("#chat").val();
        var data_to_send = 'req_id=' + req_id + '&vendor_id=' +vendor_id + '&chat_msg=' + chat_msg;
        $.ajax({
            url: base_url + 'lander/InsertChatMsg',
            method:"post",
            data: data_to_send,
            cache:false,
            success:function(result) {
                $(".ChatDivDet").animate({ scrollTop: ($(".ChatDivDet tr").height() * $(".ChatDivDet tr").length) }, "slow");
                if(result == 'fales') {
                    $("#chatError").html("Please try again");
                }
                else {
                    $("#chat").val('');
                    $(".ChatDivDet").html(result);                   
                }
            }
        });
    }
	/*function market_place()
	{
		$.ajax({
          url: base_url + 'lander/market_place',
          type:"post",
          cache:false,
          success:function(result){
                  if(result == 'false')
                  {

                  }
                  else{
                         $("#old_table").hide();
                         $("#Getrequest").html(result);
                  }
          }
     });
	}*/
	
 function chatDetail(id)
    {
//	$("#LandermyChatDiv").modal('show');
         $(".req_idds").val('');
        $(".req_idds").val(id);
        $(".ReqChatId").val(id);
        var data_to_send = 'id=' + id;
        $.ajax({
            url: base_url + 'lander/chatDetail',
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
            url: base_url + 'lander/getChatMsg',
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
        url:base_url + 'lander/getChatMsg',
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
function close_edit(){
	$("#myoffers").css("display","none");
}
function close_offerResponsePopup()
{
//alert("le");
$("#offerResponsePopup").hide();
}
   function information(id)
   {
     
  // $("#responsepopup").click();
   $("#offerResponsePopup").show();
   $("#offer").prop("disabled",false);
   $("#success_msg").hide();
   $(".offer_rate").val("");
   $("#valid_date").val("");
   $("#notes").val("");
   $(".RequestTr").each(function(){
   //alert("");
     $(this).css("background","");
   $(this).css("color","");
   $(this).find("a").css("color","");
   });
   $(".RequestTrCss_" + id).css("background","#5870ab");
   $(".RequestTrCss_" + id).css("color","white");
   $(".RequestTrCss_" + id + " a").css("color","white");
	   var data_to_send = 'id=' + id;
	 
	 $.ajax({
			   url:base_url + 'lander/requestInfo',
			   data:data_to_send,
			   type:"post",
			   cache:false,
			   success:function(result){
				   if(result == 'false')
				   {
					   
				   }
				   else{
				
					  $("#Information").css("display","block");
					   var obj = jQuery.parseJSON(result);
					  var ID = obj.id;
					  $("#offerForm #request_id").val(ID);
					  $("#request_id_get").val(obj.id);
					  var req_name = obj.req_name;
					  $("#req_name").text(obj.req_name);
					  //var str = obj.amount;
						//var res = str.replace(",00000", " Million"); 
					  $("#amount").text(obj.amount_display);
					  /*To show amount selected  *********/
					   var my_amount_string = $('#amount').text().replace(/-?[0-9]*\.?[0-9]+/, '');
        my_amount_string = $.trim(my_amount_string);
		//alert(my_amount_string);
        $("#partial_money_text").val(my_amount_string).prop("selected",true);
        var prev_amount = parseFloat($("#amount").text());
		//alert(prev_amount);
        $("#partial_amount").val(prev_amount);
					  /*End To show amount selected  *********/
					  if(obj.duration == '')
					  {
					  $("#term").text(obj.term);
					  $("#maturity").text(obj.maturity);
					  }
					  else
					  {
					  $("#term").text(obj.term);
					  $("#maturity").text(obj.duration);
					  }
					  
					  $("#interest_sch").text(obj.interest_scheduled);
					  $("#status").text(obj.status);
					  //alert(obj.close_time);
					   $("#close_date").text(obj.close_date + " " + obj.close_time);
					  
				   }
			   }
	 });
	 
			   
   }

function addoffer()
{
//alert("add offer");
$("#offer").prop("disabled",false);
$("#success_msg").show();
 var req_id = $("#request_id_get").val();
 //alert(req_id);
 var data_to_send = $("#offerForm").serialize();
	 //alert(data_to_send);
	 //return false;
	 $.ajax({
			   url:base_url + 'lander/addoffer',
			   data:data_to_send,
			   type:"post",
			   cache:false,
			   success:function(result){
			   //alert("add offer");
				   if(result == 'false')
				   {
					   $("#error_msg").html("Request not send");
				   }
				   else
				   {
				   location.reload();
					/*$("#offer").prop("disabled",true);
							$(".deletediv").css("float","left");
                                       $("#open_offers").html(result);
                                      $(".vendor_"+req_id).css('color','#5870ab');
									  $("#vendor_"+req_id).find("a").css('color','white');
									  $("#vendor_"+req_id).find("a").attr('disabled',true);
					   $("#success_msg").html("Request send successfully");
					   $("#success_msg").addClass("alert alert-success");*/
					  
				   }
				   $("html, body").animate({ scrollTop: 0 }, "slow");
			   }
			   });
			  
	 
}


function offerInfo(id) {
    $("#archiveOffer").modal('hide');
    $("#MyOpenOfferPopup").modal('show');
    var data_to_send = 'id=' + id;
    $.ajax({
        url:base_url + 'lander/offerInfo',
        data:data_to_send,
        type:"post",
        cache:false,
        success:function(result){
           
            if(result == 'false') {

            }
            else {
                $("#myoffers").css("display","block");
                var obj = jQuery.parseJSON(result);
                var curr = obj.currency;
                $("#offered_currency").text(curr);
                $("#labelForEdidCurr").text(curr);
                var str_amount = obj.amount;
                $("#Request_amount").text(obj.amount_display);
                $("#offered_amount").text(obj.lender_amount_display);
                if(obj.duration == '') {
                    $("#offer_term").text(obj.term);
                    $("#offer_maturity").text(obj.maturity);
                }
                else {
                    $("#offer_term").text(obj.term);
                    $("#offer_maturity").text(obj.duration);
                }
                $("#offer_interest_sch").text(obj.interest_scheduled);
                if(obj.status == 'closed' || obj.amendStatus == 1) {
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
                $("#offer_notes").text(obj.response_notes); 
            }
       }
    });
}


function edit_offer(id)
{
   
	
	 if(id !='-1')
	 {
		 var data_to_send = 'id=' + id ;
		
		  $.ajax({
			   url:base_url + 'lander/addoffer',
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
                                           var curr = $("#offered_currency").text();
                                           //alert(curr);
                                           $("#labelForEdidCurr").html(curr);
					   /********  Geeting already entered value in Offer Details table in popup  ********/
					  var my_amount_string = $('#offered_amount').text().replace(/-?[0-9]*\.?[0-9]+/, '');
        my_amount_string = $.trim(my_amount_string);
        $("#lender_partial_money_text").val(my_amount_string).prop("selected",true);
        var prev_amount = parseFloat($("#offered_amount").text());
		
        $("#lender_partial_amount").val(prev_amount);
					   /******** end Geeting already entered value in Offer Details table in popup  ********/
					   $("#newoffer #request_id").val(obj.id);
					    $("#newoffer #valid_date1").val(obj.valid_date);
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
		// alert(data_to_send);
		//alert(valid_date);
		  $.ajax({
			   url:base_url + 'lander/updateoffer',
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
                                       location.reload();
					    $("#oRes_"+ id +" .Rofferrate").text(offer_rate);
					     $("#oRes_"+ id +" .Rvaliddate").text(valid_date);
					  $("#new_success_msg").addClass("alert alert-success");
					  $("#new_success_msg").html("offer updated successfully");
					 				   
				   }
				 //  $("html, body").animate({ scrollTop: 0 }, "slow");
				
			   }
			   });
			   
	 }
	 
	
}