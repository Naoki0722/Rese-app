@extends('layouts.default')
@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-header></x-header>
  <div class="bg-gray-100 h-screen p-5" :class="isOpen ? 'hidden' : 'block' ">
    <h2 class="text-blue-500 border-b border-blue-500 text-2xl">予約情報</h2>
    <table class="m-5">
      <tr class="h-10 border-b border-blue-400 ">
      <th class="text-blue-400">店舗名</th>
        <th class="text-blue-400 w-36">予約日</th>
        <th class="text-blue-400 w-36">予約時間</th>
        <th class="text-blue-400 w-36">人数</th>
        <th class="text-blue-400 w-36">予約者名</th>
      </tr>
      <tr class="h-14">
        <td class="text-center">@{{item[0].shop.shop_name}}</td>
        <td class="text-center">@{{item[0].date | dayFormat}}</td>
        <td class="text-center">@{{item[0].date | timeFormat}}</td>
        <td class="text-center">@{{item[0].number_of_people}}人</td>
        <td class="text-center">@{{item[0].user.name}}</td>
      </tr>
    </table>
  </div>
</div>
<script>
const app = new Vue({
  el: '#app',
  data: {
    isOpen: false,
    item: @json($item),
  },
  filters: {
    dayFormat: function(value){
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
    }
  }
})
</script>

@endsection