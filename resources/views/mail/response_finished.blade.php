@component('mail::message')
### you have got a response from {{ $title }}
@component('mail::table',['data' => $data])
| field name    | value         |
| ------------- |:-------------:|
@foreach($data as $key => $value)
|{{ data_get($fields, $key) ?? "Enter a question" }}|{{ $value }}|
@endforeach
@endcomponent
@endcomponent