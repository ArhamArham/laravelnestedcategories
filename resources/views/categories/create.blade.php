<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
      <div class="container" style="margin-top: 30px">
        <a href="/" class="btn btn-success">Goto Category Section</a>
        <div class="form-group row">
            <div class="col-sm-12">
              @if (session()->has('message'))
              <div class="alert alert-success">
                  {{session('message')}}
              </div>
              @endif
              @if (session()->has('error'))
              <div class="alert alert-danger">
                  {{session('error')}}
              </div>
              @endif
          </div>
        </div>  
        <div class="row">
            <div class="col-md-4">

                <div class="card ">
                    <div class="card-header">Add Parent Category</div>
                    {{-- <h4 class="card-title">Add Parent Category</h4> --}}
                    <div class="card-body">
                        <form action="{{ route('catstore') }}" method="post" class="">
                            @csrf
                            <div class="form-group">
                                <label for="">Category</label>
                                <input type="text" required class="form-control" name="category" id=""
                                    aria-describedby="helpId" placeholder="">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Add Category">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">Add Sub Category</div>
                    <div class="card-body">
                        <form action="{{ route('subcatstore') }}" method="post" class="">
                            @csrf
                            <div class="form-group">
                                <label for="">ParentCategories</label>
                                @if($parentcategories->count() >0)
                                    <select class="form-control" required name="parentCategory" id="">
                                        @foreach($parentcategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach

                                    </select>
                                @else
                                    <br>
                                    There is no ParentCategories
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">SubCategory</label>
                                <input type="text" class="form-control" required name="subCategory" id=""
                                    aria-describedby="helpId" placeholder="">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Add SubCategory">
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Child Category</div>
                    <div class="card-body">
                        <form action="{{ route('childcatstore') }}" method="post" class="">
                            @csrf
                            <div class="form-group">
                                <label for="">SubCategories</label>
                                @if(count($subcategories)>0)
                                    <select class="form-control" name="subCategory" required id="">

                                        @foreach($subcategories as $subcategory)
                                            <optgroup label="{{ $subcategory->name }}">
                                                @if(count($subcategory->child)>0)
                                                    @foreach($subcategory->child as $subCat)
                                                        <option value="{{ $subCat->id }}">{{ $subCat->name }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    <br>
                                                    <option value="0"> There is no SubCategories</option>
                                                @endif
                                            </optgroup>
                                        @endforeach
                                    </select>
                                @else
                                    <br>
                                    There is no SubCategories
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="">ChildCategory</label>
                                <input type="text" class="form-control" required name="childCategory" id=""
                                    aria-describedby="helpId" placeholder="">
                            </div>
                            <input type="submit" class="btn btn-primary" value="Add ChildCategory">
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>