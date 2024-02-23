<x-casteaching-layout>
    <p>{{$video->title}}</p>
    <ul>
        <li>Description: {{$video->description}}</li>
        <li>Data: {{ $video->published_at }}</li>
    </ul>
</x-casteaching-layout>
