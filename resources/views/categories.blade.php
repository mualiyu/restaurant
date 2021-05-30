@extends("layouts.index")

@section("content")


    <!-- ##### Top Catagory Area Start ##### -->
    <section class="top-catagory-area section-padding-80-0">
        <div class="container">
        <div class="row">
                <div class="col-12">
                    <div class="section-heading">
                        <h3>Categories</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                
                @foreach($categories as $category)
                <!-- Top Catagory Area -->
                <div class="col-12 col-lg-6">
                    <a href="/categories/{{$category->id}}">
                        <div class="single-top-catagory">
                        <img src="storage/category_imgs/{{$category->image}}" alt="">
                        <!-- Content -->
                        <div class="top-cta-content">
                            <h3>{{$category->name}}</h3>
                            <h6>{{$category->desc}}</h6>
                            <a href="/categories/{{$category->id}}" class="btn delicious-btn">Open Category</a>
                        </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ##### Top Catagory Area End ##### -->

@endsection