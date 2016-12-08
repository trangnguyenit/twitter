@extends ('layouts.master_user')
@section ('title')
Login
@stop
@section ('form.content')
	<form id="login-form" action="{{ url('/admin/login') }}" method="post" role="form">
	 {{ csrf_field() }}
	 <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		<div class="form-group">
			<input type="text" name="email" id="username" tabindex="1" class="form-control" placeholder="email" value="{{ old('email') }}">
			@if ($errors->has('email'))
	            <span class="help-block">
	                <strong>{{ $errors->first('email') }}</strong>
	            </span>
        	@endif
		</div>
	 </div>
	
	 <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
		<div class="form-group">
			<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">

			@if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
		</div>
	 </div>

		<div class="form-group text-center">
			<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
			<label for="remember"> Remember Me</label>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<div class="text-center">
						<a href="{{ url('/password/reset') }}" tabindex="5" class="forgot-password">Forgot Password?</a>
					</div>
				</div>
			</div>
		</div>
	</form>
@stop
								
