@extends('layouts.app', ['activePage' => 'fd', 'titlePage' => __('Fixed Deposit')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('fd.update',$fd) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Edit Fixed Deposit') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('fd.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Bank Name') }}</label>
                 <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('bank_id') ? ' has-danger' : '' }}">
                      
                      <select class="selectpicker form-control show-tick" data-style="btn-primary" title="Choose one of the following..." data-live-search="true" name="bank_id">
                        @foreach($bank_lists as $bank_list)
                          <option value = "{{$bank_list->id}}" 
                            @if($fd->bank_id == $bank_list->id)
                              selected 
                            @endif >
                            {{$bank_list->name}}
                          </option>
                        @endforeach
                      </select>

                      @if ($errors->has('bank_id'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('bank_id') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Account No') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('account_no') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('account_no') ? ' is-invalid' : '' }}" name="account_no" id="acc" type="number" placeholder="{{ __('Ex : 78747421457') }}" value="{{ old('account_no',$fd->account_no) }}" required />
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
                      <input class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" input type="number" name="amount" min="5000" id="input-amount" placeholder="{{ __('10000') }}" value="{{ old('amount',$fd->amount) }}" onblur="editMatrityAmount();" required />
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
                      <input type="text" placeholder="{{ __('Starting Date') }}" name="starting_date" class="form-control datetimepicker" id="edit_start_date" onblur="editMindate(this.value); editMatrityAmount();" value="{{ old('starting_date',$fd->starting_date) }}" required />
                      
                      @if ($errors->has('starting_date'))
                        <span id="amount-error" class="error text-danger" for="input-start-date">{{ $errors->first('starting_date') }}</span>
                      @endif

                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('end_date') ? ' has-danger' : '' }}">
                      <input type="text" placeholder="{{ __('Ending Date') }}" id="edit_end_date" name="ending_date" class="form-control datetimepicker" value="{{ old('ending_date',$fd->ending_date) }}" onblur="editMatrityAmount();" required/>

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
                      <input type="number" step="any" min="5" max="15" placeholder="{{ __('7.2') }}" name="intrest_rate" class="form-control" id="edit-intrest-rate" value="{{ old('intrest_rate',$fd->intrest_rate) }}" onblur="editMatrityAmount();" required />

                      @if ($errors->has('start_date'))
                        <span id="st-error" class="error text-danger" for="input-intrest-rate">{{ $errors->first('start_date') }}</span>
                      @endif

                    </div>
                  </div>

                  <div class="col-sm-3">
                    <div class="form-group{{ $errors->has('maturity_amount') ? ' has-danger' : '' }}">
                      <input type="number" step="any" placeholder="{{ __('Maturity Amount') }}" name="maturity_amount" id="maturity_amount" class="form-control" value="{{ old('maturity_amount',$fd->maturity_amount) }}" required/>

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
                    <input class="form-check-input" type="radio" name="auto_renewal" value="{{ old('auto_renewal',1) }}" @if($fd->auto_renewal == 1) checked @endif >
                    Yes
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-radio ml-3">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="auto_renewal" value="{{ old('auto_renewal',2) }}" @if($fd->auto_renewal == 2) checked @endif >
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
                    <input class="form-check-input" type="radio" name="auto_closer" value="{{ old('auto_closer',1) }}"  @if($fd->auto_closer == 1) checked @endif >
                    Yes
                    <span class="circle">
                      <span class="check"></span>
                    </span>
                  </label>
                </div>
                <div class="form-check form-check-radio ml-3">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="auto_closer" value="{{ old('auto_closer',2) }}"  @if($fd->auto_closer == 2) checked @endif >
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
                    <input class="form-control{{ $errors->has('receipt_no') ? ' is-invalid' : '' }}" input type="number" name="receipt_no" id="input-recept" placeholder="{{ __('1582...') }}" value="{{ old('receipt_no',$fd->receipt_no) }}"  />
                    @if ($errors->has('receipt_no'))
                      <span id="recept-error" class="error text-danger" for="input-recept">{{ $errors->first('receipt_no') }}</span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
