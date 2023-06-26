<!DOCTYPE html>
 <!DOCTYPE html>
 <html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
   <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Windmill Dashboard</title>
     <link
       href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
       rel="stylesheet"
     />
     <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
     <script
       src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
       defer
     ></script>
     <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
     <link
       rel="stylesheet"
       href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
     />
     <script
       src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
       defer
     ></script>
     <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
     <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
   </head>
   <body>
     <div class="flex h-screen bg-gray-50 dark:bg-gray-900":class="{ 'overflow-hidden': isSideMenuOpen }">
       @include('partials.sidebarpegawai')
       <div class="flex flex-col flex-1 w-full">
         @include('partials.navbar')
         <main class="h-full overflow-y-auto">
           <div class="container px-6 mx-auto grid">
             @yield('content')
         </main>
       </div>
     </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   </body>
 </html>
