<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Series') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <x-application-logo class="block h-12 w-auto" />
                        <h1 class="ml-4 mt-2 text-2xl font-medium text-gray-900">
                            Series de videos
                        </h1>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8" id="series-container">
                    <!-- Aquí se cargarán las series -->
                </div>
                <div class="flex justify-center m-4 p-2" id="pagination-container">
                    <!-- Aquí se mostrará la paginación -->
                </div>
            </div>
        </div>
    </div>

    <script>
        const series = @json($series); // Obtener las series desde Laravel

        const itemsPerPage = 6;
        let currentPage = 1;

        const renderSeries = () => {
            const seriesContainer = document.getElementById('series-container');
            seriesContainer.innerHTML = '';

            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const currentPageSeries = series.slice(start, end);

            currentPageSeries.forEach(serie => {
                const serieElement = document.createElement('a'); // Cambio aquí
                serieElement.href = `/series/${serie.id}`; // Cambio aquí
                serieElement.classList.add('serie-link'); // Cambio aquí
                const div = document.createElement('div');
                div.classList.add('bg-white', 'p-4', 'rounded-lg', 'shadow');

                const img = document.createElement('img');
                img.src = serie.imatge_url;
                img.alt = serie.nom;
                img.classList.add('w-full', 'h-auto', 'object-cover');

                const h2 = document.createElement('h2');
                h2.textContent = serie.nom;
                h2.classList.add('mt-2', 'text-xl', 'text-center', 'font-semibold', 'text-gray-800');

                div.appendChild(img);
                div.appendChild(h2);
                serieElement.appendChild(div); // Cambio aquí
                seriesContainer.appendChild(serieElement);
            });
        };


        const renderPagination = () => {
            const totalPages = Math.ceil(series.length / itemsPerPage);
            const paginationContainer = document.getElementById('pagination-container');
            paginationContainer.innerHTML = '';

            const prevButton = document.createElement('button');
            prevButton.textContent = 'Detràs';
            prevButton.classList.add('px-4', 'py-2', 'mx-1', 'font-semibold', 'text-gray-800', 'bg-gray-200', 'rounded');
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    renderSeries();
                    renderPagination();
                }
            });
            paginationContainer.appendChild(prevButton);

            const nextButton = document.createElement('button');
            nextButton.textContent = 'Davant';
            nextButton.classList.add('px-4', 'py-2', 'mx-1', 'font-semibold', 'text-gray-800', 'bg-gray-200', 'rounded');
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    renderSeries();
                    renderPagination();
                }
            });
            paginationContainer.appendChild(nextButton);
        };

        renderSeries();
        renderPagination();
    </script>
</x-app-layout>
