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
	.message li {
		margin: 3pt 0;
	}
	.message .message-list{
		border-radius: 5pt;
		//background-color: cyan;
		padding: 3pt 5pt;
		width: auto!important;
		margin: 3pt 0pt;
	}
	.message .message-own  {
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
					<message :url="'{{ url('/') }}'" :user="{{ auth()->user() }}"></message>
				</div>
				<div class="card-footer">
					
				</div>
			</div>
		</div>
	</div>
</div>

@endsection