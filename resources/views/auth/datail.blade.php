@extends('layouts.default')

@section('content')
<div id="app" class="font-sans text-gray-900 antialiased h-screen w-screen  bg-gray-100">
  <div v-if="user">
    <div v-if="user.role === 'customer' || user.role === '' || !user">
      <x-after-header></x-after-header>
    </div>
    <div v-else-if="user.role === 'admin'">
      <x-admin-header></x-admin-header>
    </div>
    <div v-else-if="user.role === 'owner'">
      <x-owner-header></x-owner-header>
    </div>
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
          <select name="number_of_people" v-model="numberOfPeople" class="block w-full rounded-md mb-2.5 h-8 text-xs">
            <option v-for="number in numbers" :value="number.value">@{{number.nm}}</option>
          </select>
          <p v-if="numberOfPeopleError" class="text-yellow-200">@{{numberOfPeopleError}}</p>
          <select v-model="selectMenu" class="block w-full rounded-md mb-2.5 h-8 text-xs">
            <option :value="{id:'',menu:'',price:''}">コースを選択してください</option>
            <option v-for="menu in menus" :value="{id:menu.id, menu:menu.menu_name, price:menu.price}">@{{menu.menu_name}}</option>
          </select>
          <p v-if="selectMenuError" class="text-yellow-200">@{{selectMenuError}}</p>
          <input type="hidden" name="shop_id" :value="item.id">
          <input type="hidden" name="user_id" :value="user.id">
          <input type="hidden" name="menu" :value="selectMenu['id']">
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
            <div class="my-2.5">
              <p class="inline-block text-white">Menu</p>
              <p class="inline-block text-white ml-8">@{{selectMenu['menu']}}</p>
            </div>
          </div>
        </div>
        <button class="text-white block w-full bg-blue-700 h-14 rounded-b-lg md:w-3/5 md:m-auto">予約する</button>
      </form>
      <p v-else class="w-2/5 md:text-center md:m-auto md:mt-20">ログインすると予約できます</p>
    </div>
  </div>
</div>
<div class="py-12 bg-gray-100" :class="isOpen ? 'hidden' : 'block' ">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <h2>購入</h2>
        <form id="setup-form" action="/pay" method="post">
          @csrf
          {{-- <input type="hidden" name="price" :value="selectMenu.price"> --}}
          <input type="hidden" name="price" value="20000">
          <input id="card-holder-name" type="text" placeholder="カード名義人" name="card-holder-name">
          <div id="card-element"></div>
          <button id="card-button">購入</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
/**
* stripeインスタンスの生成
* 支払いフォームはstripeのUIに任せる
* 支払い方法は一回限りの決済を利用
*/
const stripe = Stripe('pk_test_51I9UrdGfr486TDLv6kvnsBtlrMuR3U041eg5HmUHUSUjrUa6dgWvM5rCTRzitv3Ox4y4jix1Cb6tqtltLW2sP4mF001nJ3V5oE');
const elements = stripe.elements();//elementは支払いフォームで機密情報を収集するためのUIコンポーネント
const cardElement = elements.create('card');//カードトークンの作成
cardElement.mount('#card-element');//id=card-elementに支払いフォームをマウント
const cardHolderName = document.getElementById('card-holder-name');//カード名義人のinput取得
const cardButton = document.getElementById('card-button');//購入ボタン取得

/**
* 決済処理の実行
* 購入するボタンを押したとき
* createPaymentMethodを実行し、決済詳細を取得。
* 成功時、コールバック関数のstripePaymentIdHandlerを呼び出す。
*/
cardButton.addEventListener('click',async(e) => {
    e.preventDefault()
    const { paymentMethod, error } = await stripe.createPaymentMethod(
        'card',cardElement, {
        billing_details: { name:cardHolderName.value }
        }
    );
    if (error) {
        console.log(error);
    } else {
        stripePaymentIdHandler(paymentMethod.id);
    }
});

/**
* コールバック関数
* input hiddenで保持しているデータを取得し、submit
*/
function stripePaymentIdHandler(paymentMethodId) {
    const form = document.getElementById('setup-form');
    const hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type','hidden');
    hiddenInput.setAttribute('name','paymentMethodId');
    hiddenInput.setAttribute('value',paymentMethodId);
    form.appendChild(hiddenInput);
    form.submit();
    console.log(paymentMethodId);
}


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
    selectMenu:{id:'',menu:"{{ old('menu')}}", price:''},
    selectMenuError:"{{$errors->first('menu_id')}}",
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
    menus:@json($menus),
},
created:function(){
    const addMenu1 = {id:0, menu_name:'席のみご予約', price:0, shop_id:0};
    this.menus.unshift(addMenu1);
}
})
</script>

@endsection
