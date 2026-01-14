@extends('layouts.dashboard')
@section('title', 'Detail Resep')

@section('page')
    <h1 class="text-2xl font-semibold text-white mb-6">Detail Resep</h1>
    <div class="bg-neutral-primary-soft border border-default rounded-base p-6 shadow-sm datatable-container">
        <table id="prescriptionTable"
               class="w-full text-sm text-left text-gray-300 prescriptionTable">
            <thead class="text-xs uppercase bg-neutral-secondary-soft text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3">Nomor Resep</th>
                <th scope="col" class="px-4 py-3">Tanggal Peresepan</th>
                <th scope="col" class="px-4 py-3">Status</th>
                <th scope="col" class="px-4 py-3 text-right">Aksi</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $('#prescriptionTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('prescriptions.data') }}',
            columns: [
                {data: 'receipt_number', name: 'receipt_number'},
                {data: 'examined_at', name: 'examined_at'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
        });
    </script>
@endpush