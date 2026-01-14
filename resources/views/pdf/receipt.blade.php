<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Nota Pembayaran</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header, .footer {
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .info-table, .items-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 2px 0;
        }

        .items-table th, .items-table td {
            border: 1px solid #000;
            padding: 4px;
        }

        .items-table th {
            background: #eee;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Klinik Sehat</h1>
    <p>Nota Pembayaran Resep Obat</p>
</div>

<table class="info-table">
    <tr>
        <td>Nomor Resep</td>
        <td>:</td>
        <td>{{ $prescription->receipt_number ?? '-' }}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>:</td>
        <td>
            {{ $examination->examined_at
                ? \Carbon\Carbon::parse($examination->examined_at)->format('d/m/Y')
                : '-' }}
        </td>
    </tr>
    <tr>
        <td>Metode Pembayaran</td>
        <td>:</td>
        <td>{{ strtoupper($payment->method ?? '-') }}</td>
    </tr>
    <tr>
        <td>Total Tagihan</td>
        <td>:</td>
        <td>Rp {{ number_format($payment->amount_due, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td>Jumlah Dibayar</td>
        <td>:</td>
        <td>Rp {{ number_format($payment->amount_paid, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td>Kembalian</td>
        <td>:</td>
        <td>Rp {{ number_format($payment->amount_paid - $payment->amount_due, 0, ',', '.') }}</td>
    </tr>
</table>

@if($items->count())
    <br>
    <table class="items-table">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Jumlah</th>
            <th>Aturan Pakai</th>
            <th class="text-right">Harga Satuan</th>
            <th class="text-right">Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @php $grandTotal = 0; @endphp
        @foreach($items as $i => $item)
            @php
                $itemTotal = $item->quantity * $item->unit_price;
                $grandTotal += $itemTotal;
            @endphp
            <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $item->medicine_name }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td>
                    {{ $item->dosage_frequency }}x{{ $item->dosage_amount }}
                    {{ $item->dosage_unit }} {{ $item->additional_instruction }}
                </td>
                <td class="text-right">
                    Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                </td>
                <td class="text-right">
                    Rp {{ number_format($itemTotal, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" class="text-right"><strong>Total Resep</strong></td>
            <td class="text-right">
                <strong>Rp {{ number_format($grandTotal, 0, ',', '.') }}</strong>
            </td>
        </tr>
        </tbody>
    </table>
@endif

<div class="footer" style="margin-top: 20px;">
    <p>Terima kasih telah berobat di Klinik Sehat.</p>
</div>
</body>
</html>
