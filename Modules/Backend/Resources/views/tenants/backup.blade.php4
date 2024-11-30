  
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
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Tenant Dashboard</a></li>
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
@include('backend::tenants.t_head')
<div class="row" style="margin-top:2%;">
              
                
              </div>

             <div class="panel panel-white">

             <div class="panel-heading">
              <h6 class="panel-title">List of Tenants</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
               
                
              <div class="panel-body">
              <div class="table-responsive">

              <table id="role-table" class="table table-hover table-striped" style="width:100%;">
              <thead>
              <tr class="info">
              <th>ID</th>
              <th>Name</th>
             
              <th>Space </th>
              <th>Type</th>
              <th>Category</th>
             
              <th>Email</th>
              <th>Telephone</th>
              
               
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($tenants as $model):?>
            <tr>
            <td><?=$i;?></td>
            <td><a href="<?=url('/backend/tenant/view/'.$model->id)?>"><?=$model->user->name;?></a></td>
            <td><a href="<?=url('/backend/space/view/'.$model->space->id)?>"><?=$model->space->title;?></a></td>
            <td><?=$model->space->property->category->name;?></td>
            <td><?=$model->space->property->subcategory->name;?></td>
         
            <td><?=$model->user->email;?></td>
            <td><?=$model->user->profile->telephone;?></td>
            <td>

            <ul class="icons-list">
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="icon-menu9"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right">
                        <?php if(Entrust::hasRole("Provider")):?>
                          <li><a href="<?=url('/backend/tenant/update/'.$model->id)?>"><i class="icon-pencil3"></i> Edit Details</a></li>
                          <li><a href="<?=url('/backend/tenant/view/'.$model->id)?>"><i class="icon-file-eye"></i> Detail View</a></li>
                          <li><a href="<?=url('/backend/space/view/'.$model->space->id)?>"><i class=" icon-library2"></i> Unit Details</a></li>
                          <li><a   style="cursor:pointer;"  title="Create New Tenant Vaccation Notice" class="reject-modal"
                                data-title="Create New Tenants Vaccation Notice"   data-url="<?=url('/backend/notices/create/'.$model->id)?>"
                                 ><i class="icon-clapboard"></i> Create V-Request</a></li>
                          <li><a href="#"><i class="icon-folder-search"></i>View Client Invoices</a></li>
                          <li><a href="#"><i class="icon-stack2"></i>Transaction List</a></li>
                          <li><a href="#"><i class="icon-file-pdf"></i> Export to .pdf</a></li>
                          <li><a href="#"><i class="icon-quill4"></i> More Actions</a></li>

                          <?php endif;?>
                           
                        </ul>
                      </li>
                    </ul>
              
              
              
            </td>
              


            </tr>



            <?php $i++; endforeach;?>



            </tbody>

            </table>



              </div>

              </div>

              </div>

              @stop

