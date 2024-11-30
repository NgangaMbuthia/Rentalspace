@extends('layout.main_sidebar')

@section('content')

    <div class="row">
<!-- Error title -->
					<div class="text-center content-group">
						<h1 class="error-title">404</h1>
						<h5>Oops, an error has occurred. Page not found!</h5>
					</div>
					<!-- /error title -->


					<!-- Error content -->
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
							<form action="#" class="main-search">
								<div class="input-group content-group">
									<input type="text" class="form-control input-lg" placeholder="Search">

									<div class="input-group-btn">
										<button type="submit" class="btn bg-slate-600 btn-icon btn-lg"><i class="icon-search4"></i></button>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<a href="<?=url('home')?>" class="btn btn-primary btn-block content-group"><i class="icon-circle-left2 position-left"></i> Go to dashboard</a>
									</div>

									
								</div>
							</form>
						</div>
					</div>
					</div>
					<!-- /error wrapper -->

					@stop