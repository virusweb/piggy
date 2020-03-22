@extends('layouts.app', ['activePage' => 'sip', 'titlePage' => __('SIP Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('sip.store') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Add SIP') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('sip.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Bank Name') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('bank') ? ' has-danger' : '' }}">
                      
                      <select class="selectpicker form-control show-tick" data-style="btn-primary" title="Choose Bank" data-live-search="true" name="bank_name" onchange="getAccount(this.value);">
                        @foreach($user_bank_acconts as $bank_list)
                          <option value = "{{ $hash->encodeHex($bank_list->id) }}">{{$bank_list->bank_name}}</option>
                        @endforeach
                      </select>

                      @if ($errors->has('bank'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('bank') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account No') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('account_no') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('account_no') ? ' is-invalid' : '' }}" name="account_no" id="acc" type="number" placeholder="{{ __('Ex : 78747421457') }}" value="{{ old('account_no') }}" readonly required/>
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
                      <select class="selectpicker form-control show-tick form-control{{ $errors->has('account_type') ? ' is-invalid' : '' }}" name = "account_type" data-style="btn-primary" title="--select--">
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
                <button type="submit" class="btn btn-primary">{{ __('Add SIP') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection