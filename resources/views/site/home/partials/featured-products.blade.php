 <div class="max-w-7xl mx-auto py-20 px-6 lg:px-8">

    <div class="flex items-center justify-between mb-8">
       <h2 class="text-2xl font-medium text-neutral-900">Produtos em destaque</h2>
    </div>

    <x-site.product-grid :products="$products" columns="5" layout="slide" />
 </div>
