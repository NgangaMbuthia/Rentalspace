	
	@extends('layout.main')
  @section('header')
<div class="heading-elements">
                            <div class="heading-btn-group">
                                <a href="<?=url('backend/invoice/statistics');?>" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                                <a href="<?=url('/backend/invoices/index')?>" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoice</span></a>
                                
                            </div>
                        </div>
@stop
@section('breadcrumb')
<ol class="breadcrumb pull-right">
				<li><a href="<?=url('/backend/invoices/index')?>">Invoice Management</a></li>
				<li class="active">View</li>
</ol>
@stop

@section('content')
  

  <!-- Editable invoice -->
          <div class="panel panel-white">
            <div class="panel-heading">
              <h6 class="panel-title">Invoice Details</h6>
              <div class="heading-elements">
                <button type="button" data-url="<?=url('/backend/invoice/email/'.$model->id)?>"  data-title="Email Invoice" class="btn btn-default btn-xs heading-btn reject-modal"><i class="icon-envelope position-left"></i> Email</button>
                <a target="_new" href="<?=url('/backend/invoice/download/'.$model->id);?>" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left" target="_new"></i> Print</a>
                      </div>
            </div>

            <div id="invoice-editable" contenteditable="true">
              <div class="panel-body no-padding-bottom">
                <div class="row">
                  <div class="col-sm-6 content-group">
                    <img src="assets/images/logo_demo.png" class="content-group mt-10" alt="" style="width: 120px;">
                    <ul class="list-condensed list-unstyled">
                      <li><?=@Auth::user()->getprovider->name;?></li>
                      <li><?=@Auth::user()->getprovider->telephone;?></li>
                      <li><?=@Auth::user()->getprovider->postal_address;?>, <?=@Auth::user()->getprovider->street;?></li>

                      <li><?=@Auth::user()->getprovider->town;?></li>
                    </ul>
                  </div>

                  <div class="col-sm-6 content-group">
                    <div class="invoice-details">
                      <h5 class="text-uppercase text-semibold">Invoice <?=$model->invoice_number?></h5>
                      <ul class="list-condensed list-unstyled">
                        <li>Date: <span class="text-semibold"><?=date('F d,Y',strtotime($model->issue_date))?></span></li>
                        <li>Due date: <span class="text-semibold"><?=date('F d,Y',strtotime($model->due_date))?></span></li>
                      </ul>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 col-lg-9 content-group">
                    <span class="text-muted">Invoice To:</span>
                    <ul class="list-condensed list-unstyled">
                      <li><h5><?=$model->user->name?></h5></li>
                      <li><span class="text-semibold"><?=$model->user->email?></span></li>
                      <li><?=$model->user->profile->telephone?></li>
                      <li><?=$model->user->profile->postal_address?></li>
                      <li><?=$model->user->profile->city?></li>
                      <li><?=$model->user->profile->country?></li>
                      
                    </ul>
                  </div>

                  <div class="col-md-6 col-lg-3 content-group">
                    <span class="text-muted">Payment Details:</span>
                    <ul class="list-condensed list-unstyled invoice-payment-details">
                      <li><h5>Total Due: <span class="text-right text-semibold">KES: <?=$model->amount;?></span></h5></li>
                      <li>Bank name: <span class="text-semibold">
                        <?=$model->space->property->bank_name;?>
                      </span></li>
                      <li>Branch: <span><?=$model->space->property->bank_branch;?></span></li>
                      <li>A/c Name: <span><?=$model->space->property->account_name;?></span></li>
                      <li>A/c Number: <span><?=$model->space->property->account_number;?></span></li>
                      <li> PayBill: <span class="text-semibold"><?=$model->space->property->paybill;?></span></li>
                      <li>M-Pesa: <span class="text-semibold"><?=$model->space->property->mpesa_phone;?></span></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="table-responsive">
                  <table class="table table-lg">
                      <thead>
                          <tr>
                              <th>Code</th>
                              <th>Item Name</th>
                              <th >Unit Price</th>
                              <th >Quantity</th>
                              <th >Total</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                         <?php foreach($model->items as $item):?>
                          <tr>
                              <td>
                                 <?=$item->code?>
                              </td>
                              <td><?=$item->name;?></td>
                              <td><?=$item->amount;?></td>
                               <td>1</td>
                              <td><span class="text-semibold"><?=$item->amount;?></span></td>
                          </tr>
                           <?php endforeach;?>
                          
                      </tbody>
                  </table>
              </div>

              <div class="panel-body">
                <div class="row invoice-payment">
                  

                  <div class="col-sm-5 pull-right">
                    <div class="content-group">
                      <h6>Total due</h6>
                      <div class="table-responsive no-border">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th>Subtotal:</th>
                              <td class="text-right"><?=$model->amount;?></td>
                            </tr>
                            <tr>
                              <th>Tax: <span class="text-regular">(0%)</span></th>
                              <td class="text-right">00</td>
                            </tr>
                            <tr>
                              <th>Total:</th>
                              <td class="text-right text-primary"><h5 class="text-semibold">KES <?=$model->amount;?></h5></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                      <div class="text-right">
                          <?php if(Entrust::hasRole("Provider")):?>
                        <button type="button"  data-url="<?=url('/backend/invoice/email/'.$model->id)?>"  data-title="Email Invoice"  class="btn btn-primary btn-labeled reject-modal"><b><i class="icon-paperplane"></i></b> Send invoice</button>
                         <?php else:?>

                            <?php if($model->status=="Pending"):?>


                           <a href="<?=url('/backend/invoice/payment/'.$model->id)?>" title="Pay Now"  id="paynow" class="btn btn-primary btn-labeled "><b><i class="icon-paperplane" ></i></b> Pay Now</a>

                            <?php endif;?>


                         <?php endif;?>
                      </div>
                    </div>
                  </div>
                </div>

                <h6>Other information</h6>
                <p class="text-muted">Thank you for using this Platform. 
              </div>
            </div>
          </div>

              @stop

      @push('scripts')


<script type="text/javascript">
  $("body").on("click","#paynow",function(e){
    e.preventDefault();
    window.location.href ="<?=url('/tenants/invoice/payment?id='.$model->id)?>";

  })

    
</script>
@endpush

