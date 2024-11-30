<?php 
use Modules\Backend\Entities\Property;

$towns=Property::select('town')->distinct()->orderBy('town','desc')->get();
$locations=Property::select('location')->distinct()->orderBy('location','desc')->get();


?>
	<div class="filter filter-gray push-bottom">
		<form method="post" action="<?=url('/application/grid_view')?>">

			<div class="row">
		  
	<div class="col-md-3">
		<div class="form-group">
			<label>Town</label>
			
			<select class="form-control" name="town">
			<option> </option>
				<?php foreach($towns as $town):?>

					<option>{{$town->town}}</option>

				<?php endforeach;?>
			</select>
		</div><!-- /.form-group -->
	</div><!-- /.col-* -->


	<div class="col-md-3">
		<div class="form-group">
			<label>Location</label>
			
			<select class="form-control" name="location">
			<option> </option>
				<?php foreach($locations as $location):?>
					<option>{{$location->location}}</option>

				<?php endforeach;?>
			</select>
		</div><!-- /.form-group -->
	</div><!-- /.col-* -->

	

	<div class="col-md-2">
		<div class="form-group">
			<label>Type</label>
			<select class="form-control" name="type">
			<option> </option>
				<option>For Rent</option>
				<option>For Sale</option>

			</select>
		</div><!-- /.form-group -->
	</div><!-- /.col-* -->
  <input type="hidden" name="_token" value="<?=csrf_token();?>">
	<div class="col-md-2">
		<div class="form-group">
			<label>Price </label>
			<input type="text" class="form-control" name="price">
		</div><!-- /.form-group -->		
	</div><!-- /.col-* -->

	<div class="col-md-2">
		<div class="form-group-btn form-group-btn-placeholder-gap">
			<button type="submit" class="btn btn-primary btn-block">Filter</button>
		</div><!-- /.form-group -->		
	</div><!-- /.col-* -->			
</div><!-- /.row -->
		
		</form>
	</div><!-- /.filter -->