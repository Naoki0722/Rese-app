<x-guest-layout>
  <x-home-header></x-home-header>
<div class="flex flex-wrap w-11/12 m-auto justify-around" :class="isOpen ? 'hidden' : 'block' ">
  @if(@isset($items))


  @foreach($items as $item)
  <div class="w-1/5 h-64 m-3 bg-white rounded-md shadow-kk" >
    <img src="{{$item->img}}" class="w-full h-3/5 rounded-t-md">
    <div class="p-2.5">
      <p class="font-semibold">{{$item->shop_name}}</p>
      <p class="inline-block text-xs">#{{$item->area->area}}</p>
      <p class="inline-block text-xs">#{{$item->category->category}}</p>
    </div>
  </div>
  @endforeach


  @endif
</div>

</x-guest-layout>



