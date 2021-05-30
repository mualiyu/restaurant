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
              <li><i class="fa fa-laptop"></i><a href="{{route('adminProducts')}}">Products</a></li>
              <li><i class="fa fa-laptop"></i>{{$product->name}}</li>
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
                    <strong>product Image</strong>
                </header>
                <div class="panel-body">
                    <div>
                        <img id="targetI" src="{{asset('storage/product_imgs/'.$product->image)}}" class=" img-thumbnail" style="max-height:200px; min-height:200px; min-width:150px;" alt="">
                    </div><br>
                    <form action="{{route('adminUpdateProductImage', ['id'=>$product->id])}}" class="form" method="post" enctype="multipart/form-data">
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
                    <strong>Update Product</strong>
                </header>
                @if($product->active == "1")
                   <?php $status = "Available"; ?>
                @else
                   <?php $status = "Not Available"; ?>
                @endif
                <div class="panel-body">
                    <form action="{{route('adminUpdateProduct',['id'=>$product->id])}}" method="post" class="form">
                        @csrf
                        <label for="">Name:</label>
                        <input type="text" name="name" value="{{$product->name}}" class="form-control">
                        <label for="">Description:</label>
                        <input type="text" name="desc" value="{{$product->description}}" class="form-control">
                        <label for="">Category:</label>
                        <select class="form-control m-bot10 h-100" name="category">
                            <option value="{{$category->id}}"><strong>{{$category->name}}</strong></option>
                            @foreach($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                        <label for="">Price:</label>
                        <input type="text" name="price" value="{{$product->price}}" class="form-control">
                        <label for="">Satus:</label>
                        <select class="form-control m-bot10 h-100" name="status">
                            <option value="{{$product->active}}"><strong>{{$status}}</strong></option>
                            <option value="0">Not Available</option>
                            <option value="1">Available</option>
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