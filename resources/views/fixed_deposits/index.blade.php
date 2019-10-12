@extends('layouts.app', ['activePage' => 'fd', 'titlePage' => __('Your Fixed Deposits')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('FDs') }}</h4>
                <p class="card-category"> {{ __('Here you can manage your fixed deposits') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>FD successfully saved</span>
                      </div>
                    </div>
                  </div>
                @elseif(session('status') === 'false')
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
                    <a href="{{ route('fd.create') }}" class="btn btn-sm btn-primary">{{ __('Add FD') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>Sr.No</th>
                      <th>
                          {{ __('Bank') }}
                      </th>
                      <th>
                        {{ __('FD Account') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                    @if($fds->count() > 0)
                      @foreach($fds as $key => $fd)
                        <tr>
                          <td>{{ $key + $fds->firstItem() }}</td>
                          <td>
                            {{ $fd->bank }}
                          </td>
                          <td>
                            {{ $fd->account_no }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('fd.destroy',$hash->encodeHex($fd->id)) }}" method="post" id="deleteFD">
                                @csrf
                                @method('delete')
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('fd.edit',$hash->encodeHex($fd->id)) }}">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>

                                <button type="button" class="btn btn-danger btn-link" title="delete account" onclick="getConfirm();">
                                  <i class="material-icons">close</i>
                                  <div class="ripple-container"></div>
                                </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <td colspan = "5" align = "center">No FD Accounts</td>
                    @endif
                    </tbody>
                  </table>
                  <span class="pull-right">{{ $fds->links() }}</span>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection