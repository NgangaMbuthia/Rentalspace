@extends('layout.main_sidebar')
@section('breadcrumb')

 <ul class="breadcrumb">
             <li><a href="<?=url('home')?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="<?=url('/backend/category/management/index')?>">Category Management</a></li>
        <li class="active">Create</li>
  </ul>

@stop


@section('content')
                 <div class="panel panel-white">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><i class="icon-home position-left"></i>Create Category</h6>
                                </div>
                                
                            <div class="panel-body">
                  
                    <form role="form" action="<?=url('/backend/category/management/create/')?>" method="post">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="<?=old('name')?>">
                                     @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif

                                </div>
                            </div>
                            
                            
                        </div>
                      
                        <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                            <label>Description</label>
                            <textarea class="form-control" name="description"   rows="4"><?=old('description')?></textarea>
                             @if ($errors->has('description'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                        </div>
                          
                        

                        

                        
                        

                        
                        
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                    

                     <button type="submit" href="<?=url('/backend/category/management/create')?>" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b> Create New Category</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>


{{ Widget::MediaUploaderWidget() }}

@endsection

@push('scripts')
<script type="text/javascript" src="{{asset('assets/js/pages/uploader_bootstrap.js')}}"></script>
@endpush
