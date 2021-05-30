@extends("layouts.admin")

@section("content")

<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Categories</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="{{route('adminDashboard')}}">Home</a></li>
              <li><i class="fa fa-laptop"></i><a href="{{route('adminCategories')}}">Categories</a></li>
              <li><i class="fa fa-laptop"></i>{{$category->name}}</li>
            </ol>
          </div>
        </div>
    </section>
        @if(Session::has('message'))
            <div class="alert alert-success fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                 {{$message ?? ''}}
            </div>
        @endif
    <section>
        <div class="row">
            <div class="col-lg-3 col-md-12 ">
                <div class="panel">
                <header class="panel-heading">
                    <strong>Category Image</strong>
                </header>
                <div class="panel-body">
                    <div>
                        <img id="targetI" src="{{asset('storage/category_imgs/'.$category->image)}}" class=" img-thumbnail" style="max-height:200px; min-height:200px; min-width:150px;" alt="">
                    </div><br>
                    <form action="{{route('adminUpdateCategoryImage', ['id'=>$category->id])}}" class="form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                                <input type="file" id="srcI" name="image" onclick="imageQ('srcI','targetI')" class="form-control">
                                
                        </div>
                        <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Update Image">
                        </div>
                    </form>
                </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-12">
            <div class="panel">
                <header class="panel-heading">
                    <strong>Update Category</strong>
                </header>
                @if($category->active == "1")
                   <?php $status = "Active"; ?>
                @else
                   <?php $status = "In-active"; ?>
                @endif
                <div class="panel-body">
                    <form action="{{route('adminUpdateCategory',['id'=>$category->id])}}" method="post" class="form">
                        @csrf
                        <label for="">Name:</label>
                        <input type="text" name="name" value="{{$category->name}}" class="form-control">
                        <label for="">Description:</label>
                        <input type="text" name="desc" value="{{$category->desc}}" class="form-control">
                        <label for="">Satus:</label>
                        <select class="form-control m-bot10 h-100" name="status">
                            <option value="{{$category->active}}"><strong>{{$status}}</strong></option>
                            <option value="0">In-active</option>
                            <option value="1">Active</option>
                        </select>
                         <br>
                        <input type="submit" name="" value="Update" class="btn btn-primary">
                        
                    </form>
                </div>
            </div>
            </div>
        </div>
    </section>
</section>
@endsection