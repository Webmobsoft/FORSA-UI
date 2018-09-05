<div id="requestresponseModal" class="modal fade" role="dialog">
  <div class="modal-dialog" id="requestresponsedialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="requestresponseheader">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Request Response</h4>
        <!-- <div id="requestmessage1"></div> -->
      </div>
      <div class="modal-body" id="requestresponsebody">
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->

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

<!-- <div id="ChatForsaModal" class="modal fade" role="dialog">
  <div class="modal-dialog" id="chatforsamodaldialog">

   
    <div class="modal-content">
      <div class="modal-header" id="chatforsamodalheader">
       
        <h4 class="modal-title">Chat with Forsa</h4>
        <div id="requestmessage1"></div>
        <div id="contactchatforsa"></div>
      </div>
      <div class="modal-body" id="chatforsabody">
        
      </div>

    </div>
  </div>
</div> -->
<div id="notificationModal" class="modal fade" role="dialog">
  <div class="modal-dialog" id="notificationmodaldialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="notificationmodalheader">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Lender Request</h4>
        <div id="requestmessage1"></div>
      </div>
      <div class="modal-body" id="notificationbody">
        
      </div>
      
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>

<div id="adminResponseModal" class="modal fade" role="dialog">
  <div class="modal-dialog" id="adminResponsedialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="adminResponseheader">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Lender Request</h4>
        
      </div>
      <div class="modal-body" id="adminresponsebody">
        
      </div>
      
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>

<div id="adminRequestResponse" class="modal fade" role="dialog">
  <div class="modal-dialog" id="adminrequestdialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" id="adminrequestheader">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        <h4 class="modal-title">Request</h4>
        
      </div>
      <div class="modal-body" id="adminrequestresponsebody">
        
      </div>
      
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>