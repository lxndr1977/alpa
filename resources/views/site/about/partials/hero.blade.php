

<section id="sobre" class="bg-white py-24 border-t border-zinc-100 bg-gradient-to-t from-white  to-zinc-50">
   <div
      class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center"
   >
      <!-- Coluna de texto -->
      <div>
         <span
            class="inline-block mb-4 text-sm font-medium tracking-[0.25rem] uppercase text-sky-600"
         >
            Quem somos 
         </span>

         <h2
            class="text-4xl md:text-5xl font-semibold text-zinc-900 leading-tighter"
         >
            Sobre a Alpa Alumínio
         </h2>

         <p class="mt-6 text-lg text-zinc-500 leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

         <div class="mt-8">
            <Button
               text="Fale consoco"
               href="#"
            >
               <IconWhatsapp slot="icon" class="w-5 h-5 -ms-1" />

            </Button>
         </div>
      </div>
      

      <!-- Coluna da imagem -->
      <div class="relative">
         <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-lg">
            <Image
               src="{{ asset('images/placeholder-product.webp')}}"
               alt="Alpa alumínio"
               class="w-full h-full object-cover object-center"
            />
         </div>
      </div>
   </div>
</section>