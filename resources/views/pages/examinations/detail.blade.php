@extends('layouts.dashboard')
@section('title', 'Halaman Pemeriksaan')

@section('page')
    <h1 class="text-2xl font-semibold text-white mb-6">Detail Pasien</h1>

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

                <div>
                    <dt class="text-body">Jenis Kelamin</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Tanggal Lahir</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ isset($patient->birth_date) ? $patient->birth_date->format('d/m/Y') : '-' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Nomor Telepon</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->phone ?? '-' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Alamat</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->address ?? '-' }}
                    </dd>
                </div>
            </dl>
        </div>

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

                <div>
                    <dt class="text-body">Jenis Kelamin</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Tanggal Lahir</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ isset($patient->birth_date) ? $patient->birth_date->format('d/m/Y') : '-' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Nomor Telepon</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->phone ?? '-' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Alamat</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->address ?? '-' }}
                    </dd>
                </div>
            </dl>
        </div>
        
        {{-- Card 2: Riwayat Pemeriksaan --}}
        <div class="bg-neutral-primary-soft border border-default rounded-base p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-heading">Riwayat Pemeriksaan</h2>

                <a href="{{ route('patients.examine', $patient->id) }}"
                   class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">
                    Tambah Pemeriksaan
                </a>
            </div>

            <table id="examinationTable"
                   class="w-full text-sm text-left text-gray-300 examinationTable">
                <thead class="text-xs uppercase bg-neutral-secondary-soft text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">Tanggal Pemeriksaan</th>
                    <th scope="col" class="px-4 py-3">Keluhan Utama</th>
                    <th scope="col" class="px-4 py-3">Diagnosis</th>
                    <th scope="col" class="px-4 py-3 text-right">Aksi</th>
                </tr>
                </thead>
            </table>
        </div>

    </div>
@endsection

@push('scripts')

@endpush