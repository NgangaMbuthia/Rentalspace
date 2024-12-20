 @extends('layouts.app')

@section('content')

 <div id="mapView" class="mob-min"><div class="mapPlaceholder"><span class="fa fa-spin fa-spinner"></span> Loading map...</div></div>
            <div id="content" class="mob-max">
                <div class="rightContainer">
                    <h1>List a New Property</h1>
                    <form role="form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Price</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">$</div>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Address <span id="latitude" class="label label-default"></span> <span id="longitude" class="label label-default"></span></label>
                            <input class="form-control" type="text" id="address" placeholder="Enter a Location" autocomplete="off">
                            <p class="help-block">You can drag the marker to property position</p>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Bedrooms</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Bathrooms</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="form-group">
                                    <label>Area</label>
                                    <div class="input-group">
                                        <input class="form-control" type="text">
                                        <div class="input-group-addon">Sq Ft</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                                <div class="btn-group">
                                    <label>Type</label>
                                    <div class="clearfix"></div>
                                    <a href="#" data-toggle="dropdown" class="btn btn-default dropdown-toggle">
                                        <span class="dropdown-label">For Sale</span>&nbsp;&nbsp;&nbsp;<span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-select">
                                        <li class="active"><input type="radio" name="ptype" checked="checked"><a href="#">For Sale</a></li>
                                        <li><input type="radio" name="ptype"><a href="#">For Rent</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label>Image Gallery</label>
                                    <input type="file" class="file" multiple data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="/image/jpeg,image/png" data-browse-class="btn btn-o btn-default" data-browse-label="Browse Images">
                                    <p class="help-block">You can select multiple images at once</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>Amenities</label>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Garage</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Security System</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Air Conditioning</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Balcony</label></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Outdoor Pool</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Internet</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Heating</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> TV Cable</label></div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Garden</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Telephone</label></div>
                                    <div class="checkbox custom-checkbox"><label><input type="checkbox"><span class="fa fa-check"></span> Fireplace</label></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-green btn-lg isThemeBtn">Add Property</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="clearfix"></div>
@endsection            