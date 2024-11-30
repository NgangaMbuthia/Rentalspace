<?php 
use App\Helpers\Helper;
?>

@extends('layout.wizard')
<style type="text/css">
    .select2{
        width:100%;
    }
</style>




@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
                <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Tenant Dashboard</a></li>
                <li class="active">Index</li>
</ol>
<style type="text/css">
    .select2{
        width:100%;
    }
</style>

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
<div class="row" style="margin-top:2%;">
              
                
              </div>

             <div class="panel panel-white">

             <div class="panel-heading">
              <h6 class="panel-title">Create Tenant Details</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
               
                
              <div class="panel-body">
              
              

                <div class="row">

                  <form   action="{{url()->current()}}" method="post">
                     <?=csrf_field()?>

                   <div class="col-sm-12" >
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Property</label>
                                    <select class="form-control" name="property_id" id="property">
                                    <option value="">--Select Property--</option>
                                    <?php foreach($properties as $property):?>
                                     <option value="<?=$property->id?>">{{$property->title}}-- {{$property->location}}</option>

                                    <?php endforeach;?>
                                        

                                    </select>
                                  
                                     @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label>Space Number/Name</label>
                                    <select class="form-control" name="space_id"  id="spaces">
                                     <option value="">----Select Space Number/Name ----</option>
                                        

                                    </select>
                                  
                                     @if ($errors->has('space_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('space_id') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                                </div>

                                <div class="col-sm-12">
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Full Name</label>
                                     <input type="text" class="form-control" name="name" placeholder="Full Names"  value="{{old('name')}}"/>
                                  
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group {{ $errors->has('id_number') ? ' has-error' : '' }}">
                                    <label>ID Number</label>
                                     <input type="text" class="form-control" name="id_number" placeholder="ID Number"  value="{{old('id_number')}}" />
                                  
                                     @if ($errors->has('id_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('id_number') }}</strong>
                                                </span>
                                            @endif

                                </div>
                               </div>
                                </div>
                                <div class="col-sm-12">
                                     <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Phone Number (Start with Country Code eg +254):</label>
                                            <input type="text" name="phone" class="form-control" placeholder="Mobile Number">

                                             @if ($errors->has('phone'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Monthly Rent</label>
                                            <input type="text" name="rent" class="form-control" placeholder="Rent">

                                             @if ($errors->has('rent'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('rent') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                              </div>


                                <div class="col-sm-12">
                                     <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label>Deposit</label>
                                            <input type="text" name="deposit" class="form-control" placeholder="Deposit Amount">

                                             @if ($errors->has('deposit'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('deposit') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label>Water Amount</label>
                                            <input type="text" name="water" class="form-control" value="0" placeholder="Water">

                                             @if ($errors->has('water'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('water') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label>Gabbage Amount</label>
                                            <input type="text" name="gabbage" class="form-control" value="0" placeholder="Gabbage">

                                             @if ($errors->has('gabbage'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('gabbage') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label>Amount Due(Current Month)</label>
                                            <input type="text" name="amount_due" class="form-control" value="0" placeholder="Amount Due">

                                             @if ($errors->has('amount_due'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('amount_due') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                              </div>
                              <div class="col-sm-12">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 pull-right">
                                  <button class="btn btn-primary pull-right">Create Tanant</button>
                                </div>
                                
                              </div>


                    

                  </form>
                  

                </div>


           

              </div>

              </div>

              @stop
                  @push('scripts')
           <script>

   $("#property").select2();

              $("#property").on("change",function(){
      var id=$("#property").val();

      var length=id.length;
       var token="<?=csrf_token();?>";
        if(length>=1){
        var url="<?=url('/backend/fetch/property_spaces')?>/"+id;
         $.post(url,{'_token':token},function(data){
            $("#spaces").html(data);

         });
       
      }

      
    });
            
           </script>
           @endpush

