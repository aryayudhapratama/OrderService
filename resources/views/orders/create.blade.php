<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Create New Order</title>
</head>
<body class="bg-body-secondary">

    <div class="card position-absolute top-50 start-50 translate-middle rounded-4 shadow-lg p-4 mb-5 bg-body-tertiary rounded"
        style="width: 30rem;">
        <i class="fa-solid fa-box-open fa-3x" style="color: blue; text-align: center;"></i>
        <div class="card-body">
            <h2 class="text-center mb-4">New Order</h2>
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf

                <label for="customer_id">Pilih Pelanggan</label>
                <input type="text" class="form-control mb-3" id="customer_name" name="name"
                    value="{{ $selectedCustomer['name'] ?? 'Pelanggan tidak ditemukan' }}" readonly>
                <input type="hidden" name="customer_id" value="{{ $selectedCustomer['id'] ?? '' }}">
                <label for="product_id">Pilih Produk</label>
                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="product_id"
                    required>
                    @foreach ($products as $product)
                        <option value="{{ $product['id'] }}">{{ $product['product_name'] }}</option>
                    @endforeach
                </select>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        placeholder="Input Quantity">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end"><button type="submit"
                        class="btn btn-primary text-end">Submit</button>
                </div>

            </form>
        </div>
    </div>