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
                      <select class="selectpicker show-tick form-control text-white" onchange="getAccount(this.value);" data-style="btn-primary" name="bank" title="Choose your bank...">
                        @foreach($accounts as $account)
                          <option value = "{{$hash->encodeHex($account->id)}}">{{$account->bank_name}} ({{$account->account_no}})</option>
                        @endforeach
                      </select>
                      @if ($errors->has('bank'))
                        <span id="balance-error" class="error text-danger" for="input-account_type">{{ $errors->first('bank') }}</span>
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
                      <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" input type="number" name="amount" min="5000" id="input-amount" placeholder="{{ __('10000') }}" value="{{ old('amount') }}" onblur="getMatrityAmount();" required />
                      @if ($errors->has('amount'))
                        <span id="amount-error" class="error text-danger" for="input-amount">{{ $errors->first('amount') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-st-date">{{ __('Validity') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('starting_date') ? ' has-danger' : '' }}">
                      <input type="text" placeholder="{{ __('Starting Date') }}" name="starting_date" class="form-control datetimepicker" id="start_date" onblur="setMindate(this.value);getMatrityAmount();" value="{{ old('starting_date') }}" required />
                      
                      @if ($errors->has('starting_date'))
                        <span id="amount-error" class="error text-danger" for="input-start-date">{{ $errors->first('starting_date') }}</span>
                      @endif

                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('end_date') ? ' has-danger' : '' }}">
                      <input type="text" placeholder="{{ __('Ending Date') }}" name="ending_date" class="form-control datetimepicker" id="end_date" value="{{ old('ending_date') }}" onblur="getMatrityAmount();" required/>

                      @if ($errors->has('ending_date'))
                        <span id="amount-error" class="error text-danger" for="input-end-date">{{ $errors->first('ending_date') }}</span>
                      @endif

                    </div>
                  </div>
                </div>
              <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-st-date">{{ __('Intrest rate') }}</label>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('intrest_rate') ? ' has-danger' : '' }}">
                      <input type="number" step="any" min="5" max="15" placeholder="{{ __('7.2') }}" name="intrest_rate" class="form-control" id="intrest-rate" value="{{ old('intrest_rate') }}" onblur="getMatrityAmount();" required />

                      @if ($errors->has('start_date'))
                        <span id="st-error" class="error text-danger" for="input-intrest-rate">{{ $errors->first('start_date') }}</span>
                      @endif

                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('maturity_amount') ? ' has-danger' : '' }}">
                      <input type="number" step="any" placeholder="{{ __('Maturity Amount') }}" name="maturity_amount" id="maturity_amount" class="form-control" value="{{ old('maturity_amount') }}" required/>

                      @if ($errors->has('maturity_amount'))
                        <span id="en-error" class="error text-danger" for="input-mature-amount">{{ $errors->first('maturity_amount') }}</span>
                      @endif

                    </div>
                  </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-ar">{{ __('Auto Renew') }}</label>
                <div class="form-check form-check-radio">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="auto_renewal" value="{{ old('auto_renewal',1) }}" >
                    Yes
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-radio ml-3">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="auto_renewal" value="{{ old('auto_renewal',2) }}" >
                    No
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>

              @if (!$errors->has('auto_renewal'))
                <span id="en-error" class="error text-danger" for="input-mature-amount">{{ $errors->first('auto_renewal') }}</span>
              @endif

              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-ac">{{ __('Auto Closer') }}</label>
                <div class="form-check form-check-radio">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="auto_closer" value="{{ old('auto_closer',1) }}" >
                    Yes
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-radio ml-3">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="auto_closer" value="{{ old('auto_closer',2) }}" >
                    No
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
              </div>

              @if ($errors->has('auto_closer'))
                <span id="en-error" class="error text-danger" for="input-ac">{{ $errors->first('auto_closer') }}</span>
              @endif

              <div class="row">
                <label class="col-sm-2 col-form-label" for="input-recept">{{ __('Recept No.') }}</label>
                <div class="col-sm-7">
                  <div class="form-group{{ $errors->has('receipt_no') ? ' has-danger' : '' }}">
                    <input class="form-control{{ $errors->has('receipt_no') ? ' is-invalid' : '' }}" input type="number" name="receipt_no" id="input-recept" placeholder="{{ __('1582...') }}" value="{{ old('receipt_no') }}"  />
                    @if ($errors->has('receipt_no'))
                      <span id="amount-error" class="error text-danger" for="input-amount">{{ $errors->first('receipt_no') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
