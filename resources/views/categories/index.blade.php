<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}
</style>
</head>
<body>
  <div class="container " style="margin-top: 20px">
    <a href="/create" class="ml-3 btn btn-success" style="margin-top: 10px">Add Category</a>
  <div class="dropdown" style="margin-top: 20px">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Categories
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      @foreach ($categories as $category)
      @if (count($category->children)<1)
        <li><a tabindex="-1" href="#">{{$category->name}}</a></li>
      @endif
     
      <li class="dropdown-submenu">
        @if (!count($category->children)<1)
          <a class="test" tabindex="-1" href="#">{{$category->name}}<span class="caret"></span></a>
        @endif
        <ul class="dropdown-menu">
          @foreach ($category->children as $c)
          @if (count($c->children)<1)
            <li><a tabindex="-1" href="#">{{$c->name}}</a></li>
          @endif
          <li class="dropdown-submenu">
            @if (!count($c->children)<1)
              <a class="test" href="#">{{$c->name}}<span class="caret"></span></a>
            @endif
            <ul class="dropdown-menu">
              @foreach ($c->children as $cd)
                <li><a href="#">{{$cd->name}}</a></li>
              @endforeach
            </ul>
          </li>
          @endforeach
        </ul>
      </li>
      @endforeach
    </ul>
  </div>
</div>
<div class="container" style="margin-top: 20px">
  <div class="row">
    @if ($categories->count()>0)
        
    @foreach($categories as $category)
    
    <div class="" style="margin:10px">
        <p style="float: left; margin-right:10px;padding-top:5px">{{ $category->name }} </p>
        <a class="btn btn-primary btn-sm" style="float: left; margin-right:5px"
            href="{{ route('edit',$category) }}">Edit</a>
        <form action="{{ route('category.destroy',$category) }}" method="post">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger btn-sm" type="submit" value="Delete">
        </form>

    </div>

  @if(count($category->children))
	@include('categories.subCategoryList',['subcategories' => $category->children])
	@else
	<ul><li>No subcategories</li></ul> 
  @endif
 
  @endforeach
  @else
  <p>There is no categories plz add</p>
    @endif
  </div>
</div>
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>

</body>
</html>
