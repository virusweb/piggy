@extends('layouts.app', ['activePage' => 'fd', 'titlePage' => __('Fixed Deposit')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('fd.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add Fixed Deposit') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('fd.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Select Bank Account') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <select class="form-control{{ $errors->has('bank') ? ' is-invalid' : '' }}" name = "bank"  data-style="btn btn-link" onchange="getAccount(this.value);">
                        <option value = "" selected disabled>--Select--</option>
                        @foreach($accounts as $account)
                          <option value = "{{$hash->encodeHex($account->id)}}">{{$account->bank_name}} ({{$account->account_no}})</option>
                        @endforeach
                      </select>
                      @if ($errors->has('account_type'))
                        <span id="balance-error" class="error text-danger" for="input-account_type">{{ $errors->first('account_type') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account No') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('account_no') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('account_no') ? ' is-invalid' : '' }}" name="account_no" id="acc" type="number" placeholder="{{ __('Ex : 78747421457') }}" value="{{ old('account_no') }}" readonly required />
                      @if ($errors->has('account_no'))
                        <span id="email-error" class="error text-danger" for="input-number">{{ $errors->first('account_no') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-amount">{{ __('Amount') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('amount') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" input type="number" name="amount" id="input-amount" placeholder="{{ __('10000') }}" value="{{ old('balance') }}" required />
                      @if ($errors->has('amount'))
                        <span id="amount-error" class="error text-danger" for="input-amount">{{ $errors->first('amount') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" disabled="disabled" class="btn btn-primary">{{ __('Add Account') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection