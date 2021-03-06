<header class="pl-20 bg-gray-100 p-6 flex relative">
  <div @click="isOpen = !isOpen" class="pl-2 pt-1 h-10 w-10 bg-blue-600 rounded-md shadow-kk justify-center items-center cursor-pointer">
    <div class="h-2 w-4 border-b"></div>
    <div class="h-2 w-5 border-b"></div>
    <div class="h-2 w-4 border-b"></div>
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
  <h1 class="text-blue-600 text-4xl pl-5" :class="isOpen ? 'hidden' : 'block' ">Rese</h1>
</header>