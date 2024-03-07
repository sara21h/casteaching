<x-casteaching-layout>
    <div class="flex flex-col space-x-4 space-y-4 lg:space-x-6 lg:space-y-4 xl:space-x-15 xl:space-y-5
2xl:space-x-20 2xl:space-y-10 items-center">
        <div class="flex flex-col items-center">
            <iframe
                class="md:p-3 lg:p-5 xl:px-10 xl:py-5 2xl:px-20 2xl:py-10 h-4/5 w-full"
                class="md:p-3 lg:p-5 xl:px-10 xl:py-5 2xl:px-20 2xl:py-10 h-4/5 w-full md:px-6 xl:px-15 xl:py-5 2xl:px-20 2xl:py-10"
                style="height: 75vh;"
                src="https://www.youtube.com/embed/ednlsVl-NHA"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>

            </iframe>

            <h2 class="text-gray-900 uppercase font-bold text-2xl tracking-tight">
                {{ $title }}
            </h2>
            <div class="inline-block w-full max-w-7xl w-5/6 bg-white rounded-lg shadow-lg px-4 py-4 md:px-6 xl:px-15 xl:py-5 2xl:px-20 2xl:py-10 m-4 border-t-2 border-indigo-500 rounded-t-none	">
                <h2 class="text-gray-900 w	uppercase font-bold text-2xl tracking-tight border-b border-gray-300">
                    {{ $title }}
                </h2>
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

                    <div class="prose-sm md:prose lg:prose-xl 2xl:prose-2xl mx-auto">
                        <div class="px-4 py-2 bg-gray-100 bg-white shadow rounded-lg overflow-hidden">
                            <dt class="text-sm font-medium text-gray-500 truncate">
                                Data de publicació
                            </dt>
                            <dd class="mt-1 text-1xl font-semibold text-gray-900">

                            </dd>
                        </div>
                    </div>
                </dl>
            </div>

            <div class="prose-sm md:prose lg:prose-xl 2xl:prose-2xl mx-auto px-4 py-4 md:px-6 xl:px-15 xl:py-5 2xl:px-20 2xl:py-10">
                {!! Str::markdown($description) !!}
            </div>
        </div>
    </div>
</x-casteaching-layout>
