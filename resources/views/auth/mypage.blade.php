@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-after-header></x-after-header>
  <div class="bg-gray-100 " :class="isOpen ? 'hidden' : 'block' ">
    <div class="flex justify-around w-11/12 m-auto">
      <div class="w-4/12">
        <h2>予約状況</h2>

        @if(@isset($reservedShops))
        @foreach($reservedShops as $reservedShop)
        
        <div class="p-5 mt-5 mb-16 bg-blue-600 rounded-md">
          <div class="flex justify-between ">
            <div class="flex">
              <img src="../img/clock.jpeg" class="w-10 h-10">
              <p>予約{{$loop->iteration}}</p>
            </div>
            <form action="/reserved/delete/{{$reservedShop->id}}" method="post">
            @csrf
              <button class="text-white">&otimes;</button>
            </form>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white">Shop</p>
            <p class="inline-block text-white ml-8">{{$reservedShop->shop->shop_name}}</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white">Date</p>
            <p class="inline-block text-white ml-8">{{$reservedShop['date']->format('Y-m-d')}}</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white">Time</p>
            <p class="inline-block text-white ml-8">{{$reservedShop['date']->format('H:s')}}</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white">Number</p>
            <p class="inline-block text-white ml-8">{{$reservedShop->number_of_people}}人</p>
          </div>
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
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
    isOpen: false,
    reserveCount:1,
    },
  })
</script>
@endsection