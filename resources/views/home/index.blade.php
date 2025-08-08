@extends('../layouts.app')
@section('title', 'Home')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Home</li>
                </ol>
            </nav>

            <img src="{{ asset('img/shopify.jpeg') }}" alt="" class="img-fluid rounded-circle" width="90%"
                height="132" />
        </div>
    </main>

@endsection
