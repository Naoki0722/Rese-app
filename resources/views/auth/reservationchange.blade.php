@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <x-after-header></x-after-header>
  <div class="bg-gray-100 h-screen" :class="isOpen ? 'hidden' : 'block' ">
    <p class="text-blue-600 text-center text-2xl font-bold my-5">予約変更</p>
    <div v-for="reserved in item">
    <form :action="'/reservationchange/'+reserved.id" method="post" class="w-2/5 m-auto md:w-3/5">
      @csrf
      <div class="bg-blue-600 p-5 rounded-t-lg">
        <div class="flex mb-2.5">
          <p class="text-white w-24 font-bold">Shop</p>
          <p class="text-white">@{{reserved.shop.shop_name}}</p>
        </div>
        <div class="flex">
          <p class="text-white w-24 font-bold">Day</p>
          <input type="date" name="day" v-model="day" class="rounded-md block mb-2.5 h-8 w-full text-xs">
        </div>
          <p class="text-yellow-200">{{$errors->first('day')}}</p>
          <div class="flex">
            <p class="text-white w-24 font-bold">Time</p>
            <select name="time" v-model="time" class="block w-full rounded-md mb-2.5 h-8 text-xs">
              <option v-for="setTime in times" :key="setTime.tm" :value="setTime.value">@{{setTime.tm}}</option>
            </select>
          </div>
          <p v-if="timeError" class="text-yellow-200">@{{timeError}}</p>
          <div class="flex">
            <p class="text-white w-24 font-bold">Number</p>
            <select name="number_of_people" v-model="numberOfPeople" class="block w-full rounded-md mb-2.5 h-8 text-xs">
              <option v-for="setNumber in numbers" :key="setNumber.nm" :value="setNumber.value">@{{setNumber.nm}}</option>
            </select>
          </div>
          <p v-if="numberOfPeopleError" class="text-yellow-200">@{{numberOfPeopleError}}</p>
          <input type="hidden" name="shop_id" :value="reserved.shop.id">
          <input type="hidden" name="user_id" :value="reserved.user_id">
      </div>
      <button class="text-white block w-full bg-blue-700 h-14 rounded-b-lg">予約を変更する</button>
    </form>
    </div>
  </div>
</div>
<script>
  const app = new Vue({
    el: '#app',
    data: {
      isOpen: false,
      item: @json($item),
      day: '',
      dayError:"{{$errors->first('day')}}",
      time: '',
      timeError:"{{$errors->first('time')}}",
      numberOfPeople: '',
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
    },
    methods: {
      dayFormat: function(value){
        const date = new Date(value);
        const year = date.getUTCFullYear();
        const month = date.getUTCMonth()+1;
        const day = date.getUTCDate();
        const set = year+'-'+month+'-'+day;
        return this.day = set;
      },
      timeFormat: function(value){
        const date = new Date(value);
        const hour = date.getUTCHours();
        const minutes = date.getUTCMinutes()+'0';
        const set = hour+':'+minutes;
        return this.time = set;
      },
      format: function(){
        this.dayFormat(this.day);
        this.timeFormat(this.time);
        console.log(this.day);
        console.log(this.time);
      }
    },
    created: function(){
      this.day = this.item[0].date;
      this.time = this.item[0].date;
      this.numberOfPeople = this.item[0].number_of_people;
      console.log(this.numberOfPeople);
      this.format();
    }
  })
</script>

@endsection