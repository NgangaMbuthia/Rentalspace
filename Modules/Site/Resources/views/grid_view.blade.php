@extends('front.main')
@section('content')
        <div class="col-md-8 col-lg-9">
                        
                     
                       
                        
                  <?php foreach($models as $model):?>           
               
            
                <div class="col-md-6 col-lg-4">
                    <div class="listing-box">
    <div class="listing-box-image" style="background-image: url('{{asset('/frontend/assets/img/tmp/tmp-10.jpg')}}');">
        <div class="listing-box-image-label">Featured</div><!-- /.listing-box-image-label -->
        
        <span class="listing-box-image-links">
            <a href="properties.html"><i class="fa fa-heart"></i> <span>Add to favorites</span></a>
            <a href="<?=url('/application/property/details/'.$model->id)?>"><i class="fa fa-search"></i> <span>View detail</span></a>
            <a href="properties-compare.html"><i class="fa fa-balance-scale"></i> <span>Compare property</span></a> 
        </span>     
    </div><!-- /.listing-box-image -->

    <div class="listing-box-title">
        <h2><a href="properties-detail-standard.html"><?=$model->title;?></a></h2>
        <h3><?=$model->currency. " :".$model->unit_price;?></h3>
    </div><!-- /.listing-box-title -->

    <div class="listing-box-content">
        <dl>
            <dt>Type</dt><dd>House</dd>
            <dt>Location</dt><dd><?=$model->location.'-'.$model->town;?></dd>
            <dt>Area</dt><dd><?=$model->area?> sqft</dd>
        </dl>
    </div><!-- /.listing-box-cotntent -->
</div><!-- /.listing-box -->            
                </div><!-- /.col-* -->
                        
          
             

<?php endforeach;?>    
                  
                        
                     
                        

            <div class="pagination-wrapper">
    
      {{ $models->links() }}
</div><!-- /.pagination-wrapper -->     
        </div><!-- /.col-sm-* -->
@endsection