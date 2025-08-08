@extends('../layouts.app')
@section('title', 'Pedidos')

@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Shopify</li>
                </ol>
            </nav>
            <div class="d-flex justify-content-between mb-2">
                <h1 class="h3 mb-3">Pedidos </h1>
                <a href="{{ route('export_excel_orders') }}">
                    <img src="{{ asset('img/icons/icon-excel.png') }}" style="height:50px" />
                </a>
            </div>

            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->customer['id'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s') }}</td>
                            <td>${{ $order->current_total_price }}</td>
                            <td>{{ $order->financial_status == 'paid' ? 'Pagado' : 'Pendiente' }}</td>
                            <td>
                                <ul>
                                    @foreach ($order->line_items as $item)
                                        <li>
                                            {{ $item['current_quantity'] }} x {{ $item['name'] }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

@endsection
