<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-white dark:bg-gray-900 transition-colors duration-300">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="/images/favicon.png" type="image/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.ts')
        @inertiaHead

        <!-- Iconos FontAwesome -->
        <script src="https://kit.fontawesome.com/f61d876e0e.js" crossorigin="anonymous"></script>

        <!-- Google Tag Manager -->
        <script>
            (
              function(w,d,s,l,i){
                w[l]=w[l] || [];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
                var f=d.getElementsByTagName(s)[0];
                j=d.createElement(s);
                dl=l!='dataLayer'?'&l='+l:'';
                j.async=true;
                j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
                f.parentNode.insertBefore(j,f);
              }
            )(window,document,'script','dataLayer','GTM-WSNGBGX8');
        </script>
        <!-- End Google Tag Manager -->
    </head>
    
    <body class="font-sans antialiased bg-white dark:bg-gray-900 transition-colors duration-300">
        <!-- Google Tag Manager (noscript) -->
        <noscript>
          <iframe 
            src="https://www.googletagmanager.com/ns.html?id=GTM-WSNGBGX8"
            height="0" width="0" style="display:none;visibility:hidden"
            title="Google Tag Manager (noscript)"
          ></iframe>
        </noscript>
        @inertia
    </body>
</html>
