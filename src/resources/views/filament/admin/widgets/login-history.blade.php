@php use Illuminate\Support\Str; @endphp
<div class="space-y-2">
    <x-filament::card>
        <div class="text-sm text-gray-500">Riwayat Login / Logout Terbaru</div>
        <div class="mt-4">
            <table class="w-full text-sm table-fixed">
                <thead class="text-left text-xs text-gray-500">
                    <tr>
                        <th class="w-1/6">Waktu</th>
                        <th class="w-1/4">User</th>
                        <th class="w-1/4">Aksi</th>
                        <th class="w-1/4">IP / User Agent</th>
                    </tr>
                </thead>
                <tbody class="mt-2">
                    @foreach($this->getRecords() as $r)
                        <tr class="border-t">
                            <td class="py-2">{{ $r->created_at->format('d M Y H:i:s') }}</td>
                            <td class="py-2">{{ optional($r->causer)->name ?? $r->properties['user'] ?? '—' }}</td>
                            <td class="py-2">{{ $r->description }}</td>
                            <td class="py-2">{{ $r->properties['ip'] ?? '—' }}<div class="text-xs text-gray-400">{{ Str::limit($r->properties['user_agent'] ?? '', 80) }}</div></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::card>
</div>
