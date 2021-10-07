@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-after-header></x-after-header>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    @if(@isset($item,$user))
    <div class="m-auto w-11/12 h-3/4 flex justify-around">
      <div class="w-2/5">
        <div class="my-5">
          <button onclick="window.history.back()" class="inline-block w-8 h-8 bg-white shadow-kk rounded-md">&lt;</button>
          <p class="inline-block text-xl font-extrabold ml-2.5">{{$item->shop_name}}</p>
        </div>
        <div>
          <img src="{{$item->img}}" class="w-full h-4/5">
          <p class="inline-block my-5">#{{$item->area->area}}</p>
          <p class="inline-block my-5">#{{$item->category->category}}</p>
          <p class="">{{$item->overview}}</p>
        </div>
      </div>
      <form action="/reserve" method="post" class="w-2/5">
      @csrf
        <div class="bg-blue-600 p-5 rounded-t-lg">
          <p class="text-white my-5 text-xl font-extrabold">予約</p>
          <input type="date" name="day" v-model="day" class="rounded-md block mb-2.5 h-8 w-40 text-xs">
          @if($errors->has('day'))
          <p class="text-yellow-200">{{$errors->first('day')}}</p>
          @endif
          <select name="time" v-model="time" class="block w-full rounded-md mb-2.5 h-8 text-xs">
            <option hiiden value="">時間</option>
            <option value="16:00">16:00</option>
            <option value="17:00">17:00</option>
            <option value="18:00">18:00</option>
            <option value="19:00">19:00</option>
            <option value="20:00">20:00</option>
            <option value="21:00">21:00</option>
          </select>
          @if($errors->has('time'))
          <p class="text-yellow-200">{{$errors->first('time')}}</p>
          @endif
          <select name="number_of_people" v-model="numberOfPeople" class="block w-full rounded-md h-8 text-xs">
            <option hiiden value="">人数</option>
            <option value="1">1人</option>
            <option value="2">2人</option>
            <option value="3">3人</option>
            <option value="4">4人</option>
            <option value="5">5人</option>
            <option value="6">6人</option>
            <option value="7">7人</option>
            <option value="8">8人</option>
            <option value="9">9人</option>
            <option value="10">10人</option>
          </select>
          @if($errors->has('number_of_people'))
          <p class="text-yellow-200">{{$errors->first('number_of_people')}}</p>
          @endif
          <input type="hidden" name="shop_id" value="{{$item->id}}">
          <input type="hidden" name="user_id" value="{{$user->id}}">
          @if($errors->has('user_id'))
          <p class="text-yellow-200">{{$errors->first('user_id')}}</p>
          @endif
          <div class="p-5 mt-5 mb-16 bg-blue-500 rounded-md">
            <div class="my-2.5">
              <p class="inline-block text-white">Shop</p>
              <p class="inline-block text-white ml-8">{{$item->shop_name}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white">Date</p>
              <p class="inline-block text-white ml-8">@{{day}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white">Time</p>
              <p class="inline-block text-white ml-8">@{{time}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white">Number</p>
              <p class="inline-block text-white ml-8">@{{numberOfPeople}}</p>
            </div>
          </div>
        </div>
        <button class="text-white block w-full bg-blue-700 h-14 rounded-b-lg">予約する</button>
      </form>
    </div>
    @endif
  </div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
    isOpen: false,
    day:'',
    time:'',
    numberOfPeople:'',
    },
  })
</script>

@endsection
