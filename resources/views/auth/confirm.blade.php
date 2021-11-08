@extends('layouts.default')
@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-owner-header></x-owner-header>
  <h2 class="text-blue-500 border-b border-blue-400 text-2xl m-5">送信内容確認</h2>
  <div class="p-2.5 mt-5 ml-5">
    <label class="inline-block text-blue-400 w-36">宛先</label>
    <p class="inline-block">@{{name}}</p>
    <p class="inline-block">&lt;@{{mail.email}}&gt;</p>
  </div>
  <div class="p-2.5 ml-5">
    <label class="inline-block text-blue-400 w-36">件名</label>
    <p class="inline-block">@{{mail.subject}}</p>
  </div>
  <div class="p-2.5 ml-5">
    <label class="inline-block text-blue-400 w-36">本文</label>
    <p class="inline-block">@{{mail.message}}</p>
  </div>
  <div class="p-2.5 w-1/2 flex justify-center">
    <button type="button" onclick="window.history.back()" class="inline-block w-24 text-blue-600 border-b border-blue-600">戻る</button>
  </div>
  <form action="/sendmail" method="post">
    @csrf
    <input type="hidden" name="email" :value="mail.email">
    <div class="p-2.5 w-1/2 flex justify-center">
      <button class="inline-block w-24 text-blue-600 border-b border-blue-600">送信</button>
    </div>
  </form>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
      isOpen: false,
      name: @json($name),
      mail: @json($mail),
      user: @json($user)
    },
  })
</script>
@endsection