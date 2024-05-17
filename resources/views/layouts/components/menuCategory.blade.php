@if (count($subcategory->subcategories) > 0 )
                                                
<ul class="axil-submenu">
    @foreach ( $subcategory->subcategories as $subcategory )
   <li>
      <a href="{{route("product.category", $subcategory->slug)}}"> {{$subcategory->categoryName}} </a>
      @include('layouts.components.menuCategory')
    </li>
    @endforeach
</ul>

@endif