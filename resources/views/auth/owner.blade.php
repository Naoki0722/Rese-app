@extends('layouts.default')
@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-owner-header></x-owner-header>
  <div class="bg-gray-100 h-screen p-5" :class="isOpen ? 'hidden' : 'block' ">
    <h2 class="text-blue-500 border-b border-blue-500 text-2xl">店舗情報</h2>
    <div v-if="items.length === 0">
      <p>まだ登録されている店舗がありません</p>
    </div>
    <div v-else>
      <div v-for="item in items" class="p-2.5">
        <div class="inline-block">
          <label class="inline-block text-blue-400 w-36">店舗名</label>
          <p class="inline-block">@{{item.shop_name}}</p>
        </div>
        <form :action="'/shopupdate/'+item.id" method="get" class="inline-block ml-28">
          @csrf
          <button class="text-blue-400">店舗情報の編集</button>
        </form>
        <form :action="'/reservationinfo/'+item.id" method="get" class="inline-block ml-16">
        @csrf
        <button class="text-blue-400">予約確認</button>
        </form>
      </div>
    </div>
    <div>
      <h2 class="text-blue-500 border-b border-blue-500 text-2xl">店舗情報作成</h2>
      <form action="/shopinfocreate" method="post" enctype="multipart/form-data">
      @csrf
      <div class="p-2.5 mt-5">
        <label class="inline-block text-blue-400 w-36">店舗名</label>
        <input type="text" name="shop_name" class="border-blue-400 rounded-md w-2/5">
        <p v-if="nameError" class="w-1/2 text-center text-red-300">@{{nameError}}</p>
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">エリア</label>
        <select name="area_id" class="border-blue-400 rounded-md w-2/5">
          <option v-for="area in areas" :value="area.id">@{{area.area}}</option>
        </select>
        <p v-if="areaError" class="w-1/2 text-center text-red-300">@{{areaError}}</p>
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">カテゴリー</label>
        <select name="category_id" class="border-blue-400 rounded-md w-2/5">
          <option v-for="category in categories" :value="category.id">@{{category.category}}</option>
        </select>
        <p v-if="categoryError" class="w-1/2 text-center text-red-300">@{{categoryError}}</p>
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">画像</label>
        <input type="file" name="img">
        <p v-if="imgError" class="w-1/2 text-center text-red-300">@{{imgError}}</p>
      </div>
      <div class="p-2.5 h-36 flex items-center">
        <p class="inline-block text-blue-400 w-36">説明文</p>
        <textarea name="overview" rows="5" class="rounded-md border-blue-400 w-2/5"></textarea>
        <input type="hidden" name="owner_id" :value="user.id">
      </div>
      <p v-if="overviewError" class="w-1/2 text-center text-red-300">@{{overviewError}}</p>
      <div class="p-2.5 w-1/2 flex justify-center">
        <button class="inline-block w-24 text-blue-600 border-b border-blue-600">作成する</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
      isOpen: false,
      items: @json($items),
      user: @json($user),
      areas: @json($areas),
      categories: @json($categories),
      imgs:[
        { img:'選択してください', value:''},
        { img: '寿司用', value: '../img/sushi.jpeg'},
        { img: '焼肉用', value: '../img/yakiniku.jpeg'},
        { img: '居酒屋用', value: '../img/izakaya.jpeg'},
        { img: 'イタリアン用', value: '../img/italian.jpeg'},
        { img: 'ラーメン用', value: '../img/ramen.jpeg'},
      ],
      nameError:"{{$errors->first('shop_name')}}",
      areaError:"{{$errors->first('area_id')}}",
      categoryError:"{{$errors->first('category_id')}}",
      overviewError:"{{$errors->first('overview')}}",
      imgError:"{{$errors->first('img')}}"
    },
    created:function(){
        const addArea = {id:'',area:'選択してください'};
        this.areas.unshift(addArea);
        const addCategory = {id:'',category:'選択してください'};
        this.categories.unshift(addCategory);
      }
  })
</script>
@endsection