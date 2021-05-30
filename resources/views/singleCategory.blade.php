@extends("layouts.index")

@section("content")

    <!-- ##### Small Receipe Area Start ##### -->
    <section class="small-receipe-area section-padding-80-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>{{$category[0]->name}}</h3>
                    </div>
                </div>
            </div>

            <div class="row">

            @if($products->count() > 0)
                @foreach($products as $product)

                <!-- Small Receipe Area -->
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="single-small-receipe-area d-flex">
                        <!-- Receipe Thumb -->
                        <div class="receipe-thumb">
                            <img src="{{asset('storage/product_imgs/'.$product->image)}}" alt="">
                        </div>
                        <!-- Receipe Content -->
                        <div class="receipe-content">
                            <a href="/products/{{$product->id}}">
                                <h5>{{$product->name}}</h5>
                            </a>
                            <div class="ratings">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <p>price: ₦{{$product->price}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            @else

            <div class="col-12 ">
                    <div class="single-small-receipe-area d-flex">
                        <div class="receipe-content align-items-center">
                            
                                <h5>Nothing from this Category.</h5>
                            
                           
                        </div>
                    </div>
                </div>

            @endif

            </div>
        </div>
    </section>
    <!-- ##### Small Receipe Area End ##### -->

@endsection    