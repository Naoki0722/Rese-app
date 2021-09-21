<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" :class="isOpen ? 'hidden' : 'block' ">
    
        {{ $logo }}
    

      <div class="w-full sm:max-w-md px-6 py-4 bg-white overflow-hidden  sm:rounded-b-lg shadow-md" >
        {{ $slot }}
    </div>
    
</div>
