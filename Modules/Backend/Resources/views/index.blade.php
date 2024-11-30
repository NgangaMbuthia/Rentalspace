	
	@extends('layout.main')
@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="javascript:;">User Management</a></li>
				<li class="active">Role List</li>
</ol>
@stop

@section('content')
<div class="row">
              <a type="submit" href="<?=url('/admin/role/addrole')?>" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Create New Role</a>
                
              </div><p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>System User Groups/Roles</h6>
                </div>
                
              <div class="panel-body">
              <div class="table-responsive">



              </div>

              </div>

              </div>

              @stop
