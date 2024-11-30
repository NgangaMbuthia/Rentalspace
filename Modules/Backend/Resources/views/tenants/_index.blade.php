	
	@extends('layout.main')
@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">Payment Management</a></li>
				<li class="active">Deposit Payments</li>
</ol>
@stop

@section('content')
            <div class="row">
              <a type="submit" href="<?=url('/backend/make/payments')?>" class="btn bg-purple-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Make New Payment</a>

               <a type="submit" href="<?=url('/backend/view/rent/payments')?>" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-list"></i></b> Rent Payments</a>

                <a type="submit" href="<?=url('/backend/tenants/listView')?>" class="btn bg-primary-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-list"></i></b> Tenant Lists</a>

                <a type="submit" href="<?=url('/backend/space/add')?>" class="btn bg-info-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-list"></i></b> Export To PDF</a>

                  <a type="submit" href="<?=url('/backend/space/add')?>" class="btn bg-success-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-list"></i></b> Export To Excel</a>
                
              </div><p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>Deposit Payments</h6>
                </div>
                
              <div class="panel-body">
              <div class="table-responsive">

              <table id="role-table" class="table table-hover table-striped" style="width:100%;">
              <thead>
              <tr class="success">
              <th>ID</th>
              <th>Tenant</th>
              <th>Email</th>
              <th>Telephone</th>
              <th>Space </th>
               <th>Payment Mode</th>
               <th>Amount Paid</th>
              
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($payments as $model):?>
            <tr>
            <td><?=$i;?></td>
            <td><?=$model->tenant->user->name;?></td>
            <td><?=$model->tenant->user->email;?></td>
            <td><?=$model->tenant->user->profile->telephone;?></td>
            <td><?=$model->tenant->space->title;?></td>
            <td><?=$model->payment_mode;?></td>
            <td><?=$model->credit;?></td>
            <td>
            	
            	
              <?php if(Entrust::hasRole("Provider")):?>
              <a href="<?=url('/backend/property/update/'.$model->id)?>" style="margin-left:10%;"><span class="icon-pencil3"></span></a>
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

