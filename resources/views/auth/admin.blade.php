@extends('layouts.default')
@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-admin-header></x-admin-header>
  <p>@{{user}}</p>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    <p class="text-blue-600 text-center text-2xl font-bold my-5">管理者ページ</p>
    <form action="/addowner" method="post" class="w-2/5 m-auto md:w-3/5">
    @csrf
    <div class="bg-blue-600 p-5 rounded-t-lg">
      <div class="flex">
          <p class="text-white w-24 font-bold">Name</p>
          <input type="text" name="name" class="rounded-md block mb-2.5 h-8 w-full text-xs">
        </div>
        <div class="flex">
          <p class="text-white w-24 font-bold">Email</p>
          <input type="email" name="email" class="rounded-md block mb-2.5 h-8 w-full text-xs">
        </div>
        <div class="flex">
          <p class="text-white w-24 font-bold">Password</p>
          <input type="text" name="password" class="rounded-md block mb-2.5 h-8 w-full text-xs">
        </div>
        <input type="hidden" name="role" value="owner">
        </div>
        <button class="text-white block w-full bg-blue-700 h-14 rounded-b-lg">登録</button>
    </form>
  </div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
      isOpen: false,
      item: '',
      user: @json($user),
    }
  })
</script>
@endsection