<?php include 'assets/js/bankModals.php';?>
<div class="main-container" id="borrowerDiv" style=<?php if (($_SESSION['user_type'] == "borrower" || $_SESSION['user_type'] == "both") && ($viewtype == 'borrower' || $viewtype == '')) {echo "display: block;";} else {echo "display:none";}?>>
            <!-- Dashboard Page main Content starts-->


            <div class="container-fluid application-panel" id="main-panel">
                <div class="row application-page" >
                    <div class="col-lg-6 col-md-12">
                        <div class="dashboard-right application-sec" id="interests">
                            <div class="in-buttons no-gutters row">
                                <div class="col-sm-4">
                                    <input class="form-control green-btn" type="button" value="<?php echo $this->lang->line('Publish'); ?>" id="publish">
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-4 pr-1">
                                    <input class="form-control green-btn" type="button" id="stop_publish" value="<?php echo $this->lang->line('stop_publish'); ?>" <?php if ($bankinterest['status'] == "N") {echo "disabled";}?>>
                                </div>
                            </div>
                            <div class=" no-gutters row" >
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('TN'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="Tagesgeld"><?php echo !empty($bankinterest['TN']) ? $bankinterest['TN'] : ''; ?></button>
                                </div>
                                 <div class="col-md-4 pr-1 plus-btnn">
                                    <button class="plus-btn" data-id="Tagesgeld">+</button> <span>/</span> <button class="min-btn" data-id="Tagesgeld">-</button>
                                </div>
                                 
                            </div>
                            <div class="in-buttons no-gutters row" >
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('1week'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="1Woche"><?php echo !empty($bankinterest['1week']) ? $bankinterest['1week'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                   <button class="plus-btn" data-id="1Woche">+</button> <span>/</span> <button class="min-btn" data-id="1Woche">-</button>
                                </div>
                                
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('2week'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="2Woche"><?php echo !empty($bankinterest['2weeks']) ? $bankinterest['2weeks'] : ''; ?></button>
                                </div>
                                 <div class="col-md-4 pr-1 plus-btnn">
                                   
                                    <button class="plus-btn" data-id="2Woche">+</button> <span>/</span> <button class="min-btn" data-id="2Woche">-</button>
                              
                                </div>
                                
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('3week'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="3Woche"><?php echo !empty($bankinterest['3weeks']) ? $bankinterest['3weeks'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                   
                                    <button class="plus-btn" data-id="3Woche">+</button> <span>/</span> <button class="min-btn" data-id="3Woche">-</button>
                              
                                </div>
                               
                            </div>
                             <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('1month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="1Monat"><?php echo !empty($bankinterest['1month']) ? $bankinterest['1month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">

                                    <button class="plus-btn" data-id="1Monat">+</button> <span>/</span> <button class="min-btn" data-id="1Monat">-</button>
                              
                                </div>
                               
                            </div>
                             <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('2month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="2Monat"><?php echo !empty($bankinterest['2month']) ? $bankinterest['2month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                   
                                    <button class="plus-btn" data-id="2Monat">+</button> <span>/</span> <button class="min-btn" data-id="2Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('3month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="3Monat"><?php echo !empty($bankinterest['3month']) ? $bankinterest['3month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                             
                                    <button class="plus-btn" data-id="3Monat">+</button> <span>/</span> <button class="min-btn" data-id="3Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('4month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="4Monat"><?php echo !empty($bankinterest['4month']) ? $bankinterest['4month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="4Monat">+</button> <span>/</span> <button class="min-btn" data-id="4Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('5month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="5Monat"><?php echo !empty($bankinterest['5month']) ? $bankinterest['5month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="5Monat">+</button> <span>/</span> <button class="min-btn" data-id="5Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('6month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="6Monat"><?php echo !empty($bankinterest['6month']) ? $bankinterest['6month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                   
                                    <button class="plus-btn" data-id="6Monat">+</button> <span>/</span> <button class="min-btn" data-id="6Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('7month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="7Monat"><?php echo !empty($bankinterest['7month']) ? $bankinterest['7month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="7Monat">+</button> <span>/</span> <button class="min-btn" data-id="7Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                            <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('8month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="8Monat"><?php echo !empty($bankinterest['8month']) ? $bankinterest['8month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="8Monat">+</button> <span>/</span> <button class="min-btn" data-id="8Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                            <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('9month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="9Monat"><?php echo !empty($bankinterest['9month']) ? $bankinterest['9month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="9Monat">+</button> <span>/</span> <button class="min-btn" data-id="9Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                            <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('10month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="10Monat"><?php echo !empty($bankinterest['10month']) ? $bankinterest['10month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="10Monat">+</button> <span>/</span> <button class="min-btn" data-id="10Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                            <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('11month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="11Monat"><?php echo !empty($bankinterest['11month']) ? $bankinterest['11month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="11Monat">+</button> <span>/</span> <button class="min-btn" data-id="11Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                            <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('12month'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 active editable" id="12Monat"><?php echo !empty($bankinterest['12month']) ? $bankinterest['12month'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn" data-id="12Monat">+</button> <span>/</span> <button class="min-btn" data-id="12Monat">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                                 <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('2year'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button id="2Jahre" type="button" class="btn w-100 active editable"><?php echo !empty($bankinterest['2year']) ? $bankinterest['2year'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn"  data-id="2Jahre">+</button> <span>/</span> <button class="min-btn"  data-id="2Jahre">-</button>
                              
                                </div>
                               
                            </div>
                             <div class="in-buttons no-gutters row">
                             <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('3year'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button id="3Jahre" type="button" class="btn w-100 active editable"><?php echo !empty($bankinterest['3year']) ? $bankinterest['3year'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn"  data-id="3Jahre">+</button> <span>/</span> <button class="min-btn"  data-id="3Jahre">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                            <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('4year'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button id="4Jahre" type="button" class="btn w-100 active editable"><?php echo !empty($bankinterest['4year']) ? $bankinterest['4year'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn"  data-id="4Jahre">+</button> <span>/</span> <button class="min-btn"  data-id="4Jahre">-</button>
                              
                                </div>
                               
                            </div>
                            <div class="in-buttons no-gutters row">
                            <div class="col-md-4 pr-1">
                                    <button type="button" class="btn w-100 "><?php echo $this->lang->line('5year'); ?></button>
                                </div>
                                <div class="col-md-4 pr-1">
                                    <button id="5Jahre" type="button" class="btn w-100 active editable"><?php echo !empty($bankinterest['5year']) ? $bankinterest['5year'] : ''; ?></button>
                                </div>
                                <div class="col-md-4 pr-1 plus-btnn">
                                <button class="plus-btn"  data-id="5Jahre">+</button> <span>/</span> <button class="min-btn"  data-id="5Jahre">-</button>
                              
                                </div>
                               
                            </div>
                            <!-- <nav aria-label="Page navigation example" class="pagination-links">
                                <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&lt;</span>
                                    <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                 <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">   &gt;</span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                </ul>
                            </nav> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 application-sec application-right">
                        <div class="in-buttons no-gutters row">
                                <div class="col-lg-3 col-md-6 col-sm-12 pr-2">
                                    <input class="form-control green-btn" type="button" value="<?php if ($bankinterest['status'] == "Y") {echo $this->lang->line('statusLive');} else {echo $this->lang->line('statusOff');}?>" id="status_live">
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-sm-12 pr-2">
                                    <input class="form-control green-btn" type="button" value="Counterparty Configuration" id="" data-toggle="modal" data-target=".counterparty-modal">
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12 pr-2">
                                    <input class="form-control green-btn" type="button" value="Chat with Forsa" id="">
                                </div>
                            </div>
                        
                    </div>
                </div>

                <!-- modal start-->
                                             <!--admin icon modal page tab-->
        <div class="modal fade  counterparty-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                               <div class="modal-dialog" >
                                                 <div class="modal-content">
                                                   <div class="modal-header">
                                                     <h5 class="modal-title" id="exampleModalLongTitle">Access given to Client group Konfiguration</h5>
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                     </button>
                                                   </div>

                                                   <div class="modal-body" id="lendrequestbody">
                                                    <form>
                                                    <div class="row">
                                                        
                                                   <div class="form-group form-md-line-input has-error col-sm-12">
                                <div class=" input-group">
                                    <span class="line">Unternehmen GmbH</span>
                                    <input id="unternehmen_GmbH" type="checkbox" class="cbx used client_group_checkbox"  value="Unternehmen GmbH" <?php if (in_array("Unternehmen GmbH", $acccessclient)) {echo "checked";}?>>
                                    <label for="unternehmen_GmbH" class="lbl notrobot"> 
                                    </label>
                                </div>
                                <div class=" input-group">
                                    <span class="line"> Unternehmen AöR KdöR</span>
                                    <input id="unternehmen" type="checkbox" class="cbx used client_group_checkbox" value="Unternehmen AöR KdöR" <?php if (in_array("Unternehmen AöR KdöR", $acccessclient)) {echo "checked";}?>>
                                    <label for="unternehmen" class="lbl notrobot"> 
                                    </label>
                                </div>
                                <div class=" input-group">
                                    <span class="line">  Kommunen</span>
                                    <input id="kommunen" type="checkbox" class="cbx used client_group_checkbox"  value="Kommunen" <?php if (in_array("Kommunen", $acccessclient)) {echo "checked";}?>>
                                    <label for="kommunen" class="lbl notrobot"> 
                                    </label>
                                </div>
                                
                            </div>

                                                  
                                                </div>

                                            </form>
        
                                                    </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        
                                                      </div>

                                                 </div>
                                               </div>
                                           </div>

                                              <!-- modal setting start page tab-->
        <div class="modal fade bd-example-modal-lg-setting-page dashboard-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                               <div class="modal-dialog modal-lg" >
                                                 <div class="modal-content">
                                                   <div class="modal-header">
                                                     <h5 class="modal-title" id="exampleModalLongTitle">SETTING START PAGE</h5>
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                     </button>
                                                   </div>

                                                   <div class="modal-body" id="lendrequestbody">
                                                    <select class="form-control" id="setting_start_page">
                                                          <option value="">--Select Start Page--</option>
                                                          <option value="viewall">VIEW ALL PRICE</option>
                                                          <option value="bestprice">BEST PRICE VIEW</option>
                                                          <option value="lendersetting" selected="">LENDER  SETTINGS</option>
                                                        </select>
        
                                                       </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        
                                                      </div>

                                                 </div>
                                               </div>
                                           </div>


                                           <!--admin icon modal page tab-->
        <div class="modal fade bd-example-modal-lg-setting-page admin-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                               <div class="modal-dialog modal-lg" >
                                                 <div class="modal-content">
                                                   <div class="modal-header">
                                                     <h5 class="modal-title" id="exampleModalLongTitle">Update Profile</h5>
                                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                       <span aria-hidden="true">&times;</span>
                                                     </button>
                                                   </div>

                                                   <div class="modal-body" id="lendrequestbody">
                                                    <form>
                                                    <div class="row">
                                                        
                                                        <div class="heading col-sm-12"><h4>Edit Details</h4>
                                                        <hr></div>
                                                    
                                                    <div class="col-md-6">
                                                        <label>First Name</label>
                                                        <input type="text" name="first" placeholder="mario" class="form-control" value=""/ id="first_name">
                                                    </div>
                                                    <div class="col-md-6">
                                                         <label>Last Name</label>
                                                        <input type="text" name="last" placeholder="singer" class="form-control" value=""/ id="last_name">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Company Name</label>
                                                        <input type="text" name="company" placeholder="Stadt Singen" class="form-control" value=""/ id="company_name">
                                                    </div>

                                                  
                                                </div>

                                                <div class="row">
                                                   
                                                        <div class="heading col-sm-12"><h4>Change Password</h4><hr></div>
                                                    <div class="col-md-6">
                                                        <label>Old Password</label>
                                                        <input type="password" name=""  class="form-control" value="">
                                                    </div>
                                                    <div class="col-md-6">
                                                         <label>New Password</label>
                                                        <input type="password" name=""  class="form-control" value="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label>Confirm Password</label>
                                                        <input type="password" name=""  class="form-control" value="">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <input type="button" class="btn btn-info btn-lg" id="sendRequest" value="Update">
                                                    </div>
                                              

                                                </div>
                                            </form>
        
                                                    </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        
                                                      </div>

                                                 </div>
                                               </div>
                                           </div>



                                       <!-- modal end-->
            </div>

                                     

            
        </div>
      
<?php include 'assets/js/bankjs.php'?>

