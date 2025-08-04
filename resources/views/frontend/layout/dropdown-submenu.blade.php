{{-- @if(empty($category['subcategories']))
    <a href="{{ url('/products/category/' . $category['category']->id) }}">
        {{ $category['category']->name }}
    </a>
@else
    <div class="dropdown-submenu">
        <a href="{{ url('/products/category/' . $category['category']->id) }}" class="dropdown-toggle" data-bs-toggle="dropdown">
            {{ $category['category']->name }}
        </a>
        <div class="dropdown-menu">
            @foreach($category['subcategories'] as $subcategory)
                @include('frontend.layout.dropdown-submenu', ['category' => $subcategory])
            @endforeach
        </div>
    </div>
@endif --}}
