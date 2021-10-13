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
  @if(@isset($user))
  <div class="bg-gray-100 " :class="isOpen ? 'hidden' : 'block' ">
    <div class="flex justify-around w-11/12 m-auto">
      <div class="w-4/12">
        <h2>予約状況</h2>

        @if(@isset($reservedShops))
        @foreach($reservedShops as $reservedShop)
        
        <div class="p-5 mt-5 mb-16 bg-blue-600 rounded-md">
          <div class="flex justify-between ">
            <div class="flex items-center">
              <img src="../img/clock2.png" class="w-5 h-5">
              <p class="text-white ml-8 font-bold">予約{{$loop->iteration}}</p>
            </div>
            <form action="/reserved/delete/{{$reservedShop->id}}" method="post">
            @csrf
              <button class="text-white text-2xl">&otimes;</button>
            </form>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white w-24 font-bold">Shop</p>
            <p class="inline-block text-white">{{$reservedShop->shop->shop_name}}</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white w-24 font-bold">Date</p>
            <p class="inline-block text-white">{{$reservedShop['date']->format('Y-m-d')}}</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white w-24 font-bold">Time</p>
            <p class="inline-block text-white">{{$reservedShop['date']->format('H:s')}}</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white w-24 font-bold">Number</p>
            <p class="inline-block text-white">{{$reservedShop->number_of_people}}人</p>
          </div>
          <form action="/reservationchange/{{$reservedShop->id}}" method="get">
          @csrf
          <button class="text-white">予約の変更</button>
          </form>
        </div>
        @endforeach
        @endif
      </div>
      <div class="w-6/12">
        @if(@isset($user))
        <h2>{{$user->name}}さん</h2>
        @endif
        <p>お気に入り店舗</p>
        <div class="flex flex-wrap justify-around">
          @if(@isset($favorites))
          @foreach($favorites as $favorite)
          <div class="w-2/5 h-64 m-3 bg-white rounded-md shadow-kk">
            <img src="{{$favorite->shop->img}}" class="w-full h-3/5 rounded-t-md">
            <div class="p-2.5">
              <p class="font-semibold">{{$favorite->shop->shop_name}}</p>
              <p class="inline-block text-xs">#{{$favorite->shop->area->area}}</p>
              <p class="inline-block text-xs">#{{$favorite->shop->category->category}}</p>
              <div class="flex justify-between">
                <form action="datail/:{{$favorite->shop->id}}" method="get" class="inline-block">
                  @csrf
                  <button class="text-xs text-white font-medium rounded-md bg-blue-600 w-24 h-6">詳しくみる</button>
                </form>
                <form action="/favorite/delete/{{$favorite->id}}" method="post">
                @csrf
                  <button class="text-red-400 text-3xl">&#9829;</button>
                </form>
              </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
  @else
      <p class="text-center text-blue-600" :class="isOpen ? 'hidden' : 'block' ">ログインしてください</p>
  @endif
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