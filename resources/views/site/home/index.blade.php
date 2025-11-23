<x-layouts.site>
   @include('site.home.partials.hero')

   @include('site.home.partials.segments')

   @include('site.home.partials.categories')

   @include('site.home.partials.featured-products')

   <x-site.value-proposition />
   
   @include('site.home.partials.about')
</x-layouts.site>
