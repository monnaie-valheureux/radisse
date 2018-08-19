{{-- Check if an announcement file exists. --}}
@if (File::exists(storage_path('app/site-wide-announcement.json')))

    @php
        // Parse the JSON file.
        $json = File::get(storage_path('app/site-wide-announcement.json'));
        $data = json_decode($json);
    @endphp

    {{-- Display the announcement, unless the current page has to be ignored. --}}
    @unless (request()->is($data->skipped_pages))

        <div class="site-wide-announcement">
            {{ $data->content }}
            <a href="{{ $data->link_url }}">{{ $data->link_label }}</a>
        </div>

    @endunless
@endif
