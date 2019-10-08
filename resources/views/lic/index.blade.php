@extends('layouts.app', ['activePage' => 'lic', 'titlePage' => __('Your LIC Investments')])

@section('content')
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-primary">
							<h4 class="card-title">{{ __('LIC') }}</h4>
							<p class="card-category">{{__('Here you can manage your LIC investment plans') }}</p>
						</div>

						<div class="row">
							<div class="col-12 text-right">
								<a href="{{ route('lic.create') }}" class="btn btn-sm btn-primary"> {{ __('Add Account') }}</a>
							</div>
						</div>

						<div class="table-responsive">
							<table class="table">
								<thead class="text-primary">
									<th>{{ __('Sr.No') }}</th>
									<th>{{ __('Bank') }}</th>
									<th>{{ __('LIC Account') }}</th>
								</thead>

								<tbody>
									<td colspan="5" align="center">No LIC Accounts</td>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection