<x-casteaching-layout>
    <div class="flex flex-col gap-y-2 space-x-4 space-y-4 lg:space-x-6 lg:space-y-4 xl:space-x-15 xl:space-y-5 2xl:space-x-20 2xl:space-y-10">
        <div class="flex flex-col gap-y-2 items-center">

            <iframe class="md:p-3 lg:p-5 xl:px-10 xl:py-5 2xl:px-20 2xl:py-10 w-1/2" style="height:50vh; margin: 32px 10px; border-radius: 15px;" src="{{$video->url}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            <div class="max-w-7xl bg-white rounded-lg shadow-lg px-4 pt-4 pb-12 xl:py-4 md:px-6 xl:px-15 2xl:px-20 2xl:py-10 m-4 rounded-t-none w-3/4">
                <div class="flex items-center justify-between">
                    <h2 class="text-gray-900 text-base uppercase font-bold  tracking-tight border-b border-gray-300 mr-4 overflow-hidden">
                        {{ $video->title }}
                    </h2>
                    <svg id="arrow" class="w-6 h-6 text-gray-500 transform rotate-90 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="toggleContent()">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
                <div id="content" style="display: none;" class="mt-4 overflow-auto">
                    <div class="flex justify-center prose-sm md:prose lg:prose-xl 2xl:prose-2xl overflow-hidden">
                        <div class="px-4 bg-white py-2 shadow rounded-lg ">
                            <dt class="text-sm font-medium text-gray-500 inline-block align-text-middle text-center">
                                Data de publicació
                            </dt>
                            <dd class="text-1xl font-semibold text-sm text-gray-900">
                                {{ $video->published_at }}
                            </dd>
                        </div>
                    </div>
                    <div class="prose-sm md:prose lg:prose-xl 2xl:prose-2xl mx-auto px-4 pt-4 pb-2 md:px-6 xl:px-15 xl:py-5 2xl:px-20 2xl:py-10">
                        <p class="font-semibold">DESCRIPCIÓ:</p>
                        {!! Str::markdown($video->description) !!}
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
