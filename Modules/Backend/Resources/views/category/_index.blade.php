	@extends('layout.main')
@section('breadcrumb')
<ol class="breadcrumb pull-left">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
				<li><a href="<?=url('/backend/category/management/index')?>">Category Management</a></li>
				<li class="active">Index</li>
</ol>
@stop

@section('content')
<div class="row">
              <a type="submit" href="<?=url('/backend/category/management/s_create')?>" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Create Sub Category</a>
                
              </div><p></p>

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title"><i class="glyphicon glyphicon-list position-left"></i>Property SubCategories</h6>
                </div>
                
              <div class="panel-body">
              <div class="table-responsive">
              <table class="table table-bordered table-hover" id="subcategory-table">
              <thead>
              <tr class="success">
              <th>#</th>
              <th>Category</th>
              <th>Name</th>
              <th>Date Created</th>
              <th>Action</th>
              </tr>
              </thead>
              <tbody>
            <?php $i=1; foreach($categories as $category):?>
            <tr>
            <td><?=$i;?></td>
            <td><?=$category->category->name;?></td>
            <td><?=$category->name;?></td>
            <td><?=date('dS-M-Y',strtotime($category->created_at));?></td>
            <td>
            <a href="<?=url('/backend/category/management/s_update/'.$category->id)?>" ><span class="glyphicon glyphicon-pencil"></span></a>

            <a  style="margin-left:15%;" href="<?=url('/backend/category/management/update/'.$category->id)?>" ><span class="glyphicon glyphicon-eye-open"></span></a>


             <a  style="margin-left:15%;" href="<?=url('/backend/category/management/update/'.$category->id)?>" ><span class="glyphicon glyphicon-trash"></span></a>
              

            </td>
              

            </tr>


            <?php $i++;endforeach;?>
                
              </tbody>
                

                </table>



              </div>

              </div>

              </div>

              @stop