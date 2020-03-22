@extends('layouts.app', ['activePage' => 'sip', 'titlePage' => __('Your SIP(s)')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ __('Systematic Investment Plans') }}</h4>
                <p class="card-category"> {{ __('Here you can manage your SIP(s)') }}</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('sip.create') }}" class="btn btn-sm btn-primary">{{ __('Add SIP') }}</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>Sr.No</th>
                      <th>
                          {{ __('Scheme Name') }}
                      </th>
                      <th>
                        {{ __('Folio No.') }}
                      </th>
                      <th class="text-right">
                        {{ __('Actions') }}
                      </th>
                    </thead>
                    <tbody>
                    @if($sips->count() > 0)
                      @foreach($sips as $key => $sip)
                        <tr>
                          <td>{{ $key + $sip->firstItem() }}</td>
                          <td>
                            {{ $fd->id }}
                          </td>
                          <td>
                            {{ $fd->folio_no }}
                          </td>
                          <td class="td-actions text-right">
                            <form action="{{ route('sip.destroy',$hash->encodeHex($sip->id)) }}" method="post" id="deleteFD">
                                @csrf
                                @method('delete')
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('sip.edit',$hash->encodeHex($sip->id)) }}">
                                  <i class="material-icons">edit</i>
                                  <div class="ripple-container"></div>
                                </a>

                                <button type="button" class="btn btn-danger btn-link" title="delete account">
                                  <i class="material-icons">close</i>
                                  <div class="ripple-container"></div>
                                </button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <td colspan = "5" align = "center">No Sip(s)</td>
                    @endif
                    </tbody>
                  </table>
                  <span class="pull-right">{{ $sips->links() }}</span>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection