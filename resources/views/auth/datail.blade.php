@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <div v-if="user.role === 'customer' || user.role === '' || !user">
    <x-after-header></x-after-header>
  </div>
  <div v-else-if="user.role === 'admin'">
    <x-admin-header></x-admin-header>
  </div>
  <div v-else-if="user.role === 'owner'">
    <x-owner-header></x-owner-header>
  </div>
  <div v-else>
    <x-header></x-header>
  </div>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    <div class="m-auto w-11/12 h-3/4 flex justify-around md:block md:w-full ">
      <div v-if="item" class="w-2/5 md:w-3/5 md:m-auto">
        <div class="my-5 flex justify-between">
          <div>
            <button type="button" onclick="window.history.back()" class="inline-block w-8 h-8 bg-white shadow-kk rounded-md">&lt;</button>
            <p class="inline-block text-xl font-extrabold ml-2.5">@{{item.shop_name}}</p>
          </div>
          <form :action="'/evaluation/'+item.id" method="get">
          @csrf
          <button>評価を見る</button>
          </form>
        </div>
        <div>
          <img :src="item.img" class="w-full h-4/5">
          <p class="inline-block my-5">#@{{item.area.area}}</p>
          <p class="inline-block my-5">#@{{item.category.category}}</p>
          <p>@{{item.overview}}</p>
        </div>
      </div>

      <form v-if="user" action="/reserve" method="post" class="bg-gray-100 w-2/5 md:w-full md:pt-7">
        @csrf
        <div class="bg-blue-600 p-5 rounded-t-lg md:w-3/5 md:m-auto">
          <p class="text-white my-5 text-xl font-extrabold">予約</p>
          <input type="date" name="day" v-model="day" class="rounded-md block mb-2.5 h-8 w-40 text-xs">
          <p v-if="dayError" class="text-yellow-200">@{{dayError}}</p>
          <select name="time" v-model="time" class="block w-full rounded-md mb-2.5 h-8 text-xs">
            <option v-for="time in times" :value="time.value">@{{time.tm}}</option>
          </select>
          <p v-if="timeError" class="text-yellow-200">@{{timeError}}</p>
          <select name="number_of_people" v-model="numberOfPeople" class="block w-full rounded-md h-8 text-xs">
            <option v-for="number in numbers" :value="number.value">@{{number.nm}}</option>
          </select>
          <p v-if="numberOfPeopleError" class="text-yellow-200">@{{numberOfPeopleError}}</p>
          <input type="hidden" name="shop_id" :value="item.id">
          <input type="hidden" name="user_id" :value="user.id">
          <div class="p-5 mt-5 mb-16 bg-blue-500 rounded-md">
            <div class="my-2.5">
              <p class="inline-block text-white">Shop</p>
              <p class="inline-block text-white ml-8">@{{item.shop_name}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white">Date</p>
              <p class="inline-block text-white ml-8">@{{day}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white">Time</p>
              <p class="inline-block text-white ml-8">@{{time}}</p>
            </div>
            <div class="my-2.5">
              <p class="inline-block text-white">Number</p>
              <p class="inline-block text-white ml-8">@{{numberOfPeople}}</p>
            </div>
          </div>
        </div>
        <button class="text-white block w-full bg-blue-700 h-14 rounded-b-lg md:w-3/5 md:m-auto">予約する</button>
      </form>
      <p v-else class="w-2/5 md:text-center md:m-auto md:mt-20">ログインすると予約できます</p>
    </div>
  </div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
    isOpen: false,
    day:"{{ old('day') }}",
    dayError:"{{$errors->first('day')}}",
    time:"{{ old('time') }}",
    timeError:"{{$errors->first('time')}}",
    numberOfPeople:"{{ old('number_of_people') }}",
    numberOfPeopleError:"{{$errors->first('number_of_people')}}",
    numbers:[
      { nm:'人数', value:''},
      { nm:'1人', value:'1'},
      { nm:'2人',value:'2'},
      { nm:'3人',value:'3'},
      { nm:'4人',value:'4'},
      { nm:'5人',value:'5'},
      { nm:'6人',value:'6'},
      { nm:'7人',value:'7'},
      { nm:'8人',value:'8'},
      { nm:'9人',value:'9'},
      { nm:'10人',value:'10'},
    ],
    times:[
      { tm:'時間', value:''},
      { tm:'16:00', value:'16:00'},
      { tm:'17:00', value:'17:00'},
      { tm:'18:00', value:'18:00'},
      { tm:'19:00', value:'19:00'},
      { tm:'20:00', value:'20:00'},
      { tm:'21:00', value:'21:00'},
    ],
    user: @json($user),
    item: @json($item),
    },
  })
</script>

@endsection