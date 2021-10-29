<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">From Time</th>
                <th scope="col">To Time</th>
                <th scope="col">Booked By</th>
            </tr>
        </thead>
        <tbody>
            @if(!empty($record['AppointmentSlot']))
                @php $i=1 @endphp
                @foreach($record['AppointmentSlot'] as $key=>$value)
                <tr>
                    <th scope="row">{{$i++}}</th>
                    <td>{{date('h.i A', strtotime($value->from_time))}}</td>
                    <td>{{date('h.i A', strtotime($value->to_time))}}</td>
                    <td>{{!empty($value->user)?(@$value->user->first_name.' '.@$value->user->last_name):'NA'}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
