<div class="modal fade" id="eigeneModal" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Eigene Stammdatenverwaltung</h4>
         </div>
         <div id="successmessage"></div>
            <div class="modal-body">
         <div id="eigeneBody">
         </div>
         <div id="eigenepdf">
             
             <div class="showpdf">

             
             </div>
            <div class="">
            <input class="btn btn-default" type="button" value="Datei hochladen" id="eigenepdfBtn">
            </div>
         </div>
         </div>

             <div class="modal-footer">
       <input type="button" class="btn btn-info btn-lg" id="updateuser" value="UPDATE">
       <input type="button" class="btn btn-info btn-lg" id="changepassword" value="CHANGE PASSWORD">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
       </div>
</div>
         
      </div>
   </div>
</div>

<div id="showPdf" class="modal fade" role="dialog">
   <div class="modal-dialog" id="pdfmodaldialog">
      <div class="modal-content">
         <div class="modal-header" id="pdfmodalheader">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Show Pdf</h4>
         </div>
         <div class="modal-body" id="showpdfbody">
         </div>
      </div>
   </div>
</div>


<div id="showborrowerPdf" class="modal fade" role="dialog">
   <div class="modal-dialog" id="pdfmodaldialog">
      <div class="modal-content">
         <div class="modal-header" id="pdfmodalheader">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Show Pdf</h4>
         </div>
         <div class="modal-body" id="showborrowerpdfbody">
         </div>
      </div>
   </div>
</div>
                                                

<div id="LenderPdf" class="modal fade" role="dialog">
   <div class="modal-dialog" id="pdfmodaldialog">
      <div class="modal-content">
         <div class="modal-header" id="pdfmodalheader">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload Pdf</h4>
         </div>
         <div id="pdfmessage"></div>
         <div class="modal-body" id="pdfbody">

            <form method="post" enctype="multipart/form-data" id="pdfupload" action="">

            <div class="col-sm-12" style="margin-bottom:20px;">
            <label class="btn-bs-file btn btn-lg btn-primary upload-pdf-btn">
            Datei hochladen
                <input type="file" name="files" id="input_files" />
            </label>

        </div>

            <!-- <input type="file" name="files" id="input_files"> -->

            <input type="submit" class="btn " id="uploadpdf" value="Upload Pdf">
            
            </form>

         </div>
         <!-- <div class="modal-footer">
     
      </div> -->
      </div>

     
   </div>
</div>

<div id="ChatForsaModal" class="modal fade" role="dialog">
   <div class="modal-dialog" id="chatforsamodaldialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header" id="chatforsamodalheader">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Chat with Forsa</h4>
            <div id="requestmessage1"></div>
            <div id="contactchatforsa"></div>
         </div>
         <div class="modal-body" id="chatforsabody">
         </div>
      </div>
   </div>
</div>
<div id="notificationModal" class="modal fade" role="dialog">
   <div class="modal-dialog" id="notificationmodaldialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header" id="notificationmodalheader">
            <h4 class="modal-title">Lender Request</h4>
            <div id="requestmessage1"></div>
         </div>
         <div class="modal-body" id="notificationbody">
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="myModal1" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo $this->lang->line('setting_start_button'); ?></h4>
         </div>
         <div class="modal-body">
            <select class="form-control" id="setting_start_page">
               <option value=""><?php echo $this->lang->line('Select_Start_Page'); ?></option>
               <option value="viewall" <?php if ($lenderviewsection == 'viewall') {echo "selected";}?>><?php echo $this->lang->line('view_all_price'); ?></option>
               <option value="bestprice" <?php if ($lenderviewsection == 'bestprice') {echo "selected";}?>><?php echo $this->lang->line('best_price_button'); ?></option>
               <option value="allbanks" <?php if ($lenderviewsection == 'allbanks') {echo "selected";}?>><?php echo $this->lang->line('allbanks'); ?></option>
               <!-- <option value="cockpit" <?php if ($lenderviewsection == 'cockpit') {echo "selected";}?>><?php echo $this->lang->line('cockpit'); ?></option> -->

               <!-- <option value="lendersetting" <?php //if ($lenderviewsection == 'lendersetting') {echo "selected";}?>><?php //echo $this->lang->line('lender_setting_button'); ?></option> -->
            </select>
            <!-- <p>Some text in the modal.</p> -->
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<div id="lendrequestmodal" class="modal fade" role="dialog">
   <div class="modal-dialog" id="lendermodaldialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header" id="lendermodalheadr">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo $this->lang->line('send_request');?></h4>
            <div id="requestmessage"></div>
         </div>
         <div class="modal-body" id="lendrequestbody">
            <!-- <p>Some text in the modal.</p> -->
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('close');?></button>
         </div>
      </div>
   </div>
</div>

