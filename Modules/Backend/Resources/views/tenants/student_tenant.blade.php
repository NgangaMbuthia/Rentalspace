  
  @extends('layout.main')
@section('breadcrumb')
<ol class="breadcrumb pull-left">
        <li><a href="<?=url('/home')?>">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Tenant Dashboard</a></li>
        <li class="active">index</li>
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
<div class="row">
             
                
              </div><p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>List of Tenants</h6>
                </div>
                
              <div class="panel-body">
              <div class="table-responsive">

              <table id="role-table" class="table table-hover table-striped" style="width:100%;">
              <thead>
              <tr class="success">
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
            <?php $i=1; foreach($students as $model):?>
            <tr>
            <td><?=$i;?></td>
            <td><a href="<?=url('/backend/tenant/view/'.$model->tenant->id)?>"><?=$model->tenant->user->name;?></a></td>
            <td><a href="<?=url('/backend/space/view/'.$model->tenant->space->id)?>"><?=$model->tenant->space->title;?></a></td>
            <td><?=$model->tenant->space->property->category->name;?></td>
            <td><?=$model->tenant->space->property->subcategory->name;?></td>
         
            <td><?=$model->tenant->user->email;?></td>
            <td><?=$model->tenant->user->profile->telephone;?></td>
            <td>
              
              
              <?php if(Entrust::hasRole("Provider")):?>
              <a href="<?=url('/backend/tenant/update/'.$model->id)?>" style="margin-left:10%;"><span class="icon-pencil3"></span></a>
              <a data-href="<?=url('/backend/property/delete/'.$model->id)?>" class="delete-record" style="margin-left:10%;" data-redirect-to="<?=url('/backend/property/index')?>" data-name="Property" ><span class="icon-trash"></span></a>
            <?php endif;?>
            <?php if(Entrust::hasRole("Admin")):?>
               <a href="<?=url('/backend/property/update/'.$model->id)?>" class="btn-xs bg-teal-400">Approve</a>

            <?php endif;?>
            </td>
              


            </tr>



            <?php $i++; endforeach;?>



            </tbody>

            </table>



              </div>

              </div>

              </div>

              @stop

