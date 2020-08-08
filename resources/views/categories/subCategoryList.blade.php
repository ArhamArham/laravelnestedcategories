@foreach($subcategories as $subcategory)
 <ul>
    <li>
      <div class="" style="margin:10px">
        <p style="float: left; margin-right:10px;padding-top:5px">{{ $subcategory->name }} </p>
        <a class="btn btn-primary btn-sm" style="float: left; margin-right:5px"
            href="{{ route('edit',$subcategory) }}">Edit</a>
        <form action="{{ route('category.destroy',$subcategory) }}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger btn-sm" type="submit" value="Delete">
        </form>

    </div>
    </li> 
  @if(count($subcategory->children))
    @include('categories.subCategoryList',['subcategories' => $subcategory->children])
  @endif
 </ul> 
@endforeach