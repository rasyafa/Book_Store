@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Book List</h1>

    <div class="row mb-3">
        <div class="col-md-6">
            <form action="{{ route('books.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search books...">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
        </div>
    </div>

    <!-- Javascript -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Book Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $index => $book)
                <tr>
                    <td>{{ $index + $books->firstItem() }}</td>
                    <td>
                        @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->name }}" width="50">
                        @else
                        No Image
                        @endif
                    </td>
                    <td>{{ $book->name }}</td>
                    <td>
                        @if($book->discount > 0)
                        <del>Rp{{ number_format($book->price, 2) }}</del><br>
                        <strong>Rp{{ number_format($book->price * (1 - $book->discount / 100), 2) }}</strong>
                        <span class="badge bg-success">{{ $book->discount }}% OFF</span>
                        @else
                        Rp{{ number_format($book->price, 2) }}
                        @endif
                    </td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>

</div>
@endsection
