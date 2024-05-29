@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-4" style="background-color: #eef2f5; color: #363232; font-family: 'sans-serif';">
                    <div class="card-header" style="text-align:center">
                        <h2>{{ __('Berita Terkini') }}</h2>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Selamat mencari informasi !!') }}
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            @foreach ($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 20rem; background-color: #73cfeb; color: #080504;">
                        <img src="{{ asset('storage/categories/' . $category->image) }}" class="img-thumbnail"
                            alt="{{ $category->name_category }}">
                        <div class="card-body" style="overflow: hidden; text-overflow: ellipsis;">
                            <h5 class="card-title">{{ $category->name_category }}</h5>
                            @if ($category->articles->isNotEmpty() && optional($category->articles->first())->content)
                                <p class="card-text"
                                    style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                    {{ $category->articles->first()->content }}</p>
                            @else
                                <p class="card-text">Content tidak ada/belum di isi</p>
                            @endif
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#categoryModal{{ $category->id }}">
                                Detail
                            </button>
                        </div>
                        <div class="card-footer" style="background-color: #73cfeb;">
                            @if ($category->url)
                                <a href="{{ $category->url }}" class="card-link" target="_blank">
                                    <i class="bi bi-link">link berita</i> <!-- Gunakan ikon dari Bootstrap Icons -->
                                </a>
                            @else
                                <span class="card-link">Source not available</span>
                            @endif
                        </div>

                    </div>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="categoryModal{{ $category->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Detail {{ $category->name_category }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/categories/' . $category->image) }}" class="img-fluid"
                                    alt="{{ $category->name_category }}">
                                <p>{{ $category->articles->isNotEmpty() && optional($category->articles->first())->content }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection