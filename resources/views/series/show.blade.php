<x-casteaching-layout>
    <div class="flex flex-col gap-y-2 space-x-4 space-y-4 lg:space-x-6 lg:space-y-4 xl:space-x-15 xl:space-y-5 2xl:space-x-20 2xl:space-y-10">
        <div class="flex flex-col gap-y-2 items-center">
            <h2 class="mt-12">Videos de la serie:</h2>
            <ul>
                @if($serie->videos->isEmpty())
                    <p class="text-xs text-red-400">No hi ha ningun video.</p>
                @else
                    <ul>
                        @foreach($serie->videos as $video)
                            <li><a class="text-blue-500 font-semibold underline" href="{{ url('/videos/' . $video->id) }}">{{ $video->title }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </ul>
            <div class="max-w-7xl bg-white rounded-lg shadow-lg px-4 pt-4 pb-12 xl:py-4 md:px-6 xl:px-15 2xl:px-20 2xl:py-10 m-4 rounded-t-none w-3/4">
                <div class="flex items-center justify-between">
                    <h2 class="text-gray-900 uppercase font-bold text-sm tracking-tight border-b border-gray-300 mr-4 overflow-hidden">
                        {{ $serie->nom }}
                    </h2>
                    <svg id="arrow" class="w-6 h-6 text-gray-500 transform rotate-90 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="toggleContent()">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="content" class="mt-4 overflow-auto">
                    @if($serie->descripcio)
                        <div class="prose-sm md:prose lg:prose-xl 2xl:prose-2xl mx-auto px-4 pt-4 pb-2 md:px-6 xl:px-15 xl:py-5 2xl:px-20 2xl:py-10">
                            {!! Str::markdown($serie->descripcio) !!}
                        </div>
                    @else
                        <p class="text-sm text-gray-500">No hi ha descripció</p>
                    @endif
                    <div class="flex justify-center">
                        <img src="{{ $serie->imatge_url }}" alt="{{ $serie->nom }}" class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleContent() {
            var content = document.getElementById("content");
            var arrow = document.getElementById("arrow");
            if (content.style.display === "none") {
                content.style.display = "block";
                arrow.style.transform = "rotate(180deg)";
            } else {
                content.style.display = "none";
                arrow.style.transform = "rotate(0deg)";
            }
        }
    </script>
</x-casteaching-layout>
