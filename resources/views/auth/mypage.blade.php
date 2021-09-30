@extends('layouts.default')

@section('content')
@if(@isset($favorites,$reservedShops,$user))
<p>{{$user->name}}</p>
@foreach($reservedShops as $reservedShop)
<p>{{$reservedShop['date']->format('Y-m-d')}}</p>
<p>{{$reservedShop['date']->format('H:s')}}</p>
@endforeach
@endif
@endsection