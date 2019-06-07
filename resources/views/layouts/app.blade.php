<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Plan de estudios') }}</title>
            <!-- Styles -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        {{-- <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet"> --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div id="app">
            <v-app id="inspire">
                    <sidebar></sidebar>
                    <v-content>
                            {{-- <v-container fluid fill-height>
                              <v-layout justify-center align-center> --}}

                                      @yield('content')

                              {{-- </v-layout>
                            </v-container> --}}
                    </v-content>
                    <navbar></navbar>
            </v-app>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
