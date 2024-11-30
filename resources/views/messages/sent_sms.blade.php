	
@extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="<?=url('/backend/space/listView')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Spaces</span></a>
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/backend/property/index')?>">List Properties</a></li>
        <li class="active">Index</li>
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

              
 <div class="col-md-12">
             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>SMS send fro System</h6>
                </div>
                
              <div class="panel-body">
              <div class="table-responsive">

              <table id="property-table" class="table table-hover table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>ID</th>
              <th>Message</th>
              <th>Status</th>
              <th>Number</th>
              <th>Sms Date</th>
              
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
             $("#property-table").dataTable({
        processing: true,
        serverSide: true,
        ajax: '<?=url("messages/sent/fetch_all")?>',
                columns: [
            {data: 'id', name: 'messages.id'},
            {data: 'message', name: 'message'},
            {data: 'delvery_status', name: 'delvery_status'},
            {data:'phone',name:'phone'},
            {data:'created_at',name:'created_at'},
        ],
    });
           </script>
           @endpush

