<form role="form" action="<?=$url?>" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Type</label>
                                    <select name="type" class="form-control" required>
                                    <option value="">--Select Type--</option>
                                    <option <?php  if($model->type=="Vehicle"):?> selected   <?php endif;?>>Vehicle</option>
                                    <option
                                    <?php  if($model->type=="Electronics"):?> selected   <?php endif;?>

                                    >Electronics</option>
                                    <option
                                    <?php  if($model->type=="Pet"):?> selected   <?php endif;?>

                                    >Pet</option>
                                    <option
                                      <?php  if($model->type=="Others"):?> selected   <?php endif;?>
                                    >Others</option>

                                    </select>

                                     @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                            
                            
                        </div>


                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="name" value="<?=$model->name?>">
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('number') ? ' has-error' : '' }}">
                                    <label>Item Number/Serial Number</label>
                                    <input type="text" class="form-control" name="number" value="<?=$model->number?>">
                                     @if ($errors->has('number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                            
                        </div>
                      
                       <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    

                     <button type="submit"  class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> <?=(isset($label))? $label:'Create'?></button>
                        </div>
                    </form>


