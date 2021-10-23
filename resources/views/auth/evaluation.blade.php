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
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    <div class="m-auto w-11/12 h-3/4 flex justify-around md:block md:w-full">
      <div v-if="items.length" class="w-2/5 md:w-3/5 md:m-auto">
        <h2>@{{shop.shop_name}}の評価</h2>
        <div v-for="item in items" class="p-5 mt-5 mb-16 bg-blue-600 rounded-md">
          <div class="my-2.5">
            <p class="inline-block text-white w-24 font-bold">User</p>
            <p class="inline-block text-white">@{{item.user.name}}</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white w-24 font-bold">Evaluation</p>
            <p v-if="item.evaluation === 1" class="inline-block text-white">&#9733;&#9734;&#9734;&#9734;&#9734;</p>
            <p v-else-if="item.evaluation === 2" class="inline-block text-white">&#9733;&#9733;&#9734;&#9734;&#9734;</p>
            <p v-else-if="item.evaluation === 3" class="inline-block text-white">&#9733;&#9733;&#9733;&#9734;&#9734;</p>
            <p v-else-if="item.evaluation === 4" class="inline-block text-white">&#9733;&#9733;&#9733;&#9733;&#9734;</p>
            <p v-else-if="item.evaluation === 5" class="inline-block text-white">&#9733;&#9733;&#9733;&#9733;&#9733;</p>
          </div>
          <div class="my-2.5">
            <p class="inline-block text-white w-24 font-bold">Comment</p>
            <p class="inline-block text-white">@{{item.comment}}</p>
          </div>
        </div>
      </div>
      <p v-else>まだ@{{shop.shop_name}}の評価がありません</p>
      <form v-if="user" action="/evaluation" method="post" class="bg-gray-100 w-2/5 md:w-full">
        @csrf
        <div class="bg-blue-500 p-5 rounded-t-lg md:w-3/5 md:m-auto">
          <label class="font-extrabold inline-block text-white">評価：</label>
          <p class="text-white my-5 text-xl inline-block">&#9733;&#9734;&#9734;&#9734;&#9734;〜&#9733;&#9733;&#9733;&#9733;&#9733;</p>
          <select name="evaluation" v-model="star"class="block w-full rounded-md h-8 text-xs">
            <option v-for="evaluation in evaluations" :value="evaluation.value" v-html="evaluation.ev"></option>
          </select>
          <p v-if="evaluationError" class="text-yellow-200">@{{evaluationError}}</p>
          <p class="text-white my-5 text-xl font-extrabold">コメント</p>
          <textarea name="comment" rows="10" class="w-full rounded-md"></textarea>
          <p v-if="commentError" class="text-yellow-200">@{{commentError}}</p>
          <input type="hidden" name="shop_id" :value="shop.id">
          <input type="hidden" name="user_id" :value="user.id">
        </div>
        <button class="text-white block w-full bg-blue-600 h-14 rounded-b-lg md:w-3/5 md:m-auto">評価を投稿する</button>
      </form>
      <p v-else>ログインすると評価を投稿できます</p>
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
      shop: @json($shop),
      star:'',
      evaluations:[
        { ev:'選択してください', value:''},
        { ev: '&#9733;', value:'1'},
        { ev: '&#9733;&#9733;', value:'2'},
        { ev: '&#9733;&#9733;&#9733;', value:'3'},
        { ev: '&#9733;&#9733;&#9733;&#9733;', value:'4'},
        { ev: '&#9733;&#9733;&#9733;&#9733;&#9733;', value:'5'},
      ],
      evaluationError:"{{$errors->first('evaluation')}}",
      commentError:"{{$errors->first('comment')}}",
    }
  })
</script>
@endsection