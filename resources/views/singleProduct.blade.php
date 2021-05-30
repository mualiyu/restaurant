@extends("layouts.index")

@section("content")
    <section class="top-catagory-area section-padding-80-0">
        <div class="container">
            <div class="row">    
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <div class="single-top-catagory">
                        <img src="{{asset('storage/product_imgs/'.$product->image)}}" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>{{$product->name}}</h3>
                            <h6>Price: ₦{{$product->price}}</h6>
                            <a href="#" class="btn delicious-btn">Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection