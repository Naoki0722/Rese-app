@extends('layouts.default')

@section('content')

<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  
  <header class="pl-20 bg-gray-100 p-6 flex justify-between relative">
  <div class="flex">
    <div @click="isOpen = !isOpen" class="pl-2 pt-1 h-10 w-10 bg-blue-600 rounded-md shadow-kk inline-block justify-center items-center cursor-pointer">
      <div class="h-2 w-4 border-b"></div>
      <div class="h-2 w-5 border-b"></div>
      <div class="h-2 w-4 border-b"></div>
    </div>
  
    <h1 class="text-blue-600 text-4xl pl-5 inline-block" :class="isOpen ? 'hidden' : 'block' ">Rese</h1>
  </div>
  <div>
    <select name="area" v-model="area">
      <option hiiden value="">All area</option>
      <option value="東京都">東京都</option>
      <option value="大阪府">大阪府</option>
      <option value="福岡県">福岡県</option>
    </select>
    <select name="category" v-model="category">
      <option hiiden value="">All genre</option>
      <option value="寿司">寿司</option>
      <option value="焼肉">焼肉</option>
      <option value="居酒屋">居酒屋</option>
      <option value="イタリアン">イタリアン</option>
      <option value="ラーメン">ラーメン</option>
    </select>
    <input type="text" placeholder="search" v-model="keyword">
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
</header>
  <div class="bg-gray-100">
    <div class="flex flex-wrap w-11/12 m-auto justify-around " :class="isOpen ? 'hidden' : 'block' ">
    
      <div v-for="item in filteredShops" :key="item.id" class="w-1/5 h-64 m-3 bg-white rounded-md shadow-kk" >
        <img :src="item.img" class="w-full h-3/5 rounded-t-md">
        <div class="p-2.5">
          <p class="font-semibold">@{{item.shop_name}}</p>
          <p class="inline-block text-xs">#@{{item.area.area}}</p>
          <p class="inline-block text-xs">#@{{item.category.category}}</p>
          <div class="flex justify-between">
            <form :action="'/datail/:'+item.id" method="get" class="inline-block">
              @csrf
              <button class="text-xs text-white font-medium rounded-md bg-blue-600 w-24 h-6">詳しくみる</button>
            </form>
            @if(@isset($user))
            <form v-if="item.favorites == 0" :action="'/favorite/add/'+item.id" method="post">
              @csrf
              <button class="text-3xl">&#9825;</button>
            </form>
            <div v-else>
              <div v-for="favorite in item.favorites" :key="favorite.id">
                <form :action="'/favorite/delete/'+favorite.id" method="post">
                  @csrf
                  <button class="text-red-400 text-3xl">&#9829;</button>
                </form>
              </div>
            </div>
            @endif
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
    favorite: false,
    items: @json($items),
    user: @json($user),
    keyword:'',
    category:'',
    area:'',
  },
  computed: {
    filteredShops:function(){
      var shops =[];
      for (var i in this.items){
        var shop = this.items[i];
        if(shop.area.area.indexOf(this.area) !== -1 && shop.shop_name.indexOf(this.keyword) !== -1 && shop.category.category.indexOf(this.category) !== -1){
          shops.push(shop);
        }
      }
      return shops;
    }
  },
  
})

</script>
@endsection







