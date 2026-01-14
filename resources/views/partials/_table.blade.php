@if($prescriptions->isEmpty())
    <div class="text-center py-8 text-sm text-body">
        Tidak ada data resep pada status ini.
    </div>
@else
    <div class="overflow-x-auto rounded-base border border-default-medium">
        <table class="w-full text-sm text-left text-heading">
            <thead class="text-xs uppercase bg-neutral-secondary-soft text-body">
            <tr>
                <th class="px-4 py-3">No. Resep</th>
                <th class="px-4 py-3">Pasien</th>
                <th class="px-4 py-3 hidden md:table-cell">Dokter</th>
                <th class="px-4 py-3 hidden md:table-cell">Tanggal</th>
                <th class="px-4 py-3">Status</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-neutral-secondary-soft">
            @foreach($prescriptions as $prescription)
                @php
                    $status = $prescription->status ?? 'draft';
                    $label = $statusLabels[$status] ?? ucfirst($status);
                    $badgeClass = $statusClasses[$status] ?? 'bg-gray-100 text-gray-800';
                @endphp
                <tr>
                    <td class="px-4 py-3 font-medium">
                        {{ $prescription->receipt_number ?? '—' }}
                    </td>
                    <td class="px-4 py-3">
                        {{ optional($prescription->examination->patient)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 hidden md:table-cell">
                        {{ optional($prescription->examination->doctor)->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3 text-xs text-body hidden md:table-cell">
                        {{ optional($prescription->examination)->examined_at?->format('d/m/Y H:i') ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                {{ $label }}
                            </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="inline-flex gap-2">
                            {{-- ganti route sesuai kebutuhanmu --}}
                            <a href="{{ route('prescriptions.show', $prescription->id) }}"
                               class="text-xs text-brand hover:underline">
                                Detail
                            </a>

                            @if(in_array($status, ['menunggu', 'diproses']))
                                <a href="{{ route('prescriptions.process', $prescription->id) }}"
                                   class="text-xs text-emerald-400 hover:underline">
                                    Proses
                                </a>
                            @endif

                            @if($status === 'draft')
                                <a href="{{ route('prescriptions.edit', $prescription->id) }}"
                                   class="text-xs text-amber-400 hover:underline">
                                    Edit
                                </a>
                            @endif>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
