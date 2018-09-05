<div id="interest_table" class="table-rows col-lg-12" style="width:100%;margin-top:15px; display: none;">
    <div style="margin-top:0px;" class="row">
          <a href="<?php echo base_url() . "?customerid=" . base64_encode($customerid) . "&viewlogout=Y"; ?>" class="view_user_logout">Logout</a>
        </div>
        
    <div id="buttondiv" class="col-lg-12" >
    <button  class="btn btn-info btn-lg" id="view_all_price" style="">INDUVIDUELLE BANKENLISTE</button> 

          <input type="button" class="btn btn-info btn-lg" value="<?php echo $this->lang->line('best_price_button'); ?>" id="best_price_view" style="">
         <button  class="btn btn-info btn-lg" id="all_banks_price" style="display:none;">ALL BANKS</button>
         <div class="dropdown" style="display:none;">
  <button class="dropbtn">COCKPIT</button>
  <div class="dropdown-content header-drop">
   
     <button type="button" class="dropcockpit" id="eigene">Eigene Stammdatenverwaltung</button><br>
     <button type="button" class="dropcockpit" id="settings_start_page">Einstellen Startseite</button><br>
    <button type="button" class="dropcockpit" id="Ansehen">Ansehen und downloaden eigene Fälligkeitsliste</button><br>
    <button type="button" class="dropcockpit" id="Ansehenund">Ansehen und downloaden in der Vergangenheit getätigter Geschäfte</button><br>
    <button type="button" class="dropcockpit" id="ort">Ort wo eigenes Stammblatt hochgeladen wird</button><br>
   
  </div>
</div>    
    </div>
    <div class="container-fluid" id="best_price_view1"  style="display:none;">
<div style="margin-top: 15px;" class="row">
<div class="" id="">
<div id="BanksInterest" class="" style="width:100%;margin-top:15px;" >
<div class="col-lg-4 " id="interestheading">

      <div class="col-md-8 margin-padd-remove">
      <div class="interest" data-value="TN" ><?php echo $this->lang->line('TN'); ?> </div>
      <div class="interest" data-value="1week"><?php echo $this->lang->line('1week'); ?></div>
      <div class="interest" data-value="2weeks"><?php echo $this->lang->line('2week'); ?></div>
      <div class="interest" data-value="3weeks"><?php echo $this->lang->line('3week'); ?></div>
      <div class="interest" data-value="1month"><?php echo $this->lang->line('1month'); ?></div>
      <div class="interest" data-value="2month"><?php echo $this->lang->line('2month'); ?></div>
      <div class="interest" data-value="3month"><?php echo $this->lang->line('3month'); ?></div>
      <div class="interest" data-value="4month"><?php echo $this->lang->line('4month'); ?></div>
      <div class="interest" data-value="5month"><?php echo $this->lang->line('5month'); ?></div>
      <div class="interest" data-value="6month"><?php echo $this->lang->line('6month'); ?></div>
      <div class="interest" data-value="7month"><?php echo $this->lang->line('7month'); ?></div>
      <div class="interest" data-value="8month"><?php echo $this->lang->line('8month'); ?></div>
      <div class="interest" data-value="9month"><?php echo $this->lang->line('9month'); ?></div>
      <div class="interest" data-value="10month"><?php echo $this->lang->line('10month'); ?></div>
      <div class="interest" data-value="11month"><?php echo $this->lang->line('11month'); ?></div>
      <div class="interest" data-value="12month"><?php echo $this->lang->line('12month'); ?></div>
      <div class="interest" data-value="2year"><?php echo $this->lang->line('2year'); ?></div>
      <div class="interest" data-value="3year"><?php echo $this->lang->line('3year'); ?></div>
      <div class="interest" data-value="4year"><?php echo $this->lang->line('4year'); ?></div>
      <div class="interest" data-value="5year"><?php echo $this->lang->line('5year'); ?></div>
      </div>
      <div class="col-md-4 margin-padd-remove" id="interestdata"></div>
 </div>
      <div style="margin-top:0px;" class="col-lg-8 " id="lenderslatestBanks"></div>
</div>
</div>
</div>
</div>
    <table class="mytables brrow-tabs" id="bank_Interest"></table>
        <div style="margin-top:15px;" class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
          <a href="<?php echo base_url() . "?customersid=" . base64_encode($customerid) . "&shows=Y"; ?>" class="become-trading"><?php echo $this->lang->line('become_trading_client'); ?></a>
        </div>
        </div>