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
  <div class="bg-gray-100 " :class="isOpen ? 'hidden' : 'block' ">
    <h2 class="text-center">↓↓来店時、店舗スタッフに見せてください↓↓</h2>
    <div class="w-28 m-auto mt-5">
      {!! QrCode::generate(route('reservationdatails',['id' => $item[0]->id])) !!}
    </div>
  </div>
</div>
<script>
const app = new Vue({
  el: '#app',
  data: {
    isOpen: false,
    item: @json($item),
    user: @json($user),
  },
})
</script>
@endsection