	
	@extends('layout.main')
@section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Supplies</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Quatation</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Supplier Module</a></li>
        <li><a href="<?=url('/backend/v-notice/index')?>"></span>Supplier list</a></li>
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
@include('supplier::suppliers.s_head')
<p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Registed Suppliers List</h6>

                  


                </div>
                
              <div class="panel-body">
               <div class="row">

                 <div class="col-md-12">
               <div class="btn-group">
              <a type="button" class="btn btn-info" target="_blank" href="<?=url('/supplier/supplier/export')?>">Export To PDF</a>
              <a type="button" class="btn btn-success"  href="<?=url('/supplier/supplier/list/xls')?>"  >Export To Excel</a>
              <a href="<?=url('/supplier/supplier/list/csv')?>" type="button" class="btn btn-danger">Export To CSV</a>
              </div>
                
              </div>
              </div>
              <div class="row">
              <p>
              <div class="table-responsive">

              <table id="supplier-table" class="table table-hover table-bordered" style="width:100%;">
              <thead>
              <tr class="info">
              <th>ID</th>
              <th>Name</th>
              <th>Number </th>
              <th>Telephone </th>
              <th>email</th>
             
              <th>City</th>
              <th>Commodity</th>
               <th>Action</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>

            </table>
            </div>
                

              </div>



              </div>

              @stop

               @push('scripts')
           <script>
             $("#supplier-table").dataTable({
              processing: true,
              serverSide: true,
              ajax: '<?=url("supplier/supplier/fetch_list")?>',
                      columns: [
                  {data: 'id', name: 'suppliers.id'},
                  {data: 'legal_name', name: 'legal_name'},
                  {data:'reg_number',name:'reg_number'},
                  {data:'telephone',name:'telephone'},
                  {data: 'email', name: 'email'},
                  {data:'city',name:'city'},
                  
                 
                  {data:'core_commodity',name:'core_commodity'},
                  {data: 'action', name: 'action',searchable:false},
              ],
             });
           </script>
           @endpush


