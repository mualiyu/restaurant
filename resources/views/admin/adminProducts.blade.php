@extends("layouts.admin")

@section("content")

<!--main content start-->
<section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-11 col-md-11">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Products</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="{{route('adminDashboard')}}">Home</a></li>
              <li><i class="fa fa-laptop"></i>Products</li>
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
            <a href="{{route('adminAddProduct')}}" class="btn btn-primary">Add Product</a>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-11 col-md-11">
            <section class="panel">
                  <header class="panel-heading">
                    <h2><strong>Product</strong></h2>
                  </header>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#WEB ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                    <?php  
                        $category = DB::table("category")->where("id","=",$product->category_id)->get();
                    ?>
                      <tr>
                        <td>{{$product->id}}</td>
                        <td><img src="{{asset('storage/product_imgs/'.$product->image)}}" alt="" class="img img-rounded" style="max-height:50px;min-height:50px; max-width:60px;"></td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td><b>₦</b>{{$product->price}}</td>
                        <td>{{$category[0]->name}}</td>
                        <td>
                        @if($product->active == "1")
                          <span class="btn btn-success">Available</span>
                        @else
                          <span class="btn btn-warning">Not Available</span>
                        @endif
                        </td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-primary" href="{{route('adminEditProduct', ['id'=>$product->id])}}"><i class="icon_plus_alt2"></i></a>
                            <a class="btn btn-danger" href="{{route('adminDeleteProduct', ['id'=>$product->id])}}"><i class="icon_close_alt2"></i></a>
                          </div>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  
              </section>
              {{$products->links()}}
            </div>
          </div>
          
      </section>
</section>
@endsection