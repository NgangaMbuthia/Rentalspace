  
  @extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="<?=url('/home')?>">Home</a></li>
        <li><a href="<?=url('/backend/message/sent/create')?>"></span>Bulk SMS and Email</a></li>
        <li class="active">Create</li>
</ol>
<ul class="breadcrumb-elements">
              <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-gear position-left"></i>
                  Settings
                  <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="<?=url('/backend/property/statistics')?>"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="<?=url('/account/settings')?>"><i class="icon-gear"></i> All settings</a></li>
                </ul>
              </li>
            </ul>
@stop

@section('content')
@include('backend::contacts.g_header')

<div class="row">

             
              <div class="col-md-12">
               <div class="btn-group">

                <a  class="btn btn-primary" href="<?=url('/backend/message/sent/create')?>">Send SMS/Emails</a>


              <button data-title="Create New Contact Group" class="btn btn-info reject-modal" data-url="<?=url('/backend/group/create')?>">Create New Group</button>

               <a  class="btn btn-primary" href="<?=url('/backend/message/groups/index')?>">View Groups</a>


               <a  class="btn btn-danger " href="<?=url('/backend/message/contact/import')?>"><span class="glyphicon glyphicon-upload"></span>Import Contacts</a>


               <a  class="btn btn-default " href="<?=url('/backend/message/contact/index')?>">View Contacts</a>

               <button  data-title="Add New Contact"    class="btn btn-success reject-modal" data-url="<?=url('/backend/message/contact/create')?>">Add New Contacts</button>
              
              </div>
                
              </div>
              <div style="margin-bottom:5%;">
                
              </div>
              
                
              


   <div class="col-md-8" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Send Bulk SMS and Emails</h6>
                </div>
                
              <div class="panel-body">
                  <div class="col-md-12">
                  <form action="<?=$url;?>" enctype="multipart/form-data" method="post" id="form1">
                  <?=csrf_field();?>
                  
                   <div class="form-group">
                   <label>Send Type</label>
                   <select name="type" class="form-control" required>
                   <option value="">--Select Type---</option>
                   <option>SMS</option>
                   <option>EMail</option>
                   <option value="both">Both Sms And Email</option>
                     
                   </select>
                    </div>

                   

                    

                    
                  <div class="form-group">
                    <label class="text-semibold">Group</label>
                    <div class="row">
                      <?php foreach($groups as $group):?>
                      <div class="col-md-6">
                     
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" value="<?=$group->id?>" class="control-primary my-groups" name="group_id[]">
                             <?=$group->group_name;?>
                          </label>
                        </div>
                     

                        
                      </div>
                       <?php endforeach;?>

                     </div>

                  </div>
                   

                    
                   
                    

                  <div class="form-group">
                  <label>Message Body</label>
                   <textarea rows="10"  name="message" class="form-control" id="message-body"></textarea>
                   <div class="col-md-4" id="counter" style="color:red;">
                    </div>

                     <div class="col-md-4" id="contactcounter" style="color:red;">
                    </div>

                     <div class="col-md-4" id="totalcounter" style="color:red;">
                    </div>

                   
                    
                  </div>
                  <p><br>
                  <div class="form-group">
                 <label class="display-block text-semibold">Action</label>
                  <select name="action" class="form-control" required id="my-action">
                  <option value="">---Select Action---</option>
                  <option value="Send">Send Now</option>
                  <option value="Schedule">Schedule</option>
                    

                  </select>
                    

                  </div>
                  <div class="form-group col-md-6 hidden test2">
                    <label>Date</label>
                    <input type="text" name="date" class="form-control datepicker" id="datepicker" >

                    
                     
                   </div>
                   <div class="form-group col-md-6 hidden test2">
                    <label>Time</label>
                    <input type="text" class="form-control" name="time" id="setTimeExample" >

                    
                     
                   </div>
                   <div class="form-group" style="margin-top:1.5%;">
                   <button class="btn btn-info pull-right hidden" id="isanya"><span class="glyphicon glyphicon-send"></span>&nbsp;Send</button>

                   <div class="alert alert-danger hidden" id="kamwea">
                   You Have Insufficient Funds to Complete this Request.You Active Account Balance is :<h5 id="active-balance"></h5>
                     
                   </div>


                   </div>





                   </form>

                  </div>

              </div>

              </div>
              </div>

               <div class="col-md-4 " >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Quick Statistics</h6>
                </div>
                
              <div class="panel-body">
              <div class="table-responsive">
               <table class="table table-bordered table-striped">
               <tr>
               <td>Balance</td>
               <td>KES: <?=$balance;?></td>
                 
               </tr>

               <tr>
               <td>Total Groups</td>
               <td><?=$groups_count;?></td>
                 
               </tr>

               <tr>
               <td>Total Contacts</td>
               <td><?=$contact_count;?></td>
                 
               </tr>

               <tr>
               <td><?=date('F')?> Spendings</td>
               <td><?=$month_spending;?></td>
                 
               </tr>

               <tr>
               <td><?=date('Y')?> Spendings</td>
               <td><?=$year_total;?></td>
                 
               </tr>
                 

               </table>

               </div>
              </div>
              </div>
              </div>

              @stop
               @push('scripts')
                
                 
               <script src="{{ asset ('/assets/js/ck.js') }}" type="text/javascript"></script>

               <script type="text/javascript" src="{{asset('/js/jquery.timepicker.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('/js/jquery.timepicker.css')}}" />
              
                 
           <script>

    /*          var ckbox = $(".my-groups");
  var chkId = '';
  $('input').on('click', function() {
    var myarray=[];
    if (ckbox.is(':checked')) {
      $(".my-groups:checked").each ( function() {
        chkId = $(this).val() + "";
        myarray.push(chkId);
        chkId = chkId.slice(0, -1);
    });
       alert(myarray);
       //alert ( $(this).val() ); // return all values of checkboxes checked
       //alert(chkId); // return value of checkbox checked
    }     
  });

     */
          


           
            $("#message-body,.my-groups").on('input',function(e){
               var value=$("#message-body").val();

               value=parseInt(value.length)/150;
               value=Math.ceil(value);
                var data=$("#form1").serializeArray();
   
           


              var lengthy="Message Count: "+ value;
                 $("#counter").html(lengthy);
                  var url="<?=url('backend/message/count/process');?>/"+value;
                  var token="<?=csrf_token();?>";
                   $(".isanya").addClass("hidden");

                   $.getJSON(url,{'data':data,'_token':token},function(data){
                   
                    $("#contactcounter").html("Number of Receivers :"+data.total_contacts);
                    $("#totalcounter").html(" Total Cost :"+data.total_cost);
                     $("#active-balance").html(data.current_balance);
                      
                      if(data.action=="Show"){

                        $("#isanya").removeClass("hidden");
                        $("#kamwea").addClass("hidden");
                      }else{
                       
                        $("#kamwea").removeClass("hidden");
                        $("#isanya").addClass("hidden");
                        
                      }
                     

                 });

            });



    $("#my-action").on('change',function(e){
      e.preventDefault();
     
      var them=$(this).val();
     


       if(them=="Schedule"){
        
        $(".test2").removeClass("hidden");
          
         
       }else{

         $(".test2").addClass("hidden");
         
       }
     });
     


           $( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+1M +10D" ,dateFormat:"yy-mm-dd",});

            $('#setTimeExample').timepicker({ 'timeFormat': 'H:i:s' });



           
             
           </script>
           @endpush

