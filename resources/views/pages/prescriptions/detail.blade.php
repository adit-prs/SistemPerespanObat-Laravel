@extends('layouts.dashboard')
@section('title', 'Detail Resep')

@section('page')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-white">Detail Resep</h1>
    </div>

    <div class="flex flex-col gap-6">
        <div class="bg-neutral-primary-soft border border-default rounded-base p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-heading mb-4">Identitas Pasien</h2>

            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 text-sm">
                <div>
                    <dt class="text-body">Nomor Rekam Medis</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->medical_record_number ?? 'NP-000001' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Nama Lengkap</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->name ?? 'Joko' }}
                    </dd>
                </div>

            </dl>
        </div>

        <div class="bg-neutral-primary-soft border border-default rounded-base p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-heading">Daftar Obat</h2>
            </div>

            <div class="mb-4 text-sm text-body">
                <div><span class="font-medium text-heading">Nomor Resep:</span> {{ $dataItems->receipt_number }}</div>
                <div><span class="font-medium text-heading">Status:</span> {{ $dataItems->status }}</div>
            </div>

            <table id="prescriptionTable"
                   class="w-full text-sm text-left text-gray-300 prescriptionTable">
                <thead class="text-xs uppercase bg-neutral-secondary-soft text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Nama Obat</th>
                    <th scope="col" class="px-4 py-3">Jumlah</th>
                    <th scope="col" class="px-4 py-3">Harga Satuan</th>
                    <th scope="col" class="px-4 py-3">Aturan Pakai</th>
                    <th scope="col" class="px-4 py-3">Total</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $grandTotal = 0;
                @endphp

                @foreach($dataItems->prescriptionitems as $dataItem)
                    @php
                        $itemTotal = $dataItem->quantity * $dataItem->unit_price;
                        $grandTotal += $itemTotal;
                    @endphp

                    <tr class="border-t border-neutral-secondary-soft">
                        <td class="px-4 py-3">{{ $dataItem->medicine_name }}</td>
                        <td class="px-4 py-3">{{ $dataItem->quantity }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($dataItem->unit_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            {{ $dataItem->dosage_frequency }}x{{ $dataItem->dosage_amount }}
                            {{ $dataItem->dosage_unit }} {{ $dataItem->additional_instruction }}
                        </td>
                        <td class="px-4 py-3">
                            Rp {{ number_format($itemTotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach

                <tr class="border-t border-neutral-secondary-soft bg-neutral-secondary-soft text-gray-200 font-semibold">
                    <td colspan="4" class="px-4 py-3 text-right">Total yang perlu dibayar</td>
                    <td class="px-4 py-3">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="flex items-center gap-2 mt-4">
            @if($dataItems->status == 'menunggu')
                <form action="{{ route('prescriptions.updateStatus', $dataItems->id) }}" method="POST">
                    @csrf
                    <input type="hidden" value="diproses" name="status">
                    <input type="hidden" value="{{$grandTotal}}" name="amount_due">
                    <button class="text-white bg-emerald-600 hover:bg-emerald-950 focus:ring-4 focus:ring-brand-medium font-medium rounded-base text-sm px-4 py-2.5 focus:outline-none"
                            type="submit">
                        Proses Resep
                    </button>
                </form>
            @endif

            @if($dataItems->status == 'diproses')
                <button data-modal-target="payment-modal" data-modal-toggle="payment-modal"
                        class="text-white bg-brand hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium font-medium rounded-base text-sm px-4 py-2.5 focus:outline-none"
                        type="button">
                    Pembayaran
                </button>
            @endif
            @if($dataItems->status == 'diambil')
                <a
                        href="{{ route('payments.receipt', $paymentId) }}"
                        class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-brand hover:bg-brand-strong rounded-base">
                    Download Nota (PDF)
                </a>
            @endif
            @if($dataItems->status != 'dibatalkan' && $dataItems->status != 'diambil')
                <form
                        action="{{ route('prescriptions.updateStatus', $dataItems->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin membatalkan resep ini?')">
                    @csrf
                    <input type="hidden" value="dibatalkan" name="status">
                    <input type="hidden" value="{{$itemTotal}}" name="amount_due">
                    <button
                            class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-base text-sm px-4 py-2.5 focus:outline-none"
                            type="submit">
                        Batalkan Resep
                    </button>
                </form>
            @endif

            <a href="{{ route('prescriptions') }}"
               class="text-gray-800 bg-gray-200 hover:bg-gray-300 border border-gray-300 font-medium rounded-base text-sm px-4 py-2.5 focus:outline-none">
                Kembali
            </a>
        </div>

        @if($paymentId!=null)
            <!-- Main modal -->
            <div id="payment-modal" tabindex="-1" aria-hidden="true"
                 class="hidden fixed inset-0 z-50 w-full h-[calc(100%-1rem)] max-h-full md:inset-0 overflow-y-auto overflow-x-hidden justify-center items-center">

                <div class="relative w-full max-w-md max-h-full p-4">
                    <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                        {{-- Header --}}
                        <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                            <h3 class="text-lg font-medium text-heading">
                                Pembayaran
                            </h3>
                            <button type="button"
                                    class="inline-flex justify-center items-center ms-auto w-9 h-9 rounded-base text-sm text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading"
                                    data-modal-hide="payment-modal">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                     viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                                <span class="sr-only">Tutup modal</span>
                            </button>
                        </div>

                        <form action="{{route('payments.update',$paymentId)}}" method="POST"
                              class="space-y-4 py-4 md:py-6">
                            @csrf
                            <div>
                                <label for="amount_due"
                                       class="block mb-2.5 text-sm font-medium text-heading">Total</label>
                                <input type="number" name="amount_due" id="amount_due" required
                                       class="block w-full px-3 py-2.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                                       placeholder="Total" value="{{$grandTotal}}" readonly>
                            </div>
                            <div>
                                <label for="amount_paid" class="block mb-2.5 text-sm font-medium text-heading">Harga
                                    yang
                                    dibayarkan</label>
                                <input type="number" name="amount_paid" id="amount_paid" required
                                       class="block w-full px-3 py-2.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                                       placeholder="Bayar">
                            </div>
                            <div class="max-w-sm mx-auto">
                                <label for="method" class="block mb-2.5 text-sm font-medium text-heading">Pilih
                                    metode pembayaran</label>
                                <select id="method"
                                        class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body"
                                        name="method">
                                    <option selected>Pilih pembayaran</option>
                                    <option value="tunai">tunai</option>
                                    <option value="kartu">kartu</option>
                                    <option value="transfer">transfer</option>
                                    <option value="qris">qris</option>
                                </select>
                                <div class="flex items-center gap-3 pt-4 md:pt-6 border-t border-default">
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2.5 text-sm font-medium leading-5 text-white bg-brand hover:bg-brand-strong border border-transparent rounded-base shadow-xs focus:outline-none focus:ring-4 focus:ring-brand-medium">
                                        Bayar
                                    </button>

                                    <button type="button" data-modal-hide="payment-modal"
                                            class="px-4 py-2.5 text-sm font-medium leading-5 text-body bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium hover:text-heading border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')

@endpush