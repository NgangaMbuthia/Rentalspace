  
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
@include('backend::properties.s_head')

<div class="row">

             
           
              
              
                
              


   <div class="col-md-12" >
             

             <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">Import Properties To The System</h6>
                </div>
                
              <div class="panel-body">
                  <div class="col-md-12 ">
                  <form action="<?=$url;?>" enctype="multipart/form-data" method="post">
                  <?=csrf_field();?>
                  
                 <div class="col-md-3 pull-right">
                  <label>Browse For File</label>
                    <input type="file" name="file" required id="file" >

                    <p><br>


                    <button class="btn btn-primary">Upload</button>
                   


                 </div>


                   <div class="col-md-7 pull-left" style="border-right:1px dotted gray">

                    <label style="font-family:monotype corsiva"><i>Upload Instructions</i></label>
                     <ol>
                     <li>Only .xls/csv file are uploaded.</li>
                     


                       
                     </ol>



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

