@extends('layouts.default')
@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-owner-header></x-owner-header>
  <div class="bg-gray-100 h-screen p-5" :class="isOpen ? 'hidden' : 'block' ">
    <h2 class="text-blue-500 border-b border-blue-400 text-2xl">@{{shop.shop_name}}の予約情報</h2>
    <table class="m-5">
      <tr class="h-10 border-b border-blue-400 ">
        <th class="text-blue-400 w-36">予約日</th>
        <th class="text-blue-400 w-36">予約時間</th>
        <th class="text-blue-400 w-36">人数</th>
        <th class="text-blue-400 w-36">予約者名</th>
      </tr>
      <tr v-for="item in items" class="h-14">
        <td class="text-center">@{{item.date | dayFormat}}</td>
        <td class="text-center">@{{item.date | timeFormat}}</td>
        <td class="text-center">@{{item.number_of_people}}人</td>
        <td class="text-center">
          <form :action="'/mailform/'+item.user_id" method="get">
            @csrf
            <input type="hidden" name="shop_name" :value="shop.shop_name">
            <button>@{{item.user.name}}</button>
          </form>
        </td>
      </tr>
    </table>
  </div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
      isOpen: false,
      items: @json($items),
      user: @json($user),
      shop: @json($shop)
    },
    filters: {
      dayFormat: function(value) {
        const date = new Date(value);
        const year = date.getFullYear();
        const month = ("0" +(date.getMonth()+1)).slice(-2);
        const day = ("0" +date.getDate()).slice(-2);
        const set = year+'-'+month+'-'+day;
        return set;
      },
      timeFormat: function(value){
        const date = new Date(value);
        const hour = date.getHours();
        const minutes = date.getMinutes()+'0';
        const set = hour+':'+minutes;
        return set;
      },
    }
  })
</script>
@endsection