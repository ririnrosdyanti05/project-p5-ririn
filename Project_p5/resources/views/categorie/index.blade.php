@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Kategori') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('categorie.create') }}" class="btn btn-sm btn-outline-primary">Tambah Kategori</a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Gambar</th>
                                    <th>URL</th> <!-- Tambahkan kolom URL di sini -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $category->name_category }}</td>
                                    <td>
                                        <img src="{{ asset('storage/categories/' . $category->image) }}" class="img-thumbnail" width="100" alt="{{ $category->name_category }}">
                                    </td>
                                    <td>
                                        <a href="{{ $category->url }}" target="_blank">{{ $category->url }}</a>
                                    </td> <!-- Tampilkan URL di sini -->
                                    <td>
                                        <form action="{{ route('categorie.destroy', $category->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('categorie.show', $category->id) }}" class="btn btn-sm btn-outline-dark">Tampilkan</a> |
                                            <a href="{{ route('categorie.edit', $category->id) }}" class="btn btn-sm btn-outline-success">Edit</a> |
                                            <button type="submit" onclick="return confirm('Apakah Anda Yakin ?');" class="btn btn-sm btn-outline-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        Kategori tidak tersedia.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {!! $categories->withQueryString()->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection