@extends('layouts.dashboard')
@section('title', 'Halaman Pemeriksaan')

@section('page')
    <h1 class="text-2xl font-semibold text-white mb-6">Pemeriksaan</h1>

    <form action="{{ route('patients.examine.store', $patient->id) }}" method="POST" enctype="multipart/form-data"
          class="space-y-6 pb-24">
        @csrf

        {{-- Card 1: Identitas Pasien --}}
        <div class="bg-neutral-primary-soft border border-default rounded-base p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-heading mb-4">Identitas Pasien</h2>

            <dl class="grid grid-cols-1 md:grid-cols-3 gap-x-10 gap-y-4 text-sm">
                <div>
                    <dt class="text-body">Nomor Rekam Medis</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->medical_record_number ?? 'NP-000001 ' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Nama Lengkap</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ $patient->name  ?? 'Joko'}}
                    </dd>
                </div>

                <div>
                    <dt class="text-body">Tanggal Pemeriksaan</dt>
                    <dd class="mt-1 font-medium text-heading">
                        {{ now()->format('d/m/Y') }}
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Card 2: Form Pemeriksaan --}}
        <div class="bg-neutral-primary-soft border border-default rounded-base p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-heading mb-4">Form Pemeriksaan</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Keluhan utama --}}
                <div class="md:col-span-2">
                    <label for="chief_complaint" class="block mb-2 text-sm font-medium text-heading">Keluhan
                        Utama</label>
                    <textarea id="chief_complaint" name="chief_complaint" rows="3"
                              class="block w-full p-3.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                              placeholder="Keluhan utama pasien"></textarea>
                </div>

                {{-- Kondisi umum --}}
                <div>
                    <label for="general_condition" class="block mb-2 text-sm font-medium text-heading">Kondisi
                        Umum</label>
                    <select id="general_condition" name="general_condition"
                            class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand">
                        <option value="">Pilih kondisi</option>
                        <option value="baik">Baik</option>
                        <option value="sedang">Sedang</option>
                        <option value="buruk">Buruk</option>
                    </select>
                </div>

                {{-- Kesadaran --}}
                <div>
                    <label for="consciousness" class="block mb-2 text-sm font-medium text-heading">Kesadaran</label>
                    <select id="consciousness" name="consciousness"
                            class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand">
                        <option value="">Pilih kesadaran</option>
                        <option value="compos_mentis">Compos mentis</option>
                        <option value="apatis">Apatis</option>
                        <option value="somnolen">Somnolen</option>
                        <option value="sopor">Sopor</option>
                        <option value="koma">Koma</option>
                    </select>
                </div>

                {{-- Vital sign (contoh, nanti bisa kamu rapikan lagi) --}}
                <div>
                    <label for="height_cm" class="block mb-2 text-sm font-medium text-heading">Tinggi Badan (cm)</label>
                    <input type="number" id="height_cm" name="height_cm"
                           class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                           placeholder="cm">
                </div>

                <div>
                    <label for="weight_kg" class="block mb-2 text-sm font-medium text-heading">Berat Badan (kg)</label>
                    <input type="number" id="weight_kg" name="weight_kg"
                           class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                           placeholder="kg">
                </div>

                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-heading">Tekanan Darah</label>

                    <div class="flex items-center gap-2 w-full">
                        <input type="number" id="systole" name="systole"
                               class="w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                               placeholder="mmHg">

                        <span class="text-white">/</span>

                        <input type="number" id="diastole" name="diastole"
                               class="w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                               placeholder="mmHg">
                    </div>
                </div>


                <div>
                    <label for="heart_rate" class="block mb-2 text-sm font-medium text-heading">HR</label>
                    <input type="number" id="heart_rate" name="heart_rate"
                           class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                           placeholder="bpm">
                </div>
                <div>
                    <label for="respiratory_rate" class="block mb-2 text-sm font-medium text-heading">RR</label>
                    <input type="number" id="respiratory_rate" name="respiratory_rate"
                           class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                           placeholder="x/menit">
                </div>
                <div>
                    <label for="temperature" class="block mb-2 text-sm font-medium text-heading">Suhu Badan</label>
                    <input type="number" id="temperature" name="temperature" step="0.1"
                           class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                           placeholder="°C">
                </div>

                <div class="md:col-span-2">
                    <label for="diagnosis" class="block mb-2 text-sm font-medium text-heading">Diagnosis</label>
                    <textarea id="diagnosis" name="diagnosis" rows="3"
                              class="block w-full p-3.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                              placeholder="Tulis diagnosis kerja / banding"></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block mb-2.5 text-sm font-medium text-heading"
                           for="attachments">Upload berkas</label>
                    <input class="cursor-pointer bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full shadow-xs placeholder:text-body"
                           id="attachments" type="file" name="attachments[]" multiple>
                </div>
            </div>
        </div>

        {{-- Card 3: Form Resep --}}
        <div class="bg-neutral-primary-soft border border-default rounded-base p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-heading">Resep</h2>
                <button type="button" data-modal-target="add-medicine-modal" data-modal-toggle="add-medicine-modal"
                        class="text-sm px-3 py-2 rounded-base bg-neutral-secondary-medium border border-default-medium text-heading hover:bg-neutral-tertiary-medium">
                    Tambah Obat
                </button>
            </div>

            {{-- nanti ini jadi list/cart obat, sekarang dummy dulu --}}
            <div class="border border-default-medium rounded-base overflow-hidden">
                <table class="w-full text-sm text-left text-gray-300 table-obat" id="table-obat">
                    <thead class="text-xs uppercase bg-neutral-secondary-soft text-gray-400">
                    <tr>
                        <th class="px-4 py-3">Nama Obat</th>
                        <th class="px-4 py-3">Jumlah</th>
                        <th class="px-4 py-3">Aturan Pakai</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex items-center justify-end gap-3 mt-4">
            <a href="{{route('patients.show',$patient->id)}}"
               class="px-4 py-2.5 text-sm font-medium text-body bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium border border-default-medium rounded-base shadow-xs">
                Batal
            </a>

            <button type="submit"
                    class="inline-flex items-center px-4 py-2.5 text-sm font-medium text-white bg-brand hover:bg-brand-strong border border-transparent rounded-base shadow-xs focus:outline-none focus:ring-4 focus:ring-brand-medium">
                Simpan Pemeriksaan
            </button>
        </div>
    </form>

    <!-- Modal Tambah Obat -->
    <div id="add-medicine-modal" tabindex="-1" aria-hidden="true"
         class="hidden fixed inset-0 z-50 w-full h-[calc(100%-1rem)] max-h-full overflow-y-auto overflow-x-hidden md:inset-0 justify-center items-center">

        <div class="relative w-full max-w-md max-h-full p-4 mx-auto">
            <div class="relative bg-neutral-primary-soft border border-default rounded-base shadow-sm p-4 md:p-6">
                {{-- Header --}}
                <div class="flex items-center justify-between border-b border-default pb-4 md:pb-5">
                    <h3 class="text-lg font-medium text-heading">
                        Tambah Obat
                    </h3>
                    <button type="button"
                            class="inline-flex justify-center items-center ms-auto w-9 h-9 rounded-base text-sm text-body bg-transparent hover:bg-neutral-tertiary hover:text-heading"
                            data-modal-hide="add-medicine-modal">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                  stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                        </svg>
                        <span class="sr-only">Tutup modal</span>
                    </button>
                </div>

                {{-- Body --}}
                <div class="space-y-4 py-4 md:py-6">
                    {{-- Obat --}}
                    <div>
                        <label for="add_medicine" class="block mb-2 text-sm font-medium text-heading">Obat</label>
                        <select id="add_medicine" name="add_medicine"
                                class="js-medicine-select w-full">
                            <option value="">Pilih obat</option>
                            @foreach($medicines as $medicine)
                                <option value="{{$medicine['id']}}">{{$medicine['name']}}</option>
                            @endforeach
                            {{-- option obat --}}
                        </select>
                    </div>

                    {{-- Dosis (frekuensi x interval) --}}
                    <div>
                        <label class="block mb-2 text-sm font-medium text-heading">Dosis</label>
                        <div class="flex items-center gap-2 w-full">
                            <input type="number" id="add_dosage_frequency" name="add_dosage_frequency"
                                   class="w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                                   placeholder="Frekuensi">
                            <span class="text-sm text-heading shrink-0">x</span>
                            <input type="number" id="add_dosage_amount" name="add_dosage_amount"
                                   class="w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                                   placeholder="Jumlah">
                        </div>
                        <p class="mt-1 text-xs text-body">Contoh: 3 x 1 kali sehari.</p>
                    </div>

                    {{-- Unit --}}
                    <div>
                        <label for="add_dosage_unit"
                               class="block mb-2 text-sm font-medium text-heading">Satuan</label>
                        <select id="add_dosage_unit" name="add_dosage_unit"
                                class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand">
                            <option value="">Pilih satuan pakai</option>
                            <option value="tablet">tablet</option>
                            <option value="kapsul">kapsul</option>
                            <option value="saset">saset</option>
                            <option value="sendok">sendok</option>
                        </select>
                    </div>
                    <div>
                        <label for="add_quantity" class="block mb-2 text-sm font-medium text-heading">Jumlah</label>
                        <input type="number" id="add_quantity" name="add_quantity"
                               class="block w-full px-3 py-2.5 text-sm text-heading bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                               placeholder="Jumlah obat">
                    </div>
                    {{-- Instruksi tambahan --}}
                    <div>
                        <label for="add_additional_instruction"
                               class="block mb-2 text-sm font-medium text-heading">Instruksi Tambahan</label>
                        <textarea id="add_additional_instruction" name="add_additional_instruction" rows="3"
                                  class="block w-full p-3.5 text-sm text-heading placeholder:text-body bg-neutral-secondary-medium border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-brand focus:border-brand"
                                  placeholder="Misal: setelah makan, sebelum tidur, dsb."></textarea>
                    </div>
                    {{-- Footer --}}
                    <div class="flex items-center gap-3 pt-4 md:pt-6 border-t border-default">
                        <button type="button" onclick="addMedicine()"
                                class="inline-flex items-center px-4 py-2.5 text-sm font-medium leading-5 text-white bg-brand hover:bg-brand-strong border border-transparent rounded-base shadow-xs focus:outline-none focus:ring-4 focus:ring-brand-medium">
                            <svg class="w-4 h-4 me-1.5 -ms-0.5" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="M5 12h14m-7 7V5"/>
                            </svg>
                            Tambah Obat
                        </button>

                        <button type="button" data-modal-hide="add-medicine-modal"
                                class="px-4 py-2.5 text-sm font-medium leading-5 text-body bg-neutral-secondary-medium hover:bg-neutral-tertiary-medium hover:text-heading border border-default-medium rounded-base shadow-xs focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function () {
            $('.js-medicine-select').select2({
                dropdownParent: $('#add-medicine-modal'), // penting biar dropdown muncul di dalam modal
                width: '100%',
                placeholder: 'Pilih obat',
                allowClear: true
            });
        });

        function addMedicine() {
            const selectObat = document.getElementById('add_medicine');
            const medicineId = selectObat.value;
            const medicineName = selectObat.options[selectObat.selectedIndex].text;
            const dosageFrequency = document.getElementById('add_dosage_frequency').value;
            const dosageAmount = document.getElementById('add_dosage_amount').value;
            const dosageUnit = document.getElementById('add_dosage_unit').value;
            const quantity = document.getElementById('add_quantity').value;
            const additionalInstruction = document.getElementById('add_additional_instruction').value;

            if (!medicineId || !dosageFrequency || !dosageAmount || !dosageUnit || !quantity) {
                alert('Obat, dosis, dan unit wajib diisi');
                return;
            }

            renderTable(medicineId, medicineName, dosageFrequency, dosageAmount, dosageUnit, quantity, additionalInstruction);
            document.querySelector('[data-modal-hide="add-medicine-modal"]').click();
            $('#add_medicine').val(null).trigger('change');
            document.getElementById('add_dosage_frequency').value = '';
            document.getElementById('add_dosage_amount').value = '';
            document.getElementById('add_dosage_unit').value = '';
            document.getElementById('add_quantity').value = '';
            document.getElementById('add_additional_instruction').value = '';
        }

        function renderTable(medicineId, medicineName, dosageFrequency, dosageAmount, dosageUnit, quantity, additionalInstruction) {
            let row = `
                    <tr class="border-t border-neutral-secondary-soft">
                        <td class="px-4 py-3">${medicineName}</td>
                        <td class="px-4 py-3">${quantity}</td>
                        <td class="px-4 py-3">${dosageFrequency}x${dosageAmount} ${additionalInstruction}</td>
                        <td class="px-4 py-3 text-right">
                            <button type="button" class="text-xs text-red-400 hover:underline btn-delete-medicine">Hapus</button>
                            <input type="hidden" name="medicine_id[]" value="${medicineId}">
                            <input type="hidden" name="medicine_name[]" value="${medicineName}">
                            <input type="hidden" name="dosage_frequency[]" value="${dosageFrequency}">
                            <input type="hidden" name="dosage_amount[]" value="${dosageAmount}">
                            <input type="hidden" name="dosage_unit[]" value="${dosageUnit}">
                            <input type="hidden" name="quantity[]" value="${quantity}">
                            <input type="hidden" name="additional_instruction[]" value="${additionalInstruction}">
                        </td>
                    </tr>

            `;
            $('#table-obat tbody').append(row);
        }

        $(document).on('click', '.btn-delete-medicine', function () {
            $(this).closest('tr').remove();
        });
    </script>
@endpush