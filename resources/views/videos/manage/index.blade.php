<x-casteaching-layout>
    <table>
        <thread>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Description</th>
                <th>URL</th>
                <th>video</th>
            </tr>
        </thread>
        <tbody>
            @foreach($videos as $video)
                <tr>
                    <td>{{ $video->id }}</td>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->description }}</td>
                    <td>{{ $video->url }}</td>
                    <td><a href="/videos/{{$video->id}}">veure el video jeje</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-casteaching-layout>
