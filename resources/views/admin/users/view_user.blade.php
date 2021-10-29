<!-- <div class="loader-bg" id="loader">
				<div class="loader"></div>
			</div> -->

<div class="user-info mb-4">
	<div class="row">
		<div class="col-md-12">
			<div class="user">
				<img src="{{$record->thumbimage}}" class="img-fluid" />
			</div>
			<div class="user-details">
				
				<h2>@if($record->firstname)
					{{ $record->firstname }}
					{{$record->lastname}}
					@else
					N/A
					@endif</h2>
				
				<ul class="details-user">
					<li>
						<label>Username</label>
						@if($record->username)
						{{$record->username}}
						@else
						N/A
						@endif
					</li>
					<li><label>Email</label> {{ $record->email }}</li>
					<li>
						<label>Phone</label>
						@if($record->phone)
						{{$record->phone}}
						@else
						N/A
						@endif
					</li>
					<li>
						<label>Status</label>
						@if($record->status)
						{{$record->status}}
						@else
						N/A
						@endif
					</li>
				</ul>
				
			</div>
		</div>

		
	</div>
</div>

<fieldset>
	<div class="row">
		<div class="col-md-12">
			<div class="v_title">Regions:</div>
				@if(count($record->regions) > 1)
				<ul id="regions" class="v_value regions_str pl-0">
					@foreach($record->regions as $key=>$value)
					<li>{{$value}}</li>
					@endforeach
				</ul>
				@else
				<p style="font-size:12px;">N/A</p>
				@endif
			</div>
		</div>
	</div>
</fieldset>
<br/>
<fieldset>
	<div class="row">
		<div class="col-md-12">
			<div class="v_title">Interest:</div>
				@if(count($record->user_category) > 0)
				<ul id="interest" class="v_value regions_str pl-0">
					@foreach($record->user_category as $interest)
					<li>{{$interest->category->name}}</li>
					@endforeach
				</ul>
				@else
				<p style="font-size:12px;">N/A</p>
				@endif
			</div>
		</div>
	</div>
</fieldset>
<br/>
<fieldset>
	<div class="row">
		<div class="col-md-12">
			<div class="v_title">Tags:</div>
			@if(count($record->userTag) > 0)
				<div class="col-md-10 v_value tages">
					@foreach($record->userTag as $userTag)
					<a href="{{route('tag-details',$userTag->tag->id)}}" class="product_tag" target="_blank">
							# {{ucwords($userTag->tag->name)}}
					</a>
					@endforeach
				</div>
			@else
			<p style="font-size:12px;">N/A</p>
			@endif
			</div>
		</div>
	</div>
</fieldset>