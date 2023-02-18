@include('template.head')

<body>
    <div>
        @include('template.navbar')
        <main class="py-4">
            @livewire('account')
        </main>
    </div>
@include('template.foot')