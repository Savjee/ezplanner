<x-app-layout>

    @foreach($daterange as $dateWrapper)
        <h2>{{ $dateWrapper['date']->format('l j F') }}</h2>

        @foreach($dateWrapper['sections'] as $planningItem)
            <div>
                <label>{{ $planningItem->section }}</label><br>
                <livewire:planning-textarea :$planningItem />
            </div>
        @endforeach

        <br><br>
    @endforeach
    
</x-app-layout>