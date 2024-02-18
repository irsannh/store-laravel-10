@extends('layouts.dashboard')

@section('title')
  Store Dashboard Product Create
@endsection

@section('content')
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Create New Product</h2>
                <p class="dashboard-subtitle">Create Your Own Product</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    <form action="{{ route('dashboard-product-store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="name">Product Name</label>
                                <input
                                  type="text"
                                  name="name"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="price">Price</label>
                                <input
                                  type="number"
                                  name="price"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="categories_id" id="" class="form-control">
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Description</label>
                                <textarea
                                  name="description"
                                  id=""
                                  cols="30"
                                  rows="4"
                                  class="form-control"
                                ></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="">Thumbnails</label>
                                <input
                                  type="file"
                                  name="photo"
                                  class="form-control"
                                />
                                <p class="text-muted">
                                  Kamu dapat memilih lebih dari satu file.
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-right">
                              <button
                                class="btn btn-success px-5"
                                type="submit"
                              >
                                Create Product
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
</div>
@endsection

@push('addon-script')
<script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
@endpush