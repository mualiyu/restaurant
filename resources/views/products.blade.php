@extends("layouts.index")

@section("content")

    <section>
        <div class="container">
            @foreach($categories as $category)

            <div class="row">
                <h3>{{$category->name}}</h3>
            </div>
            <div class="row">
            @foreach($products as $product)
            @if($product->category_id == $category->id)
                <!-- Small Receipe Area -->
                <div class="col-12 col-sm-6 col-lg-3">
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
                </div><hr>
            @endif
            @endforeach
            </div>
            @endforeach
        </div>
    </section>

@endsection