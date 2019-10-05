  @extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Material Dashboard')])

  @section('content')
  <div class="container" style="height: auto;">
    <div class="row align-items-center">
      <div class="col-md-9 ml-auto mr-auto mb-3 text-center">
        <h3><q>{{ __('A well planned work produces good results, even in adverse condition.') }}</q></h3>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
        <form class="form" method="POST" action="{{ route('login') }}" onsubmit="loadLoginPrgress();">
          @csrf
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary text-center">
              <h4 class="card-title"><strong>{{ __('Login') }}</strong></h4>
              <div class="social-line">
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-facebook-square"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-twitter"></i>
                </a>
                <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                  <i class="fa fa-google-plus"></i>
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">email</i>
                    </span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email', 'admin@material.com') }}" required>
                </div>
                @if ($errors->has('email'))
                  <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                    <strong>{{ $errors->first('email') }}</strong>
                  </div>
                @endif
              </div>
              <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="material-icons">lock_outline</i>
                    </span>
                  </div>
                  <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" value="{{ !$errors->has('password') ? "password" : "" }}" required>
                </div>
                @if ($errors->has('password'))
                  <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                    <strong>{{ $errors->first('password') }}</strong>
                  </div>
                @endif
              </div>
            </div>
            <div class="card-footer justify-content-center">
              <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Lets Go') }}</button>
            </div>
          </div>
        </form>
        <div>
          @if (Session::get('successreg'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{Session::get('successreg')}}</strong>
            </div>
          @endif
        </div>
        <div id="login-prgs" style="display: none;">
          <div class="progress">
            <div id="login-progress-bar" class="progress-bar progress-bar-striped" role="progressbar" style="width: 0%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-light">
                <small>{{ __('Forgot password?') }}</small>
              </a>
            @endif
          </div>
          <div class="col-6 text-right">
            <a href="{{ route('register') }}" class="text-light">
              <small>{{ __('Create new account') }}</small>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
