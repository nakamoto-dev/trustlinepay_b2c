<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrustlinePay Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Send B2C Payment with TrustlinePay</h2>

        @if(session('response'))
            <div class="alert alert-info">
                <pre>{{ json_encode(session('response'), JSON_PRETTY_PRINT) }}</pre>
            </div>
        @endif

        <form method="POST" action="{{ route('trustline.send') }}">
            @csrf
            <div class="mb-3">
                <label for="amount" class="form-label">Amount (KES)</label>
                <input type="number" class="form-control" id="amount" name="amount" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>

            <div class="mb-3">
                <label for="network_code" class="form-label">Network</label>
                <select class="form-select" id="network_code" name="network_code" required>
                    <option value="safaricom">Safaricom</option>
                    <option value="airtel">Airtel</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Send Payment</button>
        </form>
    </div>
</body>
</html>
