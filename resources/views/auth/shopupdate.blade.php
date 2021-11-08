@extends('layouts.default')
@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-owner-header></x-owner-header>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    <div>
      <h2 class="text-blue-400 border-b border-blue-400 text-2xl">店舗情報更新</h2>
      <form :action="'/shopupdate/'+items.id" method="post" enctype="multipart/form-data" class="bg-gray-100 m-5">
      @csrf
      <div class="p-2.5 mt-5">
        <label class="inline-block text-blue-400 w-36">店舗名</label>
        <input type="text" name="shop_name" class="border-blue-400 rounded-md w-2/5" :value="items.shop_name">
        <p v-if="nameError" class="w-1/2 text-center text-red-300">@{{nameError}}</p>
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">エリア</label>
        <select name="area_id" v-model="areaId" class="border-blue-400 rounded-md w-2/5">
          <option v-for="area in areas" :value="area.id">@{{area.area}}</option>
        </select>
        <p v-if="areaError" class="w-1/2 text-center text-red-300">@{{areaError}}</p>
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">カテゴリー</label>
        <select name="category_id" v-model="categoryId" class="border-blue-400 rounded-md w-2/5">
          <option v-for="category in categories" :value="category.id">@{{category.category}}</option>
          <p v-if="categoryError" class="w-1/2 text-center text-red-300">@{{categoryError}}</p>
        </select>
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">画像</label>
        <input type="file" name="img">
        <p v-if="imgError" class="w-1/2 text-center text-red-300">@{{imgError}}</p>
      </div>
      <div class="p-2.5 flex items-center">
        <label class="inline-block text-blue-400 w-36">現在の画像</label>
        <img :src="items.img" class="w-1/5 h-3/5">
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">説明文</label>
        <textarea name="overview" rows="5" class="rounded-md border-blue-400 w-2/5">@{{items.overview}}</textarea>
        <input type="hidden" name="owner_id" :value="user.id">
      </div>
      <p v-if="overviewError" class="w-1/2 text-center text-red-300">@{{overviewError}}</p>
      <div class="p-2.5 w-1/2 flex justify-center">
        <button class="inline-block w-24 text-blue-600 border-b border-blue-600">更新する</button>
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
        { img: '寿司用', value: '../img/sushi.jpeg'},
        { img: '焼肉用', value: '../img/yakiniku.jpeg'},
        { img: '居酒屋用', value: '../img/izakaya.jpeg'},
        { img: 'イタリアン用', value: '../img/italian.jpeg'},
        { img: 'ラーメン用', value: '../img/ramen.jpeg'},
      ],
      categoryId:'',
      areaId:'',
      imgPath:'',
      nameError:"{{$errors->first('shop_name')}}",
      areaError:"{{$errors->first('area_id')}}",
      categoryError:"{{$errors->first('category_id')}}",
      overviewError:"{{$errors->first('overview')}}",
      imgError:"{{$errors->first('img')}}",
    },
    created: function(){
      this.categoryId = this.items.category_id;
      this.areaId = this.items.area_id;
      this.imgPath = this.items.img;
    }
  })
</script>
@endsection