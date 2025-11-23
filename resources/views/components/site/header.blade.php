<nav id="navbar"
     x-data="navbarComponent()"
     x-init="init()"
     :class="{
        '-translate-y-[110%]': isHidden,
        'shadow-lg': hasShadow
     }"
     class="bg-white border-b border-neutral-200 fixed w-full top-0 z-[9999] transform-gpu transition-transform duration-500 ease-in-out will-change-transform"
     style="height: 5rem;"
>

   <div class="max-w-6xl xl:container mx-auto px-4 sm:px-6 lg:px-8 ">
      <div class="flex justify-between items-center h-20">

         {{-- LOGO --}}
         <a href="/" class="flex items-center">
            <img src="/images/logo-alpa-aluminio.svg" class="h-12 w-auto" alt="Logo Alpa Alumínio">
         </a>

         {{-- MENU DESKTOP --}}
         <ul class="hidden md:flex items-center gap-8">
            <li><a href="{{ route('products.index') }}" class="text-neutral-900 hover:text-primary-600 font-medium">Produtos</a></li>

            {{-- CATEGORIAS - Mega Menu --}}
            <li class="relative group">
               <a class="flex items-center gap-1 text-neutral-900 hover:text-primary-600 font-medium" href="{{ route('categories.index') }}">
                  Categorias
                  <x-lucide-chevron-down class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" />
               </a>

               <div class="absolute left-0 mt-2 bg-white rounded-md border border-neutral-100 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 w-[700px] p-6">
                  <div class="grid grid-cols-3 gap-6">
                     @foreach($categories as $category)
                        <div>
                           {{-- Nível 1 --}}
                           <a href="{{ url('categorias/'.$category->slug) }}" class="block text-neutral-900 font-semibold mb-2 hover:text-primary-600">
                              {{ $category->name }}
                           </a>

                           {{-- Nível 2 --}}
                           @if($category->activeChildren->isNotEmpty())
                              <ul class="space-y-1">
                                 @foreach($category->activeChildren as $child)
                                    <li>
                                       <a href="{{ url('categorias/'.$child->slug) }}" class="text-neutral-700 hover:text-primary-600 text-sm font-medium">
                                          {{ $child->name }}
                                       </a>

                                       {{-- Nível 3 --}}
                                       @if($child->activeChildren->isNotEmpty())
                                          <ul class="pl-3 border-l border-neutral-200 mt-1 space-y-1">
                                             @foreach($child->activeChildren as $grand)
                                                <li>
                                                   <a href="{{ url('categorias/'.$grand->slug) }}" class="text-neutral-600 hover:text-primary-600 text-sm">
                                                      {{ $grand->name }}
                                                   </a>
                                                </li>
                                             @endforeach
                                          </ul>
                                       @endif
                                    </li>
                                 @endforeach
                              </ul>
                           @endif
                        </div>
                     @endforeach
                  </div>
               </div>
            </li>

            {{-- SEGMENTOS - 1 Nível --}}
            <li class="relative group">
               <button class="flex items-center gap-1 text-neutral-900 hover:text-primary-600 font-medium">
                  Segmentos
                  <x-lucide-chevron-down class="w-4 h-4 transition-transform duration-200 group-hover:rotate-180" />
               </button>
               <div class="absolute left-0 mt-2 bg-white rounded-md border border-neutral-100 shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 w-[400px] p-4">
                  <div class="grid grid-cols-2 gap-3">
                     @foreach($segments as $segment)
                        <a href="{{ url('segmentos/'.$segment->slug) }}" class="block text-neutral-800 hover:text-primary-600 font-medium">
                           {{ $segment->name }}
                        </a>
                     @endforeach
                  </div>
               </div>
            </li>

            <li><a href="{{ route('about') }}" class="text-neutral-900 hover:text-primary-600 font-medium">Sobre</a></li>

            <li><a href="{{ route('contact') }}" class="text-neutral-900 hover:text-primary-600 font-medium">Contato</a></li>
         </ul>

         {{-- BOTÃO CTA --}}
         <a href="https://wa.me/5541999999999" 
            class="hidden md:flex items-center bg-sky-600 hover:bg-sky-500 text-white px-6 py-2 rounded-lg font-semibold transition">
            Fale Conosco
         </a>

         {{-- BOTÃO MOBILE --}}
         <button @click="openMenu" class="md:hidden p-2 text-neutral-900">
            <x-lucide-menu class="w-6 h-6" />
         </button>
      </div>
   </div>

   {{-- MENU MOBILE --}}
   <div 
      x-show="isMenuOpen"
      class="md:hidden fixed inset-0 z-40 transform transition-transform duration-300 ease-in-out bg-white overflow-y-auto"
      x-transition:enter="transform transition ease-out duration-300"
      x-transition:enter-start="translate-x-full"
      x-transition:enter-end="translate-x-0"
      x-transition:leave="transform transition ease-in duration-300"
      x-transition:leave-start="translate-x-0"
      x-transition:leave-end="translate-x-full"
   >
      {{-- Fechar --}}
      <div class="flex justify-end p-4 border-b border-neutral-100">
         <button @click="closeMenu" class="text-neutral-900 hover:text-primary-600">
            <x-lucide-x class="w-6 h-6" />
         </button>
      </div>

      {{-- Conteúdo Mobile --}}
      <div class="px-6 py-4 space-y-4 pb-8">

         <a href="/empresa" class="block text-neutral-900 hover:text-primary-600 py-2 text-lg font-medium">Empresa</a>

         {{-- Categorias (colapsável) --}}
         <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex justify-between items-center px-2 py-3 font-medium text-neutral-900 hover:text-primary-600">
               Categorias
               <x-lucide-chevron-down :class="{'rotate-180': open}" class="w-5 h-5 transition-transform duration-200" />
            </button>
            <div x-show="open" x-transition class="pl-4 py-2 space-y-2">
               @foreach($categories as $category)
                  <div>
                     <a href="{{ url('categorias/'.$category->slug) }}" class="block text-neutral-900 font-medium hover:text-primary-600">
                        {{ $category->name }}
                     </a>
                     @if($category->activeChildren->isNotEmpty())
                        <ul class="pl-3 border-l border-neutral-200 mt-1 space-y-1">
                           @foreach($category->activeChildren as $child)
                              <li><a href="{{ url('categorias/'.$child->slug) }}" class="text-neutral-700 text-sm hover:text-primary-600">{{ $child->name }}</a></li>
                           @endforeach
                        </ul>
                     @endif
                  </div>
               @endforeach
            </div>
         </div>

         {{-- Segmentos (colapsável) --}}
         <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex justify-between items-center px-2 py-3 font-medium text-neutral-900 hover:text-primary-600">
               Segmentos
               <x-lucide-chevron-down :class="{'rotate-180': open}" class="w-5 h-5 transition-transform duration-200" />
            </button>
            <div x-show="open" x-transition class="pl-4 py-2 space-y-2">
               @foreach($segments as $segment)
                  <a href="{{ url('segmento/'.$segment->slug) }}" class="block text-neutral-800 hover:text-primary-600">
                     {{ $segment->name }}
                  </a>
               @endforeach
            </div>
         </div>

         <a href="/contato" class="block text-neutral-900 hover:text-primary-600 py-2 text-lg font-medium">Contato</a>

         <div class="pt-4">
            <a href="https://wa.me/5541999999999" class="inline-flex items-center justify-center w-full bg-red-600 hover:bg-red-700 text-white block px-4 py-3 text-lg font-medium rounded-md text-center transition">
               Fale Conosco
            </a>
         </div>
      </div>
   </div>
</nav>

