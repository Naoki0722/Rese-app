<header class="pl-20 bg-gray-100 p-6 flex justify-between relative">
  <div class="flex">
    <div @click="isOpen = !isOpen" class="pl-2 pt-1 h-10 w-10 bg-blue-600 rounded-md shadow-kk inline-block justify-center items-center cursor-pointer">
      <div class="h-2 w-4 border-b"></div>
      <div class="h-2 w-5 border-b"></div>
      <div class="h-2 w-4 border-b"></div>
    </div>
  
    <h1 class="text-blue-600 text-4xl pl-5 inline-block" :class="isOpen ? 'hidden' : 'block' ">Rese</h1>
  </div>
  <div :class="isOpen ? 'hidden' : 'block' ">
    <select name="area" v-model="area">
      <option hiiden value="">All area</option>
      <option value="東京都">東京都</option>
      <option value="大阪府">大阪府</option>
      <option value="福岡県">福岡県</option>
    </select>
    <select name="category" v-model="category">
      <option hiiden value="">All genre</option>
      <option value="寿司">寿司</option>
      <option value="焼肉">焼肉</option>
      <option value="居酒屋">居酒屋</option>
      <option value="イタリアン">イタリアン</option>
      <option value="ラーメン">ラーメン</option>
    </select>
    <input type="text" placeholder="search" v-model="keyword">
  </div>
  <div :class="isOpen ? 'block' : 'hidden' " class="w-screen h-screen absolute top-20 left-0 flex justify-center">
    <ul class="w-52 h-52 mt-40 ">
      <li class="text-center h-12"><a href="/" class="text-blue-600 text-4xl font-medium">Home</a></li>
      <li class="text-center h-12">
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-dropdown-link :href="route('logout')"
          onclick="event.preventDefault();
          this.closest('form').submit();"
          class="text-blue-600 text-4xl font-medium">
          {{ __('Log Out') }}
        </x-dropdown-link>
        </form>
      </li>
      <li class="text-center h-12"><a href="/mypage" class="text-blue-600 text-4xl font-medium">Mypage</a></li>
      <li class="text-center h-12"><a href="/owner/home" class="text-blue-600 text-4xl font-medium">Owner</a></li>
    </ul>
  </div>
</header>