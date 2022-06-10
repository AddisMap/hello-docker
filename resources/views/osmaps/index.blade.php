<div>
    <h1>Total N+W+R = {{ count($osmaps) }}</h1>
  <ul class="border-gray">
    @foreach ($osmaps as $data)
      <li class="p-small">
          <p>
              {{-- <a class="font-weight-light" href={{ route('osmaps.show', [$data['type'],$data['id']]) }}> --}}
              <a class="font-weight-light" href={{ url('https://www.openstreetmap.org/api/0.6/'.$data['type'].'/'.$data['id'].'.json') }}>
                Name: {{ $data['tags']['name'] ?? '' }} || osm=type+id: {{ $data['type'] ?? '' }}-{{ $data['id'] ?? ''}}
          </a>
        </p>
      </li>
    @endforeach
  </ul>
</div>

