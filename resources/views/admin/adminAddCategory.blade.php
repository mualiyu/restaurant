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
              <li><i class="fa fa-laptop"></i>Add</li>
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
            <form action="{{route('adminAddCategoryToDB')}}" method="post" enctype="multipart/form-data" class="col-12">

                @csrf

                <div class="col-lg-3 col-md-12 ">
                    <div class="panel">
                    <header class="panel-heading">
                        <strong>Image</strong>
                    </header>
                    <div class="panel-body">
                        <div>
                            <img id="addimage" src="{{asset('storage/category_imgs/default_category.png')}}" class=" img-thumbnail" style="max-height:200px; min-height:200px; min-width:150px;" alt="">
                        </div><br>
                        <div class="form-group">
                            <input type="file" id="addIsrc" onclick="imageQ('addIsrc','addimage');" name="image" value="default_category.png" class="form-control">
                        </div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12">
                <div class="panel">
                    <header class="panel-heading">
                        <strong>Category Form</strong>
                    </header>
                    <div class="panel-body">
                        <div class="form">

                            <label for="">Name:</label>
                            <input type="text" name="name" value="" class="form-control">
                            <label for="">Description:</label>
                            <input type="text" name="desc" value="" class="form-control">
                            <label for="">Satus:</label>
                            <select class="form-control m-bot10 h-100" name="status">
                                <option value="0">In-active</option>
                                <option value="1">Active</option>
                            </select>
                             <br>
                            <input type="submit" name="" value="Submit" class="btn btn-primary">

                        </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </section>
</section>
@endsection