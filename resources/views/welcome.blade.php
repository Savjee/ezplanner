<x-app-layout>

    @foreach($daterange as $dateWrapper)
        <h2>
            {{ ucfirst($dateWrapper['date']->dayName) }}
            {{ $dateWrapper['date']->day }}
            {{ $dateWrapper['date']->monthName }}
        </h2>

        @foreach($dateWrapper['sections'] as $planningItem)
            <div class="flex">
                <label style="width: 80px;">{{ $planningItem->section }}</label>
                <div style="flex: 1;">
                    <livewire:planning-textarea :$planningItem/>
                </div>
            </div>
        @endforeach

        <br>
    @endforeach
    
</x-app-layout>