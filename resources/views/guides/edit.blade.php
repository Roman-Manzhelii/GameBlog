@extends('layouts.app')

@section('content')
<style>
    .game-image {
        max-height: 800px;
    }

</style>

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-semibold mb-8 text-center">Edit Guide: {{ $guide->title }}</h1>
    <div class="w-full  mx-auto bg-white p-6 rounded-lg shadow-md">
        <form id="guide-form" action="{{ route('guides.update', $guide->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

        <div class="mb-4">
            <label for="title" class="block mb-2 font-bold text-gray-700">Title</label>
            <input type="text" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" id="title" name="title" value="{{ $guide->title }}" required>
        </div>
        <div class="mb-4">
            <label for="content" class="block mb-2 font-bold text-gray-700">Content</label>
            <textarea class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40" id="content" name="content" rows="4">{{ $guide->content }}</textarea>
        </div>
        <div class="mb-4">
            <label for="game_id" class="block text-gray-700 font-bold mb-2">Select Game</label>
            <select id="game_id" name="game_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach ($games as $id => $name)
                    <option value="{{ $id }}" {{ $guide->game_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>        
        <div class="mb-4">
            <label for="image" class="block mb-2 font-bold text-gray-700">Guide Images</label>
                @foreach($guide->images as $image)
                    <img src="{{ asset('images/' . $image->path) }}" alt="Guide Image" class="game-image w-full object-cover rounded">
                @endforeach
            <input type="file" id="image" name="images[]" accept="image/*" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>
        
        <div class="mb-4">
            <label for="video" class="block mb-2 font-bold text-gray-700">Guide Videos (optional):</label>
            @foreach($guide->videos as $video)
                <div class="mb-4">
                    <video width="100%" height="auto" controls class="w-full object-cover rounded">
                        <source src="{{ asset('videos/' . $video->path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            @endforeach
            <input type="file" id="video" name="videos[]" accept="video/*" class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:border-blue-500 focus:ring-blue-500 focus:outline-none focus:ring focus:ring-opacity-40">
        </div>

        <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('guides.index') }}" class="px-6 py-2 leading-5 text-gray-700 transition-colors duration-200 transform bg-white border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:bg-gray-100">Cancel</a>
            <button type="submit" class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-blue-700 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update Guide</button>
        </div>
    </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.tiny.cloud/1/vufhsbpswonckewjcb0pt09lklxu66q8w27glg5nqki9tv6t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    tinymce.init({
  selector: '#content',
  plugins: 'media link anchor',
  toolbar: 'media link anchor',
  setup: function (editor) {
      editor.on('change', function () {
          editor.save();
      });
  }
});


    var form = document.getElementById('guide-form');
    form.addEventListener('submit', function() {
        document.getElementById('content').value = tinymce.get('content').getContent();
    });
});
</script>
@endsection