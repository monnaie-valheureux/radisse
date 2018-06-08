<div class="breadcrumbs">
    <p class="breadcrumbs__label">Vous êtes ici :</p>
    <ol class="breadcrumbs__list">

    @foreach ($breadcrumbs as $route => $label)

        {{-- Determine the CSS classes we need to apply on the item. --}}
        @if ($loop->first && $loop->last)
            {{-- For cases where there is just a single element. --}}
            <li class="breadcrumbs__item breadcrumbs__item--first breadcrumbs__item--last">
        @elseif ($loop->first)
            <li class="breadcrumbs__item breadcrumbs__item--first">
        @elseif ($loop->last)
            <li class="breadcrumbs__item breadcrumbs__item--last">
        @else
            {{-- Default case. --}}
            <li class="breadcrumbs__item">
        @endif

        {{--
            Unless the current item is the last one, this
            breadcrumb element will contain a link.
        --}}
        @if ($loop->remaining)
                <span class="breadcrumbs__span">
                    <a href="{{ $route }}"
                       class="breadcrumbs__link">
                        {{ $label }}
                    </a>
                </span>
        @else
            <span class="breadcrumbs__span">{{ $label }}</span>
        @endif

        </li>
    @endforeach
    </ol>
</div>
