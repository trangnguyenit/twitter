@extends ('layouts.master_user')

@section ('title')
Register
@stop

@section ('form.content')					
<form id="register-form" action="{{ url('/admin/register') }}" method="post" role="form">
{{ csrf_field() }}

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Username" value="{{ old('name') }}">
		@if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
	</div>

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="{{ old('email') }}">
		@if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
	</div>

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
		@if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
	</div>

	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		<input type="password" name="password_confirmation" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">

		@if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
	</div>

	<div class="form-group">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<input type="submit" name="register" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
			</div>
		</div>
	</div>

</form>
@stop