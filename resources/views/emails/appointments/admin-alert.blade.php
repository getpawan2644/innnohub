@component('mail::message')
# Hi Admin New Appointment Has been booked.

Customer Name: {{$user['first_name'].' '.$user['last_name']}} <br />
Customer Mobile: {{'+'.$user['dial_code'].'-'.$user['mobile']}} <br />
Customer Email: {{$user['email']}} <br />
Appointment Date: {{date('d-m-Y', strtotime($appointment['appointment']['date']))}} <br />
From Time: {{date("H:i", strtotime($appointment['from_time']))}} <br />
To Time: {{date("H:i", strtotime($appointment['to_time']))}} <br />

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
@endcomponent
