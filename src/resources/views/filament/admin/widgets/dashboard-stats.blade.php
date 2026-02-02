<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @php($data = $this->getData())

    <x-filament::card>
        <div class="text-sm text-gray-500">Dokter</div>
        <div class="mt-2 text-2xl font-bold">{{ $data['dokter'] }}</div>
    </x-filament::card>

    <x-filament::card>
        <div class="text-sm text-gray-500">Poliklinik</div>
        <div class="mt-2 text-2xl font-bold">{{ $data['poliklinik'] }}</div>
    </x-filament::card>

    <x-filament::card>
        <div class="text-sm text-gray-500">Pasien</div>
        <div class="mt-2 text-2xl font-bold">{{ $data['pasien'] }}</div>
    </x-filament::card>

    <x-filament::card>
        <div class="text-sm text-gray-500">Obat</div>
        <div class="mt-2 text-2xl font-bold">{{ $data['obat'] }}</div>
    </x-filament::card>

    <x-filament::card>
        <div class="text-sm text-gray-500">Kunjungan</div>
        <div class="mt-2 text-2xl font-bold">{{ $data['kunjungan'] }}</div>
    </x-filament::card>

    <x-filament::card>
        <div class="text-sm text-gray-500">Resep</div>
        <div class="mt-2 text-2xl font-bold">{{ $data['resep'] }}</div>
    </x-filament::card>
</div>
