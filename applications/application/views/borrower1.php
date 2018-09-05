<?php include 'assets/js/bankModals.php';?>
<div class="Container-fluid" id="borrowerDiv" style=<?php if (($_SESSION['user_type'] == "borrower" || $_SESSION['user_type'] == "both") && ($viewtype == 'borrower' || $viewtype == '')) {echo "display: block;";} else {echo "display:none";}?>>

<div  class="row">



<div class="col-md-12">



<div class="col-lg-4">
<div class="publis-stop">


<input class="top-left-btn" type="button" value="<?php echo $this->lang->line('Publish'); ?>" id="publish" <?php //if($bankinterest['status'] == "Y"){ echo "disabled";}?>>
</div>
<div class="publis-stop">
<input class="top-left-btn pull-right" type="button" id="stop_publish" value="<?php echo $this->lang->line('stop_publish'); ?>" <?php if ($bankinterest['status'] == "N") {echo "disabled";}?>>
</div>
<div class="inner-data">

<div id="" class="" style="width:100%;margin-top:15px;">

<table class=" mytables" id="interests">


		<tbody class="">
		<tr  class="" >

                <td><?php echo $this->lang->line('TN'); ?></td>
                <td id="Tagesgeld" class="editable"><?php echo !empty($bankinterest['TN']) ? $bankinterest['TN'] : ''; ?></td>
                <td><button class="plus-btn" data-id="Tagesgeld">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="Tagesgeld">-</button></td>

                </tr>

				<tr >
				<td> <?php echo $this->lang->line('1week'); ?></td>
          <td id="1Woche" class="editable"><?php echo !empty($bankinterest['1week']) ? $bankinterest['1week'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="1Woche">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="1Woche">-</button></td>
                </tr>

				<tr>
                <td> <?php echo $this->lang->line('2week'); ?></td>
        <td id="2Woche" class="editable"><?php echo !empty($bankinterest['2weeks']) ? $bankinterest['2weeks'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="2Woche">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="2Woche">-</button></td>
                </tr>

				<tr>
                <td> <?php echo $this->lang->line('3week'); ?></td>
                <td id="3Woche" class="editable"><?php echo !empty($bankinterest['3weeks']) ? $bankinterest['3weeks'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="3Woche">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="3Woche">-</button></td>

                </tr>
					<tr  class="" >
                <td><?php echo $this->lang->line('1month'); ?></td>
                <td id="1Monat" class="editable"><?php echo !empty($bankinterest['1month']) ? $bankinterest['1month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="1Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="1Monat">-</button></td>

                </tr>

				<tr >
				<td><?php echo $this->lang->line('2month'); ?></td>
                <td id="2Monat" class="editable"><?php echo !empty($bankinterest['2month']) ? $bankinterest['2month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="2Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="2Monat">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('3month'); ?></td>
                <td id="3Monat" class="editable"><?php echo !empty($bankinterest['3month']) ? $bankinterest['3month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="3Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="3Monat">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('4month'); ?></td>
                <td id="4Monat" class="editable"><?php echo !empty($bankinterest['4month']) ? $bankinterest['4month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="4Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="4Monat">-</button></td>
                </tr>
					<tr  class="" >
                <td><?php echo $this->lang->line('5month'); ?></td>
                <td id="5Monat" class="editable"><?php echo !empty($bankinterest['5month']) ? $bankinterest['5month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="5Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="5Monat">-</button></td>

          </tr>

				<tr >
				<td><?php echo $this->lang->line('6month'); ?></td>
                <td id="6Monat" class="editable"><?php echo !empty($bankinterest['6month']) ? $bankinterest['6month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="6Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="6Monat">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('7month'); ?></td>
                <td id="7Monat" class="editable"><?php echo !empty($bankinterest['7month']) ? $bankinterest['7month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="7Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="7Monat">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('8month'); ?></td>
                <td id="8Monat" class="editable"><?php echo !empty($bankinterest['8month']) ? $bankinterest['8month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="8Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="8Monat">-</button></td>

                </tr>
					<tr  class="" >
                <td><?php echo $this->lang->line('9month'); ?></td>
                <td id="9Monat" class="editable"><?php echo !empty($bankinterest['9month']) ? $bankinterest['9month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="9Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="9Monat">-</button></td>

                </tr>

				<tr>
				<td><?php echo $this->lang->line('10month'); ?></td>
                <td id="10Monat" class="editable"><?php echo !empty($bankinterest['10month']) ? $bankinterest['10month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="10Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="10Monat">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('11month'); ?></td>
                <td id="11Monat" class="editable"><?php echo !empty($bankinterest['11month']) ? $bankinterest['11month'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="11Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="11Monat">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('12month'); ?></td>
                <td id="12Monat" class="editable"><?php echo !empty($bankinterest['12month']) ? $bankinterest['12month'] : ''; ?></td>
                <td><button class="plus-btn" data-id="12Monat">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="12Monat">-</button></td>

                </tr>	<tr  class="" >
                <td><?php echo $this->lang->line('2year'); ?></td>
                <td id="2Jahre" class="editable"><?php echo !empty($bankinterest['2year']) ? $bankinterest['2year'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="2Jahre">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="2Jahre">-</button></td>

                </tr>

				<tr >
				<td><?php echo $this->lang->line('3year'); ?></td>
                <td id="3Jahre" class="editable"><?php echo !empty($bankinterest['3year']) ? $bankinterest['3year'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="3Jahre">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="3Jahre">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('4year'); ?></td>
                <td id="4Jahre" class="editable"><?php echo !empty($bankinterest['4year']) ? $bankinterest['4year'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="4Jahre">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="4Jahre">-</button></td>
                </tr>

				<tr>
                <td><?php echo $this->lang->line('5year'); ?></td>
                <td id="5Jahre" class="editable"><?php echo !empty($bankinterest['5year']) ? $bankinterest['5year'] : ''; ?></td>
                 <td><button class="plus-btn" data-id="5Jahre">+</button><span class="border-slash"> / </span><button class="min-btn" data-id="5Jahre">-</button></td>

                </tr>



				</tbody>
				</table>
				</div>
</form>
</div>
</div>
<div class="col-lg-8 btn-with-new-top">
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">


<input class="top-right-btn" id="status_live" type="button" value="<?php if ($bankinterest['status'] == "Y") {echo $this->lang->line('statusLive');} else {echo $this->lang->line('statusOff');}?>">
</div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<input class="top-right-btn"  id="Country-modal"  type="button" value="<?php echo $this->lang->line('conterparty_configuration'); ?>">
</div>
<!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<input class="top-right-btn" data-toggle="modal" data-target="#history-btn" type="button" value="<?php echo $this->lang->line('history'); ?>">
</div> -->
<!-- <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<input class="top-right-btn" type="button" value="<?php echo $this->lang->line('chat_forsa'); ?>">
</div> -->

<div class="dropdown col-lg-3 col-md-3 col-sm-12 col-xs-12">
         <button id="drop" class="dropbtn">COCKPIT</button>
         <div class="dropdown-content header-drop">
            <button type="button" class="dropcockpit" id="eigene">Eigene Stammdatenverwaltung</button><br>
            <!-- <button type="button" class="dropcockpit" id="settings_start_page">Einstellen Startseite</button><br> -->
            <button type="button" class="dropcockpit" id="Ansehen">Ansehen und downloaden eigene Fälligkeitsliste</button><br>
            <button type="button" class="dropcockpit" id="Ansehenund">Ansehen und downloaden in der Vergangenheit getätigter Geschäfte</button><br>
            <!-- <button type="button" class="dropcockpit" id="ort">Ort wo eigenes Stammblatt hochgeladen wird</button><br> -->
         </div>
      </div>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
<input class="top-right-btn" id="showInterest" style="display:none;" type="button" value="Interest">
</div>
</div>
</div>

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
 <!-- Trigger the modal with a button -->

  <!-- Modal Counterparty-Konfiguration start-->
  <div class="modal fade" id="Counterparty-Konfiguration" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Access given to Client group Konfiguration</h4>
        </div>
        <div class="modal-body">

  <table class="table">
    <thead>
    </thead>
    <tbody>
    <?php
$acccessclient = explode(",", $clientGroup);
?>
     <tr>
       <td><input type="checkbox" value="Unternehmen GmbH" class="client_group_checkbox" <?php if (in_array("Unternehmen GmbH", $acccessclient)) {echo "checked";}?>>&nbsp&nbspUnternehmen GmbH</td>
     </tr>
     <tr>

       <td><input type="checkbox" value="Unternehmen AöR KdöR" class="client_group_checkbox" <?php if (in_array("Unternehmen AöR KdöR", $acccessclient)) {echo "checked";}?>>&nbsp&nbspUnternehmen AöR KdöR</td>
     </tr>
     <tr>

       <td><input type="checkbox" value="Kommunen" class="client_group_checkbox" <?php if (in_array("Kommunen", $acccessclient)) {echo "checked";}?>>&nbsp&nbspKommunen</td>
     </tr>

    </tbody>
  </table>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div> <!-- Modal Counterparty-Konfiguration close -->



    <!-- Modal history start -->
  <div class="modal fade" id="history-btn" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">History</h4>
        </div>
        <div class="modal-body">
<div class="row">
<div class="col-lg-6">
<input class="top-right-btn" type="button" value="EXCEL">
</div>
<div class=" col-lg-3">
<input class="top-right-btn" type="button" value="EXCEL">
</div>
<div class=" col-lg-3">
<input class="top-right-btn" type="button" value="PDF">
</div>
</div>

		   <table class="table">
    <thead>
      <tr>
        <th>Schlusskurs</th>

      </tr>
    </thead>

  </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div> <!-- Modal Counterparty-Konfiguration close -->
</div>

<?php include 'assets/js/bankjs.php'?>