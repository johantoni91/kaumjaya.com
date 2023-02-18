@include('template.head')

<body>
    <div id="app">
        @include('template.navbar')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
@include('template.foot')