@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
        <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
        <li><a href="<?=url('/admin/user/viewuser')?>">Incidents</a></li>
        <li class="active">Create</li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-user position-left"></i>Report Incidents</h6>
                                </div>
                                
                            <div class="panel-body">


                             <form action="<?=$url?>" method="post">
                             {{csrf_field()}}

                            <div class="col-md-12 panel panel-default">
                             

                            <div class="panel-body">
                            <div class="row">
                           

                            <div class="col-md-12 form-group">
                            <label>Name/Subject</label>
                            <input type="text" name="incident_name" required class="form-control " >
                            </div>
                            <div class="col-md-6 form-group">
                            <label>Incident Date</label>
                            <input type="text" name="incident_date" class="form-control" id="datepicker" value="<?=date('Y-m-d');?>">
                            </div>

                            <div class="col-md-6 form-group">
                            <label>Incident Time</label>
                            <input type="text" id="setTimeExample" name="incident_time" class="form-control" value="<?=date('H:i:s');?>">
                            </div>
                            
                            

                            <div class="col-md-12 form-group">
                            <label>Decription</label>
                            <textarea class="form-control" rows="6" name="description"></textarea>
                            </div>

                            

                            
                            <div class="clearfix"></div>
                            
                          

                           



                                

                            </div>






                                
                            </div>


                            <div class="col-md-12">

                            <button class="btn btn-info">Save Details</button><p>
                                


                            </div>
                            </form>
                                

                            </div>

                            
                  
                               </div>
            <div class="clearfix"></div>
            </div>



@endsection
@push('scripts')
  <script type="text/javascript" src="{{asset('/js/jquery.timepicker.js')}}"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('/js/jquery.timepicker.css')}}" />

<script type="text/javascript">



           $( "#datepicker" ).datepicker({ minDate: 0, maxDate: "+1M +10D" ,dateFormat:"yy-mm-dd",});

            $('#setTimeExample').timepicker({ 'timeFormat': 'H:i:s' });
  
    


</script>



@endpush




