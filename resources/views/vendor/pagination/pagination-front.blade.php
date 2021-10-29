@if($paginator->total() > $paginator->perPage())
	<div class="row">
		<div class="col-lg-12">
			<div class="pagination text-left">
				
				<ul>
					@if ($paginator->onFirstPage())
						<li class="disabled"><a href="javascript:void(0);"><span class="ti-angle-left"></span></a></li>
			        @else
			        	<li><a href="{{ $paginator->previousPageUrl() }}"><span class="ti-angle-left"></span></a></li>
			        @endif
			        {{-- Pagination Elements --}}
				        @foreach ($elements as $element)
				            {{-- "Three Dots" Separator --}}
				            @if (is_string($element))
				                <li class="" style="color: #5cc533;"><span>{{ $element }}</span></li>
				            @endif
				            {{-- Array Of Links --}}
				            @if (is_array($element))
				                @foreach ($element as $page => $url)
				                    @if ($page == $paginator->currentPage())
				                        <li class="active my-active"><a href="javascript:void(0);" class="active"><span>{{ $page }}</span></a></li>
				                    @else
				                        <li><a href="{{ $url }}">{{ $page }}</a></li>
				                    @endif
				                @endforeach
				            @endif
				        @endforeach
				    {{-- Next Page Link --}}
			        @if ($paginator->hasMorePages())
			            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="ti-angle-right"></span></a></li>
			        @else
			            <li class="disabled"><a href="javascript:void(0);"><span class="ti-angle-right"></span></a></li>
			        @endif
				</ul>
			</div>
		</div>
	</div>
@endif
