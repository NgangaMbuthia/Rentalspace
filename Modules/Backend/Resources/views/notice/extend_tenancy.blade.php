
  
  <form method="post"  action="<?=@$url?>">
  <div class="row">
     {{csrf_field()}}
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Client Name</label>

                                     <div class="input-group">
                                            <span class="input-group-addon"><i class=" icon-users2"></i></span>
                                     <input type="text" class="form-control" name="name" placeholder="Full Names"  value="{{$model->user->name}}" readonly />
                                  
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                </div>
                               </div>


                               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Unit  <i class="tip fa fa-info" data-tip="Lorem ipsum"></i></label>

                                     <div class="input-group">
                                            <span class="input-group-addon"><i class=" icon-home2"></i></span>
                                     <input type="text" class="form-control" name="name" placeholder="Unit"  value="{{@$model->space->number}}"

                                     readonly="" />
                                  
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                </div>
                               </div>
	

	
</div>
 <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="form-group {{ $errors->has('entry_date') ? ' has-error' : '' }}">
                      <label>Lease Start Date</label>
                                   <div class="input-group">
                                        <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control" name="entry_date" placeholder="Lease Start Date" value="{{$model->entry_date}}"  id="datepicker2"  readonly />
                                        </div>
                                  
                                      @if ($errors->has('entry_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('entry_date') }}</strong>
                                                </span>
                                            @endif

                </div>
           </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group {{ $errors->has('expected_end_date') ? ' has-error' : '' }}">
                                  <label> Lease End Date</label>
                                          <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                            <input type="text" class="form-control" name="expected_end_date" placeholder="Lease End Date" value="{{$model->expected_end_date}}" id="datepicker4" />
                                        </div

                                    
								@if ($errors->has('expected_end_date'))
								<span class="help-block">
								<strong>{{ $errors->first('expected_end_date') }}</strong>
								</span>
								@endif

                           </div>
                        </div>
  </div>
    
<div class="col-sm-12"> 
   <div class="col-sm-12">
   <button class="btn btn-primary">Extend Period</button>
     

   </div>
  </div>

  </form>
  @push('scripts')
    
  <script type="text/javascript">
    

  $( "#datepicker4" ).datepicker();

  </script>
  @endpush

  