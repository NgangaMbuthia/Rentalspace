  
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
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Properties</a></li>
        <li class="active">Index</li>
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
              <button data-title="Create New Contact Group" class="btn btn-info reject-modal" data-url="<?=url('/backend/group/create')?>">Create New Group</button>

               <a  class="btn btn-primary" href="<?=url('/backend/message/groups/index')?>">View Groups</a>


               <a  class="btn btn-danger " href="<?=url('/backend/message/contact/import')?>"><span class="glyphicon glyphicon-upload"></span>Import Contacts</a>


               <a  class="btn btn-default " href="<?=url('/backend/message/contact/index')?>">View Contacts</a>

               <button  data-title="Add New Contact"    class="btn btn-success reject-modal" data-url="<?=url('/backend/message/contact/create')?>">Add New Contacts</button>
              
              </div>
                
              </div>
              <div style="margin-bottom:5%;">
                
              </div>
              
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Scheduled Emails and SMS</h6>
                </div>
                
              <div class="panel-body">
                  <div class="table-responsive">

                    <table id="contact-table" class="table table-hover table-bordered" style="width:100%;">
                        <thead>
                            <tr class="info">
                            <th>ID</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Day</th>
                            <th>Type</th>
                           
                           
                            </tr>
                      </thead>
                      <tbody>
                     



                      </tbody>

                  </table>



                  </div>

              </div>

              </div>
              </div>

              @stop
               @push('scripts')
           <script>
             $("#contact-table").dataTable({
                processing: true,
                serverSide: true,
                ajax: '<?=url("backend/contacts/fetch_scheduled/items")?>',
                        columns: [
                    {data: 'id', name: 'smessages.id'},
                    {data: 'message', name: 'smessages.message'},
                    {data:'send_date',name:'smessages.send_date'},
                    {data:'send_time',name:'smessages.send_time'},
                    {data:'send_day',name:'smessages.send_day'},
                    {data: 'type', name: 'smessages.type'},
                    
                  
                    
                ],
            });
           </script>
           @endpush

