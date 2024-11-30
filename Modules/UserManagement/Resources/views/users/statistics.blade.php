@extends('layout.main')

@section('content')

@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">User Module</a></li>
				<li class="active">User List</li>
</ol>
@stop
	
	<div class="row"> 
		<div class="col-lg-12">
		
		<div class="panel panel-info" data-sortable-id="index-1">
        <div class="panel-heading">
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
               
            </div>
            <h4 class="panel-title"><span class="glyphicon glyphicon-stats "></span>&nbsp;&nbsp;&nbsp;System User Registration Statistics For <?=$year;?></h4>
        </div>
       <div class="panel-body">
          
            <div class="row">
            <div class="col-md-2" style="margin-left:35%;">
             <select class="form-control" >
             <?php foreach($years as $myyear):?>
               <option <?php if($year==$myyear):?> selected <?php endif;?> ><?=$myyear;?></option>
              <?php endforeach;?>
             </select>
              

            </div>
              
            </div>
            	
            
            <div class="table-responsive">
			  <table id="user-statistics" class="table table-hover table-bordered" >
                                <thead>
                                    <tr class="info">
                                       <th>Role</th>
                                       <?php foreach($months as $key=>$value):?>
                                        <th><?=$value;?></th>
                                      <?php endforeach;?>
                                        
                                      
                                        <th>Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($roles as $role):?>

                                        <tr>
                                        <td><?=$role->display_name?></td>

                                         <?php foreach($months as $key=>$value):?>
                                        <td><?=$model->getStatistics($role->id,$year,$key)?></td>
                                      <?php endforeach;?>
                                    <td><?=$model->getStatistics($role->id,$year,false)?></td>
                                     </tr>
                                      <?php endforeach;?>

                                </tbody>
                                <tfoot>
                                <th>Total</th>
                                <?php foreach($months as $key=>$value):?>
                                        <th><?=$model->getStatistics(false,$year,$key)?></th>
                                      <?php endforeach;?>
                                      <th><?=$model->getStatistics(false,$year,false)?></th>

                                  
                                </tfoot>
                            </table>
    </div>
	</div>

			
			
		</div>
	</div>

@stop
@push('scripts')
	 <script>
   $(function() {

    $("#user-statistics").dataTable();

   	 	});
	
	</script>
@endpush