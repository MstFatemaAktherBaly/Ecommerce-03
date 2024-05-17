@extends('backend.dashboard')

@section('contents')

<section>
<div class="container mt-5">
    <div class="row">
        @if (Route::is('category'))
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white text-center">Add New Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('category.insert')}}" method="POST" enctype="multipart/form-data">

                     @csrf
                     <label for="category">Category Name</label>
                     <input value="" name="category" id="category" placeholder="Add Category" type="text" class="form-control mt-2">

                     <select name="category_id" id="category_id" class="form-control my-3">>
                        <option disabled selected>Select & Parent Category</option>

                     @foreach ( $categories as $category )
                     <option value="{{ $category->id }}"> {{ $category->categoryName }} </option>
                     @endforeach

                     </select>

                     <label>Category Icon</label>
                     <input type="file" name="icon" class="form-control">
                      @error('icon')
                          <span class="text-danger">{{$message}}</span>
                      @enderror

                     <button type="submit" class="btn btn-primary mt-2">Submit</button>

                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white text-center">Edit Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('category.update',$findCategory->id)}}" method="POST" enctype="multipart/form-data">

                     @csrf
                     @method('put')
                     <label for="category">Category Name</label>
                     <input value="{{$findCategory->categoryName}}" name="category" id="category" placeholder="Edit Category" type="text" class="form-control mt-2">
                     <select name="category_id" id="category_id" class="form-control my-3">
                        @foreach ( $categories as $category )

                        @if ($findCategory->id !=  $category->id)

                        <option {{ $findCategory->category_id == $category->id ? "Selected" : '' }} value="{{ $category->id }}"> {{ $category->categoryName }} </option>

                        @endif
                        
                        @endforeach
                        
                     </select>

                     <label>Category Icon</label>
                    <input type="file" name="icon" class="form-control">
                    <input type="hidden" name="old" value="{{ $findCategory->icon }}">

                     <button type="submit" class="btn btn-primary mt-2">Update</button>

                    </form>
                </div>
            </div>
        </div>
        @endif
       <div class="col-lg-6">
        <table class="table table-striped">
            <tr align="center">
                <td style="padding-bottom: 20px;">SL.No.</td>
                <td style="padding-bottom: 20px;">Category Name</td>
                <td style="padding-bottom: 20px;">Category-Slug</td>
                <td style="padding-bottom: 20px;">Action</td>
                
            </tr>

           @forelse ( $perentCategories as $key => $category)
           
           <tr align="center">
            <td style="padding-bottom: 20px;">{{ $categories->firstItem() + $key }}</td>
            <td style="padding-bottom: 20px;" > <img width="80px" src=" {{ asset('storage/'.$category->icon) }} " alt="{{$category->categoryName}}"> {{$category->categoryName}}</td>
            <td> {{ $category->category_slug }} </td>
            <td style="padding-bottom: 20px;">
            <div class="btn-group">
                <a href="{{route('category.edit',$category->id)}}" class="btn btn-primary btn-sm">Edit</a>
                <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger btn-sm">Delete</a>
            </div>
            </td>
            
        </tr>

        @if ($category->subCategories)

        @foreach ( $category->subCategories as $subCategory )
            
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
       

           @empty

            <tr>
                <td>No Data Found</td>
            </tr>
           
           @endforelse

        </table>

        {{ $categories->links() }}
       </div>
    </div>
</div>
</section>

@endsection