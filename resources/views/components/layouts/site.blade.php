<!DOCTYPE html>
<html lang="pt_BR">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>

   @include('partials.head')
</head>

<body>
   <x-site.site-header />

   <main class="py-20">

      {{ $slot }}
   
   </main>

   <x-site.whatsapp-button />
   
   <x-site.privacy-modal />

   <x-site.footer />

   @livewireScripts
</body>

</html>
