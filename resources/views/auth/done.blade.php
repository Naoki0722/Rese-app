@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased w-screen h-screen bg-gray-100">
  <div v-if="user.role === 'customer' || user.role === ''">
    <x-after-header></x-after-header>
  </div>
  <div v-else-if="user.role === 'admin'">
    <x-admin-header></x-admin-header>
  </div>
  <div v-else-if="user.role === 'owner'">
    <x-owner-header></x-owner-header>
  </div>
  <div class="min-h-screen flex sm:justify-center mt-28 pt-6 sm:pt-0 bg-gray-100" :class="isOpen ? 'hidden' : 'block' ">

  <div class="w-full h-52 sm:max-w-md px-6 py-4 bg-white overflow-hidden  rounded-md shadow-md flex justify-center items-center" >
    <div>
        <p class="mb-8 text-center text-2xl font-medium">ご予約ありがとうございます</p>
        <a href="/" class="w-16 h-8 m-auto block bg-blue-600 text-white rounded-md text-center align-middle">
          <button type="button" class="inline-block my-1">戻る</button>
        </a>
        </div>
  </div>
    
</div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
    isOpen: false,
    user: @json($user),
    },
  })
</script>
@endsection