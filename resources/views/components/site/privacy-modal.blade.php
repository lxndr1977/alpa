<div
   id="privacy-modal"
   class="fixed left-1/2 -translate-x-1/2 bottom-4 w-[95%] max-w-sm md:max-w-2xl
         bg-white border border-zinc-100 rounded-lg shadow-lg p-4 z-50
         opacity-0 translate-y-6 pointer-events-none
         transition-all duration-300 ease-out
  ">
   <div class="flex flex-col space-y-3 md:flex-row md:items-center md:space-y-0 md:space-x-4">
      <p class="text-sm    text-gray-700 leading-relaxed md:flex-1">
         Ao continuar navegando neste site, você concorda com o uso de cookies e com a nossa <a
            href="{{ route('privacy-policy') }}" class="underline">Política de Privacidade</a>.
      </p>

      <button
         id="accept-privacy"
         class="flex items-center justify-center bg-sky-600 hover:bg-sky-700 text-white font-medium py-2 px-4 rounded-md transition-colors duration-200 text-sm    md:flex-shrink-0 cursor-pointer">
         Eu concordo
      </button>
   </div>
</div>
