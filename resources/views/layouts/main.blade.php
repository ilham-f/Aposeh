<!DOCTYPE html>
 <html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
   <head>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <title>Windmill Dashboard</title>
     <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"/>
     <link rel="stylesheet" href="{{ asset('assets/css/tailwind.output.css') }}" />
     <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
     <script src="{{ asset('assets/js/init-alpine.js') }}"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"/>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
     <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
     <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

     {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> --}}
   </head>
   <body>
     <div class="flex h-screen bg-gray-50 dark:bg-gray-900":class="{ 'overflow-hidden': isSideMenuOpen }">
       @include('partials.sidebar')
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
