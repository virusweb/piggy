@extends('layouts.app', ['activePage' => 'account', 'titlePage' => __('Account Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('bank.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Account') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('bank.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Bank Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('bank_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('bank_name') ? ' is-invalid' : '' }}" name="bank_name" id="input-name" type="text" placeholder="{{ __('Ex : State Bank of India') }}" value="{{ old('bank_name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('bank_name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('bank_name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account No') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('account_no') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('account_no') ? ' is-invalid' : '' }}" name="account_no" id="input-number" type="number" placeholder="{{ __('Ex : 78747421457') }}" value="{{ old('account_no') }}" required />
                      @if ($errors->has('account_no'))
                        <span id="email-error" class="error text-danger" for="input-number">{{ $errors->first('account_no') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __(' Balance') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('balance') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('balance') ? ' is-invalid' : '' }}" input type="number" name="balance" id="input-password" placeholder="{{ __('10000') }}" value="{{ old('balance') }}" required />
                      @if ($errors->has('balance'))
                        <span id="balance-error" class="error text-danger" for="input-balance">{{ $errors->first('balance') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account Type') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select class="form-control{{ $errors->has('account_type') ? ' is-invalid' : '' }}" name = "account_type"  data-style="btn btn-link">
                        <option value = "saving">Savings</option>
                        <option value = "current">Current</option>
                      </select>
                      @if ($errors->has('account_type'))
                        <span id="balance-error" class="error text-danger" for="input-account_type">{{ $errors->first('account_type') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Add Account') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection