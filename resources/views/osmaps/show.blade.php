<div>
    {{-- <p>
        name: {{ $data['tags']['name'] ?? '' }} | amenity: {{ $data['tags']['tourism'] ?? ''}}
    </p> --}}
    <p>
        Name: {{ $data['tags']['name'] ?? '' }} | osm_type: {{ $data['type'] ?? '' }} | osm_id: {{ $data['id'] ?? ''}}
    </p>
</div>
