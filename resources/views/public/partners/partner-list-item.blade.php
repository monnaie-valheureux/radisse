<li class="partner-list__entry">
    <a href="/partenaires/{{ $partner->slug }}">
        {{ $partner->name_sort }}
    </a>
    @if ($partner->isRecent())
        <div class="badge badge--new">
            <span class="badge__hidden-text">(Ce partenaire est</span>
            nouveau
            <span class="badge__hidden-text">)</span>
        </div>
    @endif
    @if ($partner->hasCurrencyExchange())
        <div class="badge badge--exchange">
            <span class="badge__hidden-text">(Ce partenaire fait</span>
            comptoir de change
            <span class="badge__hidden-text">)</span>
        </div>
    @endif
</li>
