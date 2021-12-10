@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <div v-if="user.role === 'customer' || user.role === ''">
    <x-after-header></x-after-header>
  </div>
  <div v-else-if="user.role === 'admin'">
    <x-admin-header></x-admin-header>
  </div>
  <div v-else-if="user.role === 'owner'">
    <x-owner-header></x-owner-header>
  </div>
  <div class="bg-gray-100 " :class="isOpen ? 'hidden' : 'block' ">
    <div class="flex justify-around w-11/12 m-auto">
      <div class="w-4/12 md:w-6/12">
        <h2>予約状況</h2>
        <div v-if="reservedShops.length">
          <div v-for="(reservedShop,index) in reservedShops" class="p-5 mt-5 mb-16 bg-blue-600 rounded-md">
            <div class="flex justify-between ">
              <div class="flex items-center">
                <img src="../img/clock2.png" class="w-5 h-5">
                <p class="text-white ml-8 font-bold">予約@{{index + 1}}</p>
              </div>
              <form :action="'/reserved/delete/'+reservedShop.id" method="post">
              @csrf
                <button class="text-white text-2xl" onclick="return confirm('本当に削除しますか？')">&otimes;</button>
              </form>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white w-24 font-bold">Shop</p>
              <p class="inline-block text-white">@{{reservedShop.shop.shop_name}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white w-24 font-bold">Date</p>
              <p class="inline-block text-white">@{{ reservedShop.date | dayFormat}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white w-24 font-bold">Time</p>
              <p class="inline-block text-white">@{{reservedShop.date | timeFormat}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white w-24 font-bold">Number</p>
              <p class="inline-block text-white">@{{reservedShop.number_of_people}}人</p>
            </div>
            <div v-if="reservedShop.menu_id === 0" class="my-2.5">
              <p class="inline-block text-white w-24 font-bold">Menu</p>
              <p class="inline-block text-white">お席のみご予約</p>
            </div>
            <div v-else class="my-2.5">
              <p class="inline-block text-white w-24 font-bold">Menu</p>
              <p class="inline-block text-white">@{{reservedShop.menu.menu_name}}</p>
            </div>
            <div class="my-2.5 flex justify-between">
            <form :action="'/reservationchange/'+reservedShop.id" method="get">
              @csrf
              <button class="text-white">予約の変更</button>
            </form>
            <form :action="'/qrcode/'+reservedShop.id" method="get">
                @csrf
                <button class="text-white">QRコードの表示</button>
              </form>
            </div>
          </div>
        </div>
        <p v-else>予約がありません</p>
      </div>
      <div class="w-6/12 md:w-4/12">
        <h2>@{{user.name}}さん</h2>
        <p>お気に入り店舗</p>
        <div v-if="favorites" class="flex flex-wrap justify-around">
          <div v-for="favorite in favorites"class="w-2/5 h-64 m-3 bg-white rounded-md shadow-kk md:w-full">
            <img :src="favorite.shop.img" class="w-full h-3/5 rounded-t-md">
            <div class="p-2.5">
              <p class="font-semibold">@{{favorite.shop.shop_name}}</p>
              <p class="inline-block text-xs">#@{{favorite.shop.area.area}}</p>
              <p class="inline-block text-xs">#@{{favorite.shop.category.category}}</p>
              <div class="flex justify-between">
                <form :action="'/datail/:'+favorite.shop.id" method="get" class="inline-block">
                  @csrf
                  <button class="text-xs text-white font-medium rounded-md bg-blue-600 w-24 h-6">詳しくみる</button>
                </form>
                <form :action="'/favorite/delete/'+favorite.id" method="post">
                @csrf
                  <button class="text-red-400 text-3xl">&#9829;</button>
                </form>
              </div>
            </div>
          </div>
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
    reservedShops: @json($reservedShops),
    favorites: @json($favorites),
    user: @json($user),
  },
  filters: {
    dayFormat: function(value){
      const date = new Date(value);
      const year = date.getFullYear();
      const month = ("0" +(date.getMonth()+1)).slice(-2);
      const day = ("0" +date.getDate()).slice(-2);
      const set = year+'-'+month+'-'+day;
      return set;
    },
    timeFormat: function(value){
      const date = new Date(value);
      const hour = date.getHours();
      const minutes = date.getMinutes()+'0';
      const set = hour+':'+minutes;
      return set;
    }
  }
})
</script>
@endsection