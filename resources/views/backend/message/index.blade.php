@extends('backend.layouts.app')

@section('title', 'Message')

@section('css')
<style type="text/css">
	.row {
		margin-left: 0px;
		margin-right: 0px;
	}

	.message {
		list-style-type: none;
		list-style-position: none;
	}
	.message .message-list{
		border-radius: 5pt;
		padding: 3pt 5pt;
		width: auto!important;
		margin: 3pt 0pt;
	}
	.message .message-own {
		text-align: right;
	}
</style>
@endsection

@section('content')
<br>
<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card" style="background: white;">
				<div class="card-header text-center">
					<h4>Message</h4>
				</div>
				<hr style="margin: 0">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="card-title">
								<a href="">
									<h4><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Message</h4>
								</a>
							</div>
						</div>
						<div class="col-md-8">
							<div class="card-title">
								<div class="row">
									<div class="col-xs-1">
										<a href="#"><img src="{{ asset('media/user.jpg') }}" class="img-circle" alt="user image" width="50px"></a>
									</div>
									<div class="col-xs-10">
										<a href="#" class="h5">Nama User </a>
									</div>
									<div class="col-xs-1">
										<a href="#"><span class="glyphicon glyphicon-exclamation-sign"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4"  style="padding-right: 0px;padding-left: 0px;">
							<ul  class="list-group">
								<li class="list-group-item">
									<div class="row">
										<div class="col-xs-2">
											<a href="#"><img src="{{ asset('media/user.jpg') }}" class="img-circle" alt="user image" width="50px"></a>
										</div>
										<div class="col-xs-10">
										 	<a href="#" class="text-black">
												<h5>User</h5>
												<p>Message... </p>
											</a>
										</div>
									</div>
	
								</li>
								<li class="list-group-item">
									<div class="row">
										<div class="col-xs-2">
											<a href="#"><img src="{{ asset('media/user.jpg') }}" class="img-circle" alt="user image" width="50px"></a>
										</div>
										<div class="col-xs-10">
										 	<a href="#">
												<h5>User</h5>
												<p>Message... </p>
											</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<div class="col-md-8" style="padding-right: 0px;padding-left:0px">
							<div class="row">
								<div class="col-xs-12">
									<div class="panel panel-default">
										<div class="panel-body" style="min-height: 20vh">
											<ul class="message">
												<li class="message-list">tes</li>
												<li class="message-list message-own">tes</li>
											</ul>
										</div>
										<div class="panel-footer">
											<div class="input-group">
											  <input type="text" class="form-control" placeholder="Text message..." aria-describedby="send">
											  <span class="input-group-addon" id="send"><a href="" class="btn">Kirim</a></span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection