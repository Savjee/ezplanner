<x-app-layout>

    @foreach($daterange as $date)
        <h2>{{ $date->format('l j F') }}</h2>

        @foreach($sections as $section)
            <div>
                <label>{{ $section }}</label><br>
                <textarea></textarea>
            </div>
        @endforeach

        <br><br>
    @endforeach
    
</x-app-layout>