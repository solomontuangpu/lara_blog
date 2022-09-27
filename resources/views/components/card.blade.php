<div {{ $attributes->merge(['class'=>'card']) }}>
    <div class="card-body">
        {{-- ?? is for default value --}}
        <h4>{{ $title ?? "Card Title" }}</h4>
        <hr>
        {{ $slot }}
    </div>
</div>