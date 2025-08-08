@extends('../layouts.app')
@section('title', 'Productos')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Shopify</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between mb-2">
                <h1 class="h3 mb-3">Productos </h1>
                <a href="{{ route('export_excel_products') }}">
                    <img src="{{ asset('img/icons/icon-excel.png') }}" style="height:50px" />
                </a>
            </div>

            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">SKU(ID)</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Imagen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->id }}</td>
                            <td>${{ $product->variants[0]['price'] }}</td>
                            <td>
                                <a href="{{ $product->image['src'] }}" data-fancybox="gallery"
                                    data-caption="{{ $product->title }}">
                                    <img src="{{ $product->image['src'] }}" class="img-thumbnail" width="50" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- {{ $products }} --}}
        </div>
    </main>

@endsection
