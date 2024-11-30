  
  @extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
                                <a href="<?=url('backend/property/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-left">
       <li><a href="#">Home</a></li>
        <li><a href="<?=url('/backend/tenant/dashboard')?>"></span>Properties</a></li>
        <li class="active">Index</li>
</ol>
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
@include('backend::contacts.g_header')

<div class="row">

             
              <div class="col-md-12">
               <div class="btn-group">
              <button data-title="Create New Contact Group" class="btn btn-info reject-modal" data-url="<?=url('/backend/group/create')?>">Create New Group</button>

               <a  class="btn btn-primary" href="<?=url('/backend/message/groups/index')?>">View Groups</a>


               <a  class="btn btn-danger " href="<?=url('/backend/message/contact/import')?>"><span class="glyphicon glyphicon-upload"></span>Import Contacts</a>


               <a  class="btn btn-default " href="<?=url('/backend/message/contact/index')?>">View Contacts</a>

               <button  data-title="Add New Contact"    class="btn btn-success reject-modal" data-url="<?=url('/backend/message/contact/create')?>">Add New Contacts</button>

                <a  class="btn btn-warning " href="<?=url('/backend/message/account/top-up')?>">Recharge Account</a>
              
              </div>
                
              </div>
              <div style="margin-bottom:5%;">
                
              </div>
              
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Recharge Your Account To Send Bulk SMS and Emails</h6>
                </div>
                
              <div class="panel-body">
                  <div class="col-md-12 ">
                  <form action="<?=$url;?>" enctype="multipart/form-data" method="post">
                  <?=csrf_field();?>

                   <div class="col-md-7 pull-left" >

                    <label style="font-family:monotype corsiva"><i>Recharge Instructions</i></label>
                     <ol>
                     <li>Only Mpesa and Airtel Money are accepted</li>
                     <li>Limited Amount to be send is KES 250</li>
                     <li>Send the Money to 0719289389 0r 0708236804
                    </li>
                    <li>Provide us with Your transaction Code after sending the money so that your credit to be activated immediately</li>
                    



                       
                     </ol>



                   </div>
                  
                 <div class="col-md-3 pull-left" style="border-left:1px dotted gray">
                  <div class="form-group {{ $errors->has('gateway') ? ' has-error' : '' }}">

                  <label>Provider</label>
                    <select name="gateway" class="form-control" required>
                    <option value="">---Select Provider---</option>
                    <option>Safaricom Mpesa</option>
                    <option>Airtel Money</option>
                      
                    </select>
                     @if ($errors->has('gateway'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gateway') }}</strong>
                                    </span>
                                @endif
                    </div>

                 
                       
                      <div class="form-group {{ $errors->has('transaction_code') ? ' has-error' : '' }}">

                  <label>Transaction Code</label>
                    <input type="text" name="transaction_code" class="form-control" required id="transaction" value="<?=old('transaction_code')?>" >

                    @if ($errors->has('transaction_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('transaction_code') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group {{ $errors->has('amount') ? ' has-error' : '' }}">

                  <label>Amount</label>
                    <input type="text" name="amount" class="form-control" required id="transaction" value="<?=old('amount')?>" >
                     @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                    </div>

                   



                    <button class="btn btn-primary">Complete</button>
                   


                 </div>


                   </form>

                  </div>

              </div>

              </div>
              </div>

              @stop
               @push('scripts')
           <script>
             
           </script>
           @endpush

