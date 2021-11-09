@extends('layouts.default')
@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-owner-header></x-owner-header>
  <div class="bg-gray-100 h-screen p-5" :class="isOpen ? 'hidden' : 'block' ">
    <h2 class="text-blue-500 border-b border-blue-400 text-2xl">メール送信フォーム</h2>
    <form action="/mailconfirm" method="post">
    @csrf
      <div class="p-2.5 mt-5">
        <label class="inline-block text-blue-400 w-36">宛先</label>
        <p class="inline-block">@{{address.name}}</p>
        <p class="inline-block">&lt;@{{address.email}}&gt;</p>
        <input type="hidden" name="email" :value="address.email">
        <input type="hidden" name="name" :value="address.name">
      </div>
      <div class="p-2.5">
      <label class="inline-block text-blue-400 w-36">送信元</label>
      <p class="inline-block">@{{shopName}}</p>
      <input type="hidden" name="shop_name" :value="shopName">
      </div>
      <div class="p-2.5">
        <label class="inline-block text-blue-400 w-36">件名</label>
        <input type="text" name="subject" :value="subject" class="border-blue-400 rounded-md w-2/5">
      </div>
      <p v-if="subjectError" class="w-1/2 text-center text-red-300">@{{subjectError}}</p>
      <div class="p-2.5 h-36 flex items-center">
        <p class="inline-block text-blue-400 w-36">本文</p>
        <textarea name="message" rows="5" class="rounded-md border-blue-400 w-2/5">@{{message}}</textarea>
      </div>
      <p v-if="messageError" class="w-1/2 text-center text-red-300">@{{messageError}}</p>
      <div class="p-2.5 w-1/2 flex justify-center">
        <button class="inline-block w-24 text-blue-600 border-b border-blue-600">確認画面へ</button>
      </div>
    </form>
  </div>
</div>

<script>
  const app = new Vue({
    el: '#app',
    data: {
      isOpen: false,
      address: @json($address),
      user: @json($user),
      shopName: @json($shopName),
      subject: "{{ old('subject') }}",
      message: "{{ old('message') }}",
      subjectError: "{{ $errors->first('subject') }}",
      messageError: "{{ $errors->first('message') }}"
    },
  })
</script>
@endsection