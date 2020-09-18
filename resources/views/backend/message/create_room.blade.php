@extends('backend.layouts.app')

@section('title', 'Tambah Message')

@section('content')
<br>
<br>
<br>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="card" style="background: white;">
				<div class="card-header text-center">
					<h4>Tambah Message</h4>
				</div>
				<hr style="margin: 0">
				<form action="{{ route('message.room.store') }}" method="POST">
					{{ csrf_field() }}
				<div class="card-body">
					<div class="row" style="padding: 2em 5em">
						<div class="col-12">
							<label for="user">Pilih User</label>
							<select class="form-control" id="user" name="user">
								<option>Select User</option>
								@foreach($user as $u)
								<option value="{{$u->id}}">{{ $u->name }}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="row text-center" style="padding: 2em 5em">
						<button class="btn btn-secondary">Cancel</button>
						<button class="btn btn-success">Tambah</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection