@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 py-8" style="background-color: #131313">
    <h1 class="text-3xl font-semibold mb-8 text-center text-white">Create New Review</h1>

    <div class="w-full max-w-2xl mx-auto p-6 rounded-lg shadow-md" style="background-color: #333">
        <form method="POST" action="{{ route('reviews.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-200 text-sm font-bold mb-2" for="title">
                    Game Title
                </label>
                <input style="background-color: #333" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" placeholder="Enter game title" name="title" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-200 text-sm font-bold mb-2" for="content">
                    Review Content
                </label>
                <textarea style="background-color: #333" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:shadow-outline" id="content" placeholder="Share your thoughts" name="content" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-200 text-sm font-bold mb-2" for="rating">
                    Rating
                </label>
                <select style="background-color: #333" class="shadow border rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:shadow-outline" id="rating" name="rating" required>
                    <option value="">Select a rating</option>
                    @for ($i = 1; $i <= 100; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-200 text-sm font-bold mb-2" for="image">
                    Review Image
                </label>
                <input type="file" id="image" name="image" accept="image/*" class="shadow border rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>

            <div class="mb-4">
                <label for="video" class="block text-gray-200 text-sm font-bold mb-2">Review Video (optional):</label>
                <input type="file" id="video" name="video" accept="video/*" class="shadow border rounded w-full py-2 px-3 text-gray-200 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            

            <div class="flex items-center justify-between">
                <a href="{{ route('reviews.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-gray-200 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-white">Cancel</a>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit"> Submit Review </button>
            </div>
        </form>
    </div>
</div>
@endsection
    