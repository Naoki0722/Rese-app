@extends('layouts.default')

@section('content')

<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  
  <x-home-header></x-home-header>
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







