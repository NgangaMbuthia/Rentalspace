<form role="form" action="<?=$url?>" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?=$model->name;?>">
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('identification') ? ' has-error' : '' }}">
                                    <label>Identification Document</label>
                                    <select name="identification" class="form-control" required>
                                    <option value="">--Select Identification--</option>
                                    <option <?php if($model->identification=="National ID"): ?>   selected <?php endif; ?>       value="National ID">National ID</option>
                                    <option
                                    <?php if($model->identification=="Birth Certificate"): ?>  selected <?php endif; ?> 
                                   value="Birth Certificate">Birth Certificate</option>
                                    <option 
                                    <?php if($model->identification=="Passport"): ?>  selected <?php endif; ?> 
                                    value="Passport">Passport Number</option>
                                    <option
                                    <?php if($model->identification=="Allien Card"): ?>  selected <?php endif; ?> 
                                     value="Allien Card">Allien Card</option>

                                        

                                    </select>
                                     @if ($errors->has('identification'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('identification') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                            
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('number') ? ' has-error' : '' }}">
                                    <label>Document Number</label>
                                    <input type="text" class="form-control" name="number" value="<?=$model->number?>">
                                     @if ($errors->has('number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('age') ? ' has-error' : '' }}">
                                    <label>Occupant Age</label>
                                    <select name="age" class="form-control" required>
                                    <option value="">--Select Age--</option>
                                    <?php for($i=1;$i<=100;$i++):?>


                                    <option  <?php if($model->age==$i): ?> selected  <?php endif; ?>   value="<?=$i;?>"><?=$i;?></option>
                                    <?php endfor;?>

                                        

                                    </select>
                                     @if ($errors->has('identification'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('age') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                            
                        </div>
                      
                       <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    

                     <button type="submit"  class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> <?=(isset($label))? $label:'Create'?> Record</button>
                        </div>
                    </form>


