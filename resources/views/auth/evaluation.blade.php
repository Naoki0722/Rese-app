@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <div v-if="user === null">
    <x-header></x-header>
  </div>
  <div v-else>
    <x-after-header></x-after-header>
  </div>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    <div class="m-auto w-11/12 h-3/4 flex justify-around">
      <div v-if="items" class="w-2/5">
        <h2>評価</h2>
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
      <form v-if="user" action="/evaluation" method="post" class="w-2/5">
        @csrf
        <div class="bg-blue-600 p-5 rounded-t-lg">
          <p class="text-white my-5 text-xl font-extrabold">評価：&#9733;&#9734;&#9734;&#9734;&#9734;〜&#9733;&#9733;&#9733;&#9733;&#9733;</p>
          <select name="evaluation" v-model="star"class="block w-full rounded-md h-8 text-xs">
            <option v-for="evaluation in evaluations" :value="evaluation.value" v-html="evaluation.ev"></option>
          </select>
          <p class="text-white my-5 text-xl font-extrabold">コメント</p>
          <textarea name="comment" rows="10" class="w-full rounded-md"></textarea>
          <input type="hidden" name="shop_id" :value="shop.id">
          <input type="hidden" name="user_id" :value="user.id">
        </div>
        <button class="text-white block w-full bg-blue-700 h-14 rounded-b-lg">評価を投稿する</button>
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
      shop: @json($shop),
      star:'',
      evaluations:[
        { ev:'選択してください', value:''},
        { ev: '&#9733;', value:'1'},
        { ev: '&#9733;&#9733;', value:'2'},
        { ev: '&#9733;&#9733;&#9733;', value:'3'},
        { ev: '&#9733;&#9733;&#9733;&#9733;', value:'4'},
        { ev: '&#9733;&#9733;&#9733;&#9733;&#9733;', value:'5'},
      ]
    }
  })
</script>
@endsection