@extends('layouts.dashboard')
@section('title', 'Daftar Pasien')

@section('page')
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-white">Daftar Pasien</h1>

        <!-- Modal toggle -->
        <button data-modal-target="add-pasien-modal" data-modal-toggle="add-pasien-modal"
                class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none"
                type="button">
            Tambah Pasien
        </button>
    </div>
    <!-- Main modal -->
    <div id="add-pasien-modal" tabindex="-1" aria-hidden="true"
         class="hidden fixed inset-0 z-50 w-full h-[calc(100%-1rem)] max-h-full md:inset-0 overflow-y-auto overflow-x-hidden justify-center items-center">

        <div class="relative w-full max-w-md max-h-full p-4">
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-heading">
                        Tambah Pasien
                    </h3>
                    <button type="button"
                            class="inline-flex justify-center items-center ms-auto w-9 h-9 rounded-base text-sm text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading"
                            data-modal-hide="add-pasien-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18 17.94 6M18 18 6.06 6"/>
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>

                {{-- Body --}}
                <form action="{{route('patients.store')}}" method="POST" class="space-y-4 py-4 md:py-6">
                    @csrf

                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block mb-2.5 text-sm font-medium text-heading">Nama</label>
                        <input type="text" name="name" id="name" required
                               class="block w-full px-3 py-2.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                               placeholder="Nama">
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div>
                        <span class="block mb-2.5 text-sm font-medium text-heading">Jenis Kelamin</span>
                        <div class="flex items-center gap-6">
                            <label for="gender-l" class="flex items-center gap-2 select-none cursor-pointer">
                                <input id="gender-l" type="radio" name="gender" value="L"
                                       class="w-4 h-4 border border-default bg-neutral-secondary-medium rounded-full text-brand checked:border-brand focus:ring-2 focus:ring-brand-subtle focus:outline-none">
                                <span class="text-sm font-medium text-heading">Laki-Laki</span>
                            </label>

                            <label for="gender-p" class="flex items-center gap-2 select-none cursor-pointer">
                                <input id="gender-p" type="radio" name="gender" value="P" checked
                                       class="w-4 h-4 border border-default bg-neutral-secondary-medium rounded-full text-brand checked:border-brand focus:ring-2 focus:ring-brand-subtle focus:outline-none">
                                <span class="text-sm font-medium text-heading">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label for="birth_date" class="block mb-2.5 text-sm font-medium text-heading">Tanggal
                            Lahir</label>
                        <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-body" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
                            </svg>
                        </span>
                            <input datepicker id="birth_date" name="birth_date" type="text"
                                   class="block w-full ps-9 pe-3 py-2.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                                   placeholder="Pilih Tanggal">
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label for="address" class="block mb-2.5 text-sm font-medium text-heading">Alamat</label>
                        <textarea id="address" name="address" rows="4"
                                  class="block w-full p-3.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                                  placeholder="Alamat"></textarea>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div>
                        <label for="phone" class="block mb-2.5 text-sm font-medium text-heading">Nomor Telepon</label>
                        <input type="tel" name="phone" id="phone"
                               class="block w-full px-3 py-2.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                               placeholder="Nomor Telepon">
                    </div>

                    {{-- Footer --}}
                    <div class="flex items-center gap-3 pt-4 md:pt-6 border-t border-default">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium leading-5 text-white bg-brand hover:bg-brand-strong border border-transparent rounded-base shadow-xs focus:outline-none focus:ring-4 focus:ring-brand-medium">
                            <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                 fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M5 12h14m-7 7V5"/>
                            </svg>
                            Tambah Pasien
                        </button>

                        <button type="button" data-modal-hide="add-pasien-modal"
                                class="px-4 py-2.5 text-sm font-medium leading-5 text-body bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium hover:text-heading border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="p-4 border-3 border-default rounded-base datatable-container">
        <table id="patientTable"
               class="w-full text-gray-300">
            <thead>
            <tr>
                <th>
                     <span class="flex items-center">
                        Nomor Pasien
                         <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                              height="24" fill="none" viewBox="0 0 24 24">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2"
                                   d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                     </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Nama
                         <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                              height="24" fill="none" viewBox="0 0 24 24">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2"
                                   d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                     </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Jenis Kelamin
                         <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                              height="24" fill="none" viewBox="0 0 24 24">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2"
                                   d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                     </span>
                </th>
                <th>
                    <span class="flex items-center">
                        Tanggal Lahir
                         <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                              height="24" fill="none" viewBox="0 0 24 24">
                             <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                   stroke-width="2"
                                   d="m8 15 4 4 4-4m0-6-4-4-4 4"/>
                        </svg>
                     </span>
                </th>
                <th>Aksi</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $('#patientTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('patients.data') }}',
            columns: [
                {data: 'medical_record_number', name: 'medical_record_number'},
                {data: 'name', name: 'name'},
                {data: 'gender', name: 'gender'},
                {data: 'birth_date', name: 'birth_date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari pasien..."
            },
            dom:
                "<'flex justify-between items-center mb-3'<'flex items-center'l><'flex items-center'f>>" +
                "<'overflow-x-auto'tr>" +
                "<'flex justify-between items-center mt-3'<'text-sm'i><'flex'p>>"
        });

        // $(document).on('click', '.btn-detail', function () {
        //     let url = $(this).data('url');
        //
        //     $.get(url, function (res) {
        //         console.log(res);
        //         // kamu bisa tampilkan di modal atau alert
        //     });
        // });
    </script>
@endpush