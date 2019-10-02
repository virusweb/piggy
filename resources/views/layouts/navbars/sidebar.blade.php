<div class="sidebar" data-color="azure" data-background-color="white">
  <div class="logo">
    <a href="{{route('home')}}" class="simple-text logo-normal">
      {{ __('Piggy - A Saving App') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'account' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('bank.index') }}">
          <i class="material-icons">account_balance</i>
            <p>{{ __('Bank Accounts') }}</p>
        </a>
      </li>
      @if(Auth::user()->role === 'admin')
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
              <i class="material-icons">supervised_user_circle</i>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      @endif
      <li class="nav-item{{ $activePage == 'fd' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('fd.index') }}">
          <i class="material-icons">description</i>
            <p>{{ __('Fixed Deposits') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>