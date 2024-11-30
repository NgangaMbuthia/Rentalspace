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
                                    <label>Relationship </label>
                                    <select name="relationship" class="form-control" required>
                                    <option value="">--Select Relationship--</option>
                                    <option <?php if(preg_match("/brother/i", $model->Relationship)): ?>   selected <?php endif; ?>       value="Brother">Brother</option>
                                    <option
                                    <?php if($model->Relationship=="Parent"): ?>  selected <?php endif; ?> 
                                   value="Parent">Parent</option>
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
                                    <label>Telephone Number</label>
                                    <input type="text" class="form-control" name="phone" value="<?=$model->phone?>">
                                     @if ($errors->has('number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label>Email Address</label>
                                    <input type="email" class="form-control" name="email" value="<?=$model->email?>">
                                    
                                     @if ($errors->has('email'))
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


