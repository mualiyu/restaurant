@extends("layouts.admin")

@section("content")

<!--main content start-->
<section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-11 col-md-11">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Categories</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="{{route('adminDashboard')}}">Home</a></li>
              <li><i class="fa fa-laptop"></i>Categories</li>
            </ol>
          </div>
        </div>
        @if(Session::has('message'))
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                 {{$message ?? ''}}
            </div>
        @endif
        <div class="row">
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-3"></div>
          <div class="col-3">
            <a href="{{route('adminAddCategory')}}" class="btn btn-primary">Add category</a>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-11 col-md-11">
            <section class="panel">
                  <header class="panel-heading">
                    Categories
                  </header>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                      <tr>
                        <td>{{$category->id}}</td>
                        <td><img src="{{asset('storage/category_imgs/'.$category->image)}}" alt="" class="img img-rounded" style="max-height:50px;min-height:50px; max-width:60px;"></td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->desc}}</td>
                        <td>
                        @if($category->active == "1")
                          <span class="btn btn-success">Active</span>
                        @else
                          <span class="btn btn-warning">In-active</span>
                        @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-primary" href="{{route('adminCategoryEdit', ['id'=>$category->id])}}"><i class="icon_plus_alt2"></i></a>
                            <a class="btn btn-danger" href="{{route('adminDeleteCategory', ['id'=>$category->id])}}"><i class="icon_close_alt2"></i></a>
                          </div>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
              </section>

            </div>
          </div>
          
      </section>
</section>
@endsection