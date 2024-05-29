@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('article') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('article.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <img src="{{ asset('storage/articles/' . $article->image) }}" class="w-100 rounded">
                    <hr>
                    <h4>Judul : {{ $article->judul }}</h4>
                    <h4>Content : {{ $article->content }}</h4>
                    <p class="mt-3">
                        ID: {{ $article->id }}
                    </p>
                    <p class="mt-3">
                        Category ID: {{ $article->category->name_category }}
                    </p>
                    <p class="mt-3">
                        User ID: {{ $article->user->name }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection