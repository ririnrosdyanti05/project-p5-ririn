@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Detail Kategori') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('categorie.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <img src="{{ asset('storage/categories/' . $category->image) }}" class="w-50 rounded">
                    <hr>
                    <h4>Nama: {{ $category->name_category }}</h4>
                    <p class="mt-3">
                        ID: {{ $category->id }}
                    </p>
                    <p class="mt-3">
                        URL: <a href="{{ $category->url }}" target="_blank">{{ $category->url }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection