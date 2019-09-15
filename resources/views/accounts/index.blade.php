@extends('layouts.app', ['activePage' => 'account', 'titlePage' => __('Your Accounts')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Accounts') }}</h4>
                <p class="card-category"> {{ __('Here you can manage your accounts') }}</p>
              </div>
              <div class="card-body">
                @if (session('status') === true)
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>Account successfully saved</span>
                      </div>
                    </div>
                  </div>
                @elseif(session('status') === false)
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>Somthing went wrong</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('bank.create') }}" class="btn btn-sm btn-primary">{{ __('Add Account') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                          {{ __('Bank') }}
                      </th>
                      <th>
                        {{ __('Account No') }}
                      </th>
                      <th>
                        {{ __('Balance') }}
                      </th>
                      <th>
                        {{ __('Account Type') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                    @if($bank_accounts->count() > 0)
                      @foreach($bank_accounts as $bank_account)
                        <tr>
                          <td>
                            {{ $bank_account->bank_name }}
                          </td>
                          <td>
                            {{ $bank_account->account_no }}
                          </td>
                          <td>
                            <span class="badge badge-success">{{ number_format($bank_account->balance,2) }}</span>
                          </td>
                          <td>
                            {{ $bank_account->account_type }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('bank.destroy',$hash->encodeHex($bank_account->id)) }}" method="post">
                                @csrf
                                @method('delete')
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('bank.edit',$hash->encodeHex($bank_account->id)) }}">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>

                                <button type="button" class="btn btn-danger btn-link" title="delete account" onclick="confirm('{{ __("Are you sure you want to delete this account?") }}') ? this.parentElement.submit() : ''">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <td colspan = "5" align = "center">No Bank Accounts</td>
                    @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection