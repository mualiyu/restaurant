@extends("layouts.admin")

@section("content")

<!--main content start-->
<section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">
          <div class="col-lg-11 col-md-11">
            <h3 class="page-header"><i class="fa fa-laptop"></i> Users</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="{{route('adminDashboard')}}">Home</a></li>
              <li><i class="fa fa-laptop"></i>Users</li>
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
          <div class="col-lg-11 col-md-11">
            <section class="panel">
                  <header class="panel-heading">
                    <h2><strong>Users</strong></h2>
                  </header>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>#User ID</th>
                        <th>Image</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)

                      <tr>
                        <td>{{$user->id}}</td>
                        <td>
                            @if($user->image)
                            <img src="{{asset('storage/user_imgs/'.$product->image)}}" alt="" class="img img-rounded" style="max-height:50px;min-height:50px; max-width:60px;">
                            @else
                            <img src="{{asset('storage/product_imgs/default_product.png')}}" alt="" class="img img-rounded" style="max-height:50px;min-height:50px; max-width:60px;">
                            @endif
                        </td>
                        <td><a href="">{{$user->email}}</a></td>
                        <td>
                          <div class="btn-group">
                            <a class="btn btn-primary" href=""><i class="icon_plus_alt2"></i></a>
                            <a class="btn btn-danger" href="" data-toggle="modal" data-target="#delete"><i class="icon_close_alt2"></i></a>
                            
                            <div class="modal" id="delete" tabindex="-1" role="dialog">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-body" style="background:red; top:10%;">
                                    <p>Are you sure you want to delete "{{$user->email}}"</p>
                                    <a class="btn btn-warning" href="">
                                        <i class="icon_close_alt2"></i>Delete
                                    </a>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>
                        </td>
                      </tr>
                      @endforeach

                    </tbody>
                  </table>
                  
              </section>
              {{$users->links()}}
            </div>
          </div>
          
      </section>
</section>
@endsection