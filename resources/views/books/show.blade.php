@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Book Details</h1>

    <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
                @if($book->image)
                <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->name }}" class="img-fluid rounded-start">
                @else
                <div class="text-center p-5 bg-light">No Image</div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->name }}</h5>
                    <p class="card-text"><strong>Price:</strong> ${{ number_format($book->price, 2) }}</p>
                    <p class="card-text"><strong>Stock:</strong> {{ $book->stock }}</p>
                    <p class="card-text"><strong>Discount:</strong> {{ $book->discount }}%</p>
                    @if($book->discount > 0)
                    <p class="card-text"><strong>Discounted Price:</strong> ${{ number_format($book->price * (1 -
                        $book->discount / 100), 2) }}</p>
                    @endif
                    <p class="card-text"><small class="text-muted">Last updated: {{ $book->updated_at->diffForHumans()
                            }}</small></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning">Edit</a>
        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
        </form>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
</div>
@endsection
