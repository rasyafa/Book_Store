@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Book</h1>

    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Book Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                value="{{ old('name', $book->name) }}" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                rows="3">{{ old('description', $book->description ?? '') }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price"
                name="price" value="{{ old('price', $book->price) }}" required>
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock"
                value="{{ old('stock', $book->stock) }}" required>
            @error('stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount (%)</label>
            <input type="number" step="0.01" class="form-control @error('discount') is-invalid @enderror" id="discount"
                name="discount" value="{{ old('discount', $book->discount) }}">
            @error('discount')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @if($book->image)
            <div class="mt-2">
                <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->name }}" width="100">
            </div>
            @endif
            @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Book</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
