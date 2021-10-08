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
        @if(@isset($user))
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
        @else
        <li class="text-center h-12"><a href="/login" class="text-blue-600 text-4xl font-medium">Login</a></li>
        @endif
        <li class="text-center h-12"><a href="/mypage" class="text-blue-600 text-4xl font-medium">Mypage</a></li>
      </ul>
    </div>
    <h1 class="text-blue-600 text-4xl pl-5" :class="isOpen ? 'hidden' : 'block' ">Rese</h1>
  </header>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    
    <div class="m-auto w-11/12 h-3/4 flex justify-around">
    @if(@isset($item))
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
    @endif
    @if(@isset($user))
      <form action="/reserve" method="post" class="w-2/5">
      @csrf
        <div class="bg-blue-600 p-5 rounded-t-lg">
          <p class="text-white my-5 text-xl font-extrabold">予約</p>
          <input type="date" name="day" v-model="day" value="{{ old('day') }}" class="rounded-md block mb-2.5 h-8 w-40 text-xs">
          @if($errors->has('day'))
          <p class="text-yellow-200">{{$errors->first('day')}}</p>
          @endif
          <select name="time" v-model="time" class="block w-full rounded-md mb-2.5 h-8 text-xs">
            <option value="">時間</option>
            <option value="16:00" @if(old('time') === '16:00') selected @endif>16:00</option>
            <option value="17:00" @if(old('time') === '17:00') selected @endif>17:00</option>
            <option value="18:00" @if(old('time') === '18:00') selected @endif>18:00</option>
            <option value="19:00" @if(old('time') === '19:00') selected @endif>19:00</option>
            <option value="20:00" @if(old('time') === '20:00') selected @endif>20:00</option>
            <option value="21:00" @if(old('time') === '21:00') selected @endif>21:00</option>
          </select>
          @if($errors->has('time'))
          <p class="text-yellow-200">{{$errors->first('time')}}</p>
          @endif
          <select name="number_of_people" v-model="numberOfPeople" class="block w-full rounded-md h-8 text-xs">
            <option value="" @if(old('number_of_people') == "") selected @endif>人数</option>
            <option value="1" @if(old('number_of_people') == "1") selected @endif>1人</option>
            <option value="2" @if(old('number_of_people') == "2") selected @endif>2人</option>
            <option value="3" @if(old('number_of_people') == "3") selected @endif>3人</option>
            <option value="4" @if(old('number_of_people') == "4") selected @endif>4人</option>
            <option value="5" @if(old('number_of_people') == "5") selected @endif>5人</option>
            <option value="6" @if(old('number_of_people') == "6") selected @endif>6人</option>
            <option value="7" @if(old('number_of_people') == "7") selected @endif>7人</option>
            <option value="8" @if(old('number_of_people') == "8") selected @endif>8人</option>
            <option value="9" @if(old('number_of_people') == "9") selected @endif>9人</option>
            <option value="10" @if(old('number_of_people') == "10") selected @endif>10人</option>
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
      @else
      <p class="w-2/5">ログインしてください</p>
      @endif
      
    </div>
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
