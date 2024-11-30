  
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
        
       <li class="active">Submitted Payments</li>
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
                 <li><a href="<?=url('/admin/profile/index')?>"><i class="icon-gear"></i>Profile Details</a>
                </ul>
              </li>
            </ul>
@stop

@section('content')

<div class="row">
             <div class="col-md-12">

            <div class="panel panel-white">
            <div class="panel-heading">
              <h6 class="panel-title">Submitted Payments Details</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                          <li><a data-action="collapse"></a></li>
                          <li><a data-action="reload"></a></li>
                         
                        </ul>
                      </div>
            </div>
            <div class="row">
              <p></p>
              <div class="col-md-6">
                <div class="table table-responsive">
                  <table class="table table-bordered">
                    <tr>
                      <th>Property</th>
                      <td><?=$model->invoice->space->property->title;?></td>
                      
                    </tr>
                    <tr>
                      <th>Space</th>
                      <td><?=$model->invoice->space->number;?></td>
                      
                    </tr>
                    <tr>
                      <th>Invoice Number</th>
                      <td><?=$model->invoice->invoice_number;?></td>
                      
                    </tr>
                     <tr>
                      <th>Amount Paid</th>
                      <td><?=number_format($model->amount_paid)?></td>
                      
                    </tr>
                      <tr>
                      <th>Method</th>
                      <td><?=$model->method?></td>
                      
                    </tr>
                     <tr>
                      <th>Ref No</th>
                      <td><?=$model->ref_no;?></td>
                      
                    </tr>
                     <tr>
                      <th>Transaction Date</th>
                      <td><?=date('dS M,Y',strtotime($model->transaction_date))?></td>
                      
                    </tr>
                     <tr>
                      <th>Status</th>
                      <td><?=$model->approve_status?></td>
                      
                    </tr>
                    
                    
                  </table>
                  
                </div>
                

              </div>
              <div class="col-md-6">
                <div class="table table-responsive">
                

                </div>
              </div>
               </div>

              </div>

              </div>

              @stop
  

