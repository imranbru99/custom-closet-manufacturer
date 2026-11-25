<x-filament-panels::page>
    <form wire:submit="diagnose" class="space-y-6">
        {{ $this->form }}
        <x-filament::button type="submit">Diagnose</x-filament::button>
    </form>

    @if ($result)
        <div class="mt-8 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <h3 class="mb-3 text-lg font-semibold">Guidance</h3>
            <div class="prose max-w-none dark:prose-invert whitespace-pre-wrap">{{ $result }}</div>
        </div>
    @endif
</x-filament-panels::page>
