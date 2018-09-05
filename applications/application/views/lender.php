<style>
   .activebutton{
   background-color:green !important;
   }
</style>
<div class="container-fluid">
   <div class="row">
<?php include 'assets/js/lenderModals.php';?>
<div id="lenderDiv"  style=<?php if ($_SESSION['user_type'] == "lender" || $viewtype == 'lender') {echo "display: block;";} else {echo "display:none";}?>>
   <div id="buttondiv" class="col-lg-12" style=<?php if ($lenderviewsection == '' || $lenderviewsection == 'viewall' || $lenderviewsection == 'lendersetting' || $lenderviewsection == 'bestprice' || $lenderviewsection == 'allbanks' || $lenderviewsection == 'cockpit' ) {echo "display:block";} else {echo "display:none";}?>>
      <button  class="btn btn-info btn-lg" id="view_all_price">INDUVIDUELLE BANKENLISTE</button> 
      <input type="button" class="btn btn-info btn-lg" value="<?php echo $this->lang->line('best_price_button'); ?>" id="best_price_view" >
      <!-- <button  class="btn btn-info btn-lg" id="view_all_price" style="<?php if (($settledlenderview != "viewa")) {echo "display: block;";} else {echo "display:none;";}?>" ><?php echo $this->lang->line('view_all_price'); ?></button> -->
      <button  class="btn btn-info btn-lg" id="all_banks_price">ALL BANKS</button>
      <div class="dropdown">
         <button class="dropbtn">COCKPIT</button>
         <div class="dropdown-content header-drop">
            <button type="button" class="dropcockpit" id="eigene">Eigene Stammdatenverwaltung</button><br>
            <button type="button" class="dropcockpit" id="settings_start_page">Einstellen Startseite</button><br>
            <button type="button" class="dropcockpit" id="Ansehen">Ansehen und downloaden eigene Fälligkeitsliste</button><br>
            <button type="button" class="dropcockpit" id="Ansehenund">Ansehen und downloaden in der Vergangenheit getätigter Geschäfte</button><br>
            <!-- <button type="button" class="dropcockpit" id="ort">Ort wo eigenes Stammblatt hochgeladen wird</button><br> -->
         </div>
      </div>
      <button class="btn btn-info btn-lg"  id="Ansehen1">eigene Fälligkeitsliste</button>
         <button  class="btn btn-info btn-lg"  id="Ansehenund1">Vergangenheit getätigter Geschäfte</button>
   </div>
   <div id="companies">
   <button  class="btn btn-info btn-lg" id="BANKENAUSWAHL" style="display:none;">BANKENAUSWAHL</button>
   <div id="company_name" class="table-rows col-lg-12" style=<?php if (($lenderviewsection == "lendersetting" && $settledlenderview == "") || ($settledlenderview == "lend")) {echo "display:block;";} else {echo "display:none;";}?>>
      <table class="" id="">
         <thead>
            <tr>
               <th>Bank</th>
            </tr>
         </thead>
         <tbody class="company-name-data">
            <?php
               $offborrower = explode(',', $offBorrowers);
               foreach ($lendersBank as $lenders) {
                $userId[] = $lenders['userId'];
               }
               $onBorrowers = explode(',', $onborrowers);
               if (!empty($onBorrowers) && !empty($userId)) {
                $allactiveBorrowers = array_merge($userId, $onBorrowers);
                $alluniqueactiveBorrowers = array_unique($allactiveBorrowers);
               } else {
                $alluniqueactiveBorrowers = array();
               }
               foreach ($allBanks as $bank) {
                ?>
            <tr class="" data-value="">
               <td><label class="container-box"><?php echo $bank['company_name']; ?>
                  <input type="checkbox" class="lendercheck" data-value="<?php echo $bank['userId']; ?>"  data-id="<?php echo $bank['userId']; ?>" name="<?php echo $bank['company_name']; ?>"  <?php if (!in_array($bank['userId'], $offborrower) && in_array($bank['userId'], $alluniqueactiveBorrowers)) {echo "checked=checked";}?>>
                  <span class="checkmark" ></span>
                  </label>
               </td>
            </tr>
            <?php }?>
         </tbody>
      </table>
   </div>
   </div>
   <div id="interest_table" class="table-rows col-lg-12" style=<?php if (($lenderviewsection == '' && $settledlenderview == '') || ($lenderviewsection == 'viewall' && $settledlenderview == '') || ($lenderviewsection == 'viewall' && $settledlenderview == 'viewa') || ($lenderviewsection == '' && $settledlenderview == 'viewa') || ($lenderviewsection != 'viewall' && $settledlenderview == 'viewa')) {echo "display:block";} else {echo "display:none";}?>>
      <input type="button" id="EINSTELLUNGEN" value="EINSTELLUNGEN" class="btn btn-info btn-lg">
      <table class="mytables" id="bank_Interest">
      </table>
      <table class="mytables" id="bank_Interest1">
      </table>
   </div>
   <div id="maturity_table" class="table-rows col-lg-12" style="display:none">
      <input type="button" id="export_pdf" value="Export PDF" class="btn btn-info btn-lg">
      <input type="button" id="export_excel" value="Export Excel" class="btn btn-info btn-lg">
      <table id="maturityTableData" class="mytables" >
      </table>
   </div>
   <div id="history_maturity_table" class="table-rows col-lg-12" style="display:none">
      <input type="button" id="historyexport_pdf" value="Export PDF" class="btn btn-info btn-lg">
      <input type="button" id="historyexport_excel" value="Export Excel" class="btn btn-info btn-lg">
      <table id="historymaturityTableData" class="mytables" >
      </table>
   </div>
   <div style="display:none;">
   </div>
   <div id="all_interest_table" class="table-rows col-lg-12" style=<?php if (($lenderviewsection != "allBankList" && $settledlenderview == "allBankList")) {echo "display:block;";} else {echo "display:none;";}?>>
      <table class="mytables" id="all_banks_interest">
      </table>
   </div>
   <div class="container-fluid" id="best_price_view1"  style=<?php if (($lenderviewsection == "" && $settledlenderview == "best") || ($lenderviewsection == "bestprice" && $settledlenderview == "") || ($lenderviewsection == "bestprice" && $settledlenderview == "best") || ($lenderviewsection != "bestprice" && $settledlenderview == "best")) {echo "display:block;";} else {echo "display:none;";}?>>
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
               <div style="margin-top:0px;" class="col-lg-8 " id="lenderslatestBanks">
               </div>
            </div>
         </div>
      </div>
      <div style="margin-right: 0;margin-left: 0;" class="row"></div>
   </div>
</div>
</div>
</div>
<?php include 'assets/js/lenderjs.php';?>

