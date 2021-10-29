<form method="get" action="{{ url()->current() }}" id="AjaxSearch" autocomplete="off">
	@section('search')
	<div class="row">
		<div class="col-md-12">
			<div class="row search_box align-items-center">
				<div class="col-sm-12 col-md-3 limit_box">
					<label>
						Show
							<select id="LimitOptions" name="limit" class="form-control form-control-sm">
								@php $options = CommonHelper::getLimitOption(); @endphp
								@foreach($options as $key=>$value)
									<option {{ request('limit',env('PAGINATION_LIMIT')) == $value ? 'selected' : '' }} value="{{ $value }}"  >{{ $value }}</option>
								@endforeach
							</select>
						Entries
					</label>
				</div>
				<div class="col-sm-12 col-md-6 offset-md-3 float-right">
					<div class="input-group">
						<input class="form-control" name="search" id="appointment-date" value="{{ request('search') }}" type="text" placeholder="Select Date">
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary" type="button">Search</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@show
</form>
<script>
    $(function() {
        $("#appointment-date").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
</script>