@extends('layout.wizard')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        
        <li><a href="<?=url('/backend/tenants/listView')?>">Tenants List</a></li>
        <li class="active">Create Account</li>
  </ul>
  <style type="text/css">
      
.mydate{

        height: 36px;
background-color: #fff;
border: 1px solid #ddd;
border-radius: 3px;
padding: 7px;
      }
  </style>


@stop


@section('content')

<div>
    <p>
          <a href="<?=url('backend/tenants/import')?>" class="btn btn-primary "><span class="glyphicon glyphicon-upload"></span>Import Tenants</a>
    </p>
  
    

</div>
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-users position-left"></i>Import Tenants</h6>
                                </div>
                                
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <lagend>Import Instructions</lagend>
                                    <ol>
                                        <li>Only CSV or Excel Files can be imported</li>
                                        <li>A maxmum of 250 records can be imported at once to prevent server from timing out</li>
                                        <li>The <a data-title="Downlaod Template" data-url="<?=url('/backend/download/template')?>" class="reject-modal"> Import Template should be downloaded from here</a>.No other template data shall be accepted </li>
                                        <li>Template header must not be changed after downloadng</li>
                                        

                                    </ol>
                                    

                                </div>
                                  <div class="col-md-6">
                            <form   class="stepy-validation"  enctype="multipart/form-data" role="form" action="<?=url('/backend/tenants/import')?>" method="post">
                                 <?=csrf_field();?>
                                 <div class="form-group">
                                    <label>Property</label>
                                    <select name="propert_id" class="form-control" required>
                                        <option value="">--Select Property---</option>
                                         <?php foreach($properties as $prop):?>
                                           <option value="<?=$prop->id?>"><?=$prop->title?></option>
                                         <?php endforeach;?>

                                        
                                    </select>
                                     
                                 </div>

                                  <div class="form-group">
                                    <label>CSV/Excel File</label>
                                     <input type="file" name="file_name" class="form-control" required>
                                     
                                 </div>
                          

                           

                            
                            
                            

                            <button type="submit" class="btn btn-primary stepy-finish">Submit <i class="icon-check position-right"></i></button>
                             </form>

                                  </div>
                  
                       
                        
                        
                       
                    
                </div>
            </div>
            <div class="clearfix"></div>




@endsection

@push('scripts')

 
  
  
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}">
</script>
<script type="text/javascript">
      



</script>
@endpush
