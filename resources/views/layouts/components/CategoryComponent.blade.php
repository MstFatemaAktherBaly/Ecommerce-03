@if ($subCategory->subCategories)

@foreach ( $subCategory->subCategories as $subCategory )
    
<tr>
    <td style="padding-bottom: 20px;">{{ str('-')->repeat($loop->depth) }}</td>
    <td style="padding-bottom: 20px;"><img width="80px" src=" {{ $subCategory->icon ? asset('storage/'.$subCategory->icon) : '' }} " alt="{{$subCategory->categoryName}}">{{ $subCategory->categoryName }}</td>
    <td> {{ $subCategory->category_slug }} </td>
    <td style="padding-bottom: 20px;">
        <div class="btn-group">
            <a href="{{route('category.edit',$subCategory->id)}}" class="btn btn-primary btn-sm">Edit</a>
            <a href="{{route('category.delete',$subCategory->id)}}" class="btn btn-danger btn-sm">Delete</a>
        </div>
    </td>
</tr> 
@include('layouts.components.CategoryComponent')

@endforeach

@endif