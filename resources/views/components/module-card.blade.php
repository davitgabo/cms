@foreach($records as $record)
    <div class="product">
        <img src="{{ asset('storage/' . $record->image) }}" alt="product image">
        <div class="product-description">
            <p class="product-title">{{ $record->title['ka'] }}</p>
            <p class="product-desc">{{ $record->description['ka'] ?? $record->short_description['ka'] }}</p>
            <a href="{{ $record->slug }}" class="learn-more">გაიგე მეტი</a>
        </div>
    </div>
@endforeach
