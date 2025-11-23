<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-12">

        <!-- Coluna Esquerda – Endereço e Contatos -->
        <div class="flex flex-col justify-center">

            <h2 class="text-3xl md:text-4xl font-semibold text-neutral-900 mb-6">
                Nossa localização
            </h2>

            <p class="text-neutral-600 leading-relaxed mb-8">
                Estamos localizados em Caxias do Sul (RS), com estrutura preparada para oferecer 
                atendimento ágil e suporte especializado para clientes da construção civil e indústria.
            </p>

            <div class="space-y-4 text-neutral-700">
                <div class="flex items-start gap-3">
                    <x-heroicon-o-map-pin class="w-6 h-6 text-sky-600" />
                    <p>
                        Rua Beethoven, 2259 <br>
                        Bairro São José <br>
                        Caxias do Sul – RS
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <x-heroicon-o-phone class="w-6 h-6 text-sky-600" />
                    <p>(54) 0000-0000</p>
                </div>

                <div class="flex items-center gap-3">
                    <x-heroicon-o-envelope class="w-6 h-6 text-sky-600" />
                    <p>contato@alpaaluminio.com.br</p>
                </div>

                <div class="flex items-center gap-3">
                    <x-heroicon-o-chat-bubble-left-right class="w-6 h-6 text-sky-600" />
                    <a href="https://wa.me/SEUNUMERO" class="text-sky-600 font-medium hover:underline">
                        Fale conosco pelo WhatsApp
                    </a>
                </div>
            </div>

        </div>

        <!-- Coluna Direita – Mapa -->
        <div>
            <div class="w-full h-[400px] rounded-xl overflow-hidden shadow-lg">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18..."
                    class="w-full h-full border-0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

    </div>
</section>
