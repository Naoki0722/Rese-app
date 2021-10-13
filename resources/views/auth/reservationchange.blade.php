@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <header class="pl-20 bg-gray-100 p-6 flex relative">
    <div @click="isOpen = !isOpen" class="pl-2 pt-1 h-10 w-10 bg-blue-600 rounded-md shadow-kk justify-center items-center cursor-pointer">
    <div class="h-2 w-4 border-b"></div>
    <div class="h-2 w-5 border-b"></div>
    <div class="h-2 w-4 border-b"></div>
    </div>
    <div :class="isOpen ? 'block' : 'hidden' " class="w-screen h-screen absolute top-20 left-0 flex justify-center">
      <ul class="w-52 h-52 mt-40 ">
        <li class="text-center h-12"><a href="/" class="text-blue-600 text-4xl font-medium">Home</a></li>
        <li class="text-center h-12">
          <form method="POST" action="{{ route('logout') }}">
          @csrf

            <x-dropdown-link :href="route('logout')"
              onclick="event.preventDefault();
              this.closest('form').submit();"
              class="text-blue-600 text-4xl font-medium">
              {{ __('Log Out') }}
            </x-dropdown-link>
          </form>
        </li>
        <li class="text-center h-12"><a href="/mypage" class="text-blue-600 text-4xl font-medium">Mypage</a></li>
      </ul>
    </div>
    <h1 class="text-blue-600 text-4xl pl-5" :class="isOpen ? 'hidden' : 'block' ">Rese</h1>
  </header>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    <p class="text-blue-600 text-center text-2xl font-bold my-5">予約変更</p>
    @if(@isset($item))
    @foreach($item as $reserve)
    <form action="/reservationchange/{{$reserve->id}}" method="post" class="w-2/5 m-auto">
      @csrf
      <div class="bg-blue-600 p-5 rounded-t-lg">
        <div class="flex mb-2.5">
          <p class="text-white w-24 font-bold">Shop</p>
          <p class="text-white">{{$reserve->shop->shop_name}}</p>
        </div>
        <div class="flex">
          <p class="text-white w-24 font-bold">Day</p>
          <input type="date" name="day" value="{{$reserve['date']->format('Y-m-d')}}" class="rounded-md block mb-2.5 h-8 w-full text-xs">
        </div>
          @if($errors->has('day'))
          <p class="text-yellow-200">{{$errors->first('day')}}</p>
          @endif
          @php
            $times = [
              ['tm'=>'時間','value'=>''],
              ['tm'=>'16:00','value'=>'16:00'],
              ['tm'=>'17:00','value'=>'17:00'],
              ['tm'=>'18:00','value'=>'18:00'],
              ['tm'=>'19:00','value'=>'19:00'],
              ['tm'=>'20:00','value'=>'20:00'],
              ['tm'=>'21:00','value'=>'21:00'],
            ];
          @endphp
          <div class="flex">
            <p class="text-white w-24 font-bold">Time</p>
            <select name="time" class="block w-full rounded-md mb-2.5 h-8 text-xs">
              @foreach($times as $time)
                @if($reserve['date']->format('H:s') == $time['tm'])
                <option value="{{$time['value']}}" selected>{{$time['tm']}}</option>
                @else
                <option value="{{$time['value']}}">{{$time['tm']}}</option>
                @endif
              @endforeach
            </select>
          </div>
          @if($errors->has('time'))
          <p class="text-yellow-200">{{$errors->first('time')}}</p>
          @endif
          @php
            $numbers = [
              ['nm'=>'人数','value'=>''],
              ['nm'=>'1人','value'=>'1'],
              ['nm'=>'2人','value'=>'2'],
              ['nm'=>'3人','value'=>'3'],
              ['nm'=>'4人','value'=>'4'],
              ['nm'=>'5人','value'=>'5'],
              ['nm'=>'6人','value'=>'6'],
              ['nm'=>'7人','value'=>'7'],
              ['nm'=>'8人','value'=>'8'],
              ['nm'=>'9人','value'=>'9'],
              ['nm'=>'10人','value'=>'10'],
            ]
          @endphp
          <div class="flex">
            <p class="text-white w-24 font-bold">Number</p>
            <select name="number_of_people" class="block w-full rounded-md h-8 text-xs">
              @foreach($numbers as $number)
                @if($reserve->number_of_people == $number['value'])
                <option value="{{$number['value']}}" selected>{{$number['nm']}}</option>
                @else
                <option value="{{$number['value']}}">{{$number['nm']}}</option>
                @endif
              @endforeach
            </select>
          </div>
          @if($errors->has('number_of_people'))
          <p class="text-yellow-200">{{$errors->first('number_of_people')}}</p>
          @endif
          <input type="hidden" name="shop_id" value="{{$reserve->shop_id}}">
          <input type="hidden" name="user_id" value="{{$reserve->user_id}}">
      </div>
      <button class="text-white block w-full bg-blue-700 h-14 rounded-b-lg">予約を変更する</button>
    </form>
    @endforeach
    @endif
  </div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
    isOpen: false,
    },
  })
</script>

@endsection