<x-app-layout>

    HASS: {{ $test ?? "Empty" }}<br>


    @foreach($daterange as $dateWrapper)
        <h2>
            {{ ucfirst($dateWrapper['date']->dayName) }}
            {{ $dateWrapper['date']->day }}
            {{ $dateWrapper['date']->monthName }}
        </h2>

        @foreach($dateWrapper['sections'] as $planningItem)
            <div>
                <label>{{ $planningItem->section }}</label>
                <livewire:planning-textarea :$planningItem />
            </div>
        @endforeach

        <br><br>
    @endforeach
    
</x-app-layout>