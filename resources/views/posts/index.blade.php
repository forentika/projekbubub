<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Laravel 10</title>

    {{-- Bootstrap & Toastr CSS --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>
<body>

<div class="container mt-4">
    <h3 class="text-center">Tutorial Laravel 10 untuk Pemula</h3>
    <h5 class="text-center"><a href="{{ route('posts.index') }}">CRUD Laravel 10</a></h5>
    <hr>

    {{-- Notifikasi Alert --}}
    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Tambah Post</a>

            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Konten</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr>
                            <td class="text-center">
                                @if($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" class="rounded" style="width: 150px;">
                                @else
                                    <p class="text-muted">Tidak ada gambar</p>
                                @endif
                            </td>
                            <td>{{ $post->title }}</td>
                            <td>{!! \Illuminate\Support\Str::limit($post->content, 50) !!}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-dark btn-sm">SHOW</a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm">EDIT</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                <div class="alert alert-warning">Data belum tersedia.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            

            {{-- Pagination hanya ditampilkan jika memiliki lebih dari 1 halaman --}}
            @if ($posts->hasPages())
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            @endif

        </div>
    </div>
</div>

{{-- JavaScript --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>

</body>
</html>
