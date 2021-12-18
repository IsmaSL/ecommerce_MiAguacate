<header class="bg-trueGray-700 sticky top-0 shadow-lg" style="z-index: 900" x-data="dropdown()">
    <div class="container flex items-center h-16 justify-between md:justify-start">

      <!-- Links menu -->
      <a href="/" class="items-center justify-center mr-5 flex order-last md:order-first text-white font-semibold">
            <x-jet-application-mark class="block h-9 w-auto" />
            <span class="text-2xl ml-1">MiAguacate</span>
      </a>

      <a :class="{'text-greenLime-500 bg-white' : open}"
         x-on:click="show()"
         class="flex items-center justify-center px-6 md:px-3 h-full text-white cursor-pointer hover:text-greenLime-400 hover:bg-trueGray-600">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
               <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <span class="text-lg hidden md:block ml-2">Categorías</span>
      </a>

      <div class="flex-0 hidden md:block">
         <a class="flex flex-col items-center justify-center px-3 h-16 text-white cursor-pointer hover:text-greenLime-400 hover:bg-trueGray-600">
            <span class="text-lg">Nosotros</span>
         </a>
      </div>

      <div class="flex-0 hidden md:block">
         <a class="flex flex-col items-center justify-center px-3 h-16 text-white cursor-pointer hover:text-greenLime-400 hover:bg-trueGray-600">
            <span class="text-lg">Contacto</span>
         </a>
      </div>

      <!-- Input Search -->
      <div class="flex-1 hidden md:block">
         @livewire('search')
      </div>
      
      <!-- Settings User & Dropdown -->
      <div class="mx-2 relative hidden md:block">
            @auth
               <x-jet-dropdown align="right" width="48">
                  <x-slot name="trigger">
                        <button
                           class="px-3 h-16 flex items-center justify-center text-sm cursor-pointer hover:bg-trueGray-600">
                           <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                              alt="{{ Auth::user()->name }}" />
                           <span class="text-white pl-3">
                              {{  Str::words(Auth::user()->name, 2,'') }}
                           </span>
                        </button>
                  </x-slot>

                  <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                           {{ __('Manage Account') }}
                        </div>

                        <x-jet-dropdown-link href="{{ route('profile.show') }}">
                           {{ __('Profile') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('orders.index') }}">
                           Mis ordenes
                        </x-jet-dropdown-link>

                        @role('admin')
                           <x-jet-dropdown-link href="{{ route('admin.index') }}">
                              Administrador
                           </x-jet-dropdown-link>
                        @endrole

                        <div class="border-t border-gray-100"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                           @csrf
                           <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                             this.closest('form').submit();">
                              {{ __('Log Out') }}
                           </x-jet-dropdown-link>
                        </form>
                  </x-slot>
               </x-jet-dropdown>
            @else
               <x-jet-dropdown align="right" width="48">
                  <x-slot name="trigger">
                        <i class="fas fa-user-circle text-white text-3xl cursor-pointer focus:text-greenLime-500"></i>

                  </x-slot>

                  <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('login') }}">
                           {{ __('Login') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('register') }}">
                           {{ __('Register') }}
                        </x-jet-dropdown-link>
                  </x-slot>
               </x-jet-dropdown>
            @endauth
      </div>

      <!-- Settings Cart & Dropdown -->
      <div class="hidden md:block ml-2">
         @livewire('dropdown-cart')
      </div>
      
   </div>

   <nav id="navigation-menu" 
      x-show="open"
      :class="{'block': open, 'hidden': !open}"
      class="bg-trueGray-700 bg-opacity-25 w-full absolute hidden">
      {{-- Menú Desktop --}}
      <div class="container h-full w-4/6 hidden md:block">
         <div 
            x-on:click.away="close()"
            class="grid grid-cols-4 h-96 relative">
            <ul class="bg-white">
               @foreach ($categories as $category)
                  <li class="navigation-link text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
                     <a href="{{ route('categories.show', $category ) }}" class="py-4 px-6 text-lg flex items-center">
                        <span class="flex justify-center mr-3">
                           {!! $category->icon !!}
                        </span>
                        {{ $category->name }}
                     </a>
                     <div class="navigation-content bg-gray-100 absolute h-full w-3/4 top-0 right-0 hidden">
                        <img class="h-64 w-full object-cover object-center" src="{{Storage::url($category->image)}}" alt="">
                     </div>
                  </li>
               @endforeach
            </ul>
            <div class="col-span-3 bg-gray-100">
               {{--  --}}
            </div>
         </div>
      </div>
      
      {{-- Menú Movil --}}
      <div class="bg-white h-full overflow-y-auto">
         <div class="container bg-gray-200 py-3">
            @livewire('search')
         </div>
         <p class="text-trueGray-500 text-lg font-semibold px-6 ml-1 my-2">Categorías</p>
         <ul>
            @foreach ($categories as $category)
               <li class="text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
                  <a href="{{ route('categories.show', $category ) }}" class="py-4 px-6 text-lg flex items-center">
                     <span class="flex justify-center w-7 mr-2">
                        {!! $category->icon !!}
                     </span>
                     {{ $category->name }}
                  </a>
                  <div class="navigation-content bg-gray-100 absolute h-full w-3/4 top-0 right-0 hidden">
                     <img class="h-64 w-full object-cover object-center" src="{{Storage::url($category->image)}}" alt="">
                  </div>
               </li>
            @endforeach
         </ul>
         <p class="text-trueGray-500 text-lg font-semibold px-6 ml-1 my-2">Cuenta</p>

         @livewire('cart-mobil')

         @auth
            <a href="{{ route('profile.show') }}" class="py-4 px-6 text-lg flex items-center text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
               <span class="flex justify-center w-7 mr-1">
                  <i class="fas fa-user"></i>
               </span>
               Perfil
            </a>
            <a href="{{ route('orders.index') }}" class="py-4 px-6 text-lg flex items-center text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
               <span class="flex justify-center w-7 mr-1">
                  <i class="fas fa-list-alt"></i>
               </span>
               Mis Ordenes
            </a>

            @role('admin')
               <a href="{{ route('admin.index') }}" class="py-4 px-6 text-lg flex items-center text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
                  <span class="flex justify-center w-7 mr-1">
                     <i class="fas fa-users-cog"></i>
                  </span>
                  Administrador
               </a>
            @endrole
            <form method="POST" action="{{ route('logout') }}">
               @csrf
               <a href="{{ route('logout') }}" class="py-4 px-6 text-lg flex items-center text-trueGray-500 hover:bg-greenLime-500 hover:text-white"
               onclick="event.preventDefault(); this.closest('form').submit();">
                  <span class="flex justify-center w-7 mr-1">
                     <i class="fas fa-door-open"></i>
                  </span>
                  Cerrar sesión
               </a>
            </form>
         
            {{--             
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
               @csrf
               <x-jet-responsive-nav-link href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                               this.closest('form').submit();">
                   {{ __('Log Out') }}
               </x-jet-responsive-nav-link>
            </form> --}}
         @else
            <a href="{{ route('login') }}" class="py-4 px-6 text-lg flex items-center text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
               <span class="flex justify-center w-7 mr-1">
                  <i class="fas fa-user"></i>
               </span>
               Iniciar sesión
            </a>

            <a href="{{ route('register') }}" class="py-4 px-6 text-lg flex items-center text-trueGray-500 hover:bg-greenLime-500 hover:text-white">
               <span class="flex justify-center w-7 mr-1">
                  <i class="fas fa-address-card"></i>
               </span>
               Crea una cuenta
            </a>
         @endauth
      </div>
    </nav>
</header>