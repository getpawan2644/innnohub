@if(!empty($records))
@php
$allow_routes=CommonHelper::getallowRoutes();
@endphp
<div></div>

<div class="modal-content {{((in_array("admin.products.image.reorder",$allow_routes) && in_array("admin.products.marked_featured",$allow_routes)) || (Auth::user()->role=="Admin"))?"":"not_allow"}}">
    @php
    $i=1;
    @endphp
    <ul class="property-image-list image_order_ul">
    @foreach($records as $record)
        <li class="paidImage image_order_li" id="{{$record->id}}">
            <div class="coustom-input">
                <img src="{{$record->thumbnail_url}}"/>
            </div>
            <div class="form-check">
                <input type="checkbox"  class="form-check-input featured_check" id="Check{{$i++}}" data-product_id="{{$record->product_id}}"data-id="{{$record->id}}" {{($record->featured)?"checked":''}}>
                <label class="form-check-label" for="exampleCheck1">Featured</label>
            </div>
        </li>
    @endforeach
    </ul>
</div>
<script>
    $('document').ready(function(){
        let featured=false;
        $(".featured_check" ).each(function( index ) {
            if($(this).prop("checked")){
                featured=true;
            }
        });
        if(!featured){
            $("#Check1").prop("checked",true);
        }
        @if((in_array("admin.products.image.reorder",$allow_routes) && in_array("admin.products.marked_featured",$allow_routes)) || (Auth::user()->role=="Admin"))
        $("ul").sortable({
            stop: function(event, ui) {
                //dropIndex = ui.item.index();
                let i=0;
                var data=[];
                $( ".paidImage" ).each(function() {
                    data[i]=$(this).attr("id");
                    i=i+1;
                });
                $.ajax({
                    url: "{{route('admin.products.image.reorder')}}",
                    data: {data},
                    method:"POST"
                }).done(function() {
                    $( this ).addClass( "done" );
                });
                console.log(data);
            }
        });
        $(".featured_check").click(function(){
            $('.featured_check').prop("checked",false);
            var id=$(this).data("id");
            var product_id=$(this).data("product_id");
            $(this).prop("checked",true);
            $(this).attr("checked","checked");
            $.ajax({
                url: "{{route('admin.products.marked_featured')}}",
                data: {"id":id,'product_id':product_id},
                method:"POST"
            }).done(function(response) {
                alertMessageRight(response.message,'success');
            });
        });
        @else
        $(".featured_check").attr("disabled","disabled");
        $(".not_allow").click(function(){
            alertMessage("You are not authorized to access this URL","error")
        });
        // $(".not_allow").drag(function(){
        //     alertMessage("You are not authorized to access this URL","error")
        // });
        @endif
    });
</script>
@else
@endif
