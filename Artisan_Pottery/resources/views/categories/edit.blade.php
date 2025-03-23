@extends('layouts.admin.master')

@section('title', 'Edit Category')

@section('content')
    <div class="p-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-playfair font-bold text-gray-800 mb-2">Edit Category</h1>
            <p class="text-gray-600">Update category information</p>
        </div>

        <!-- Edit Form -->
        <div class="max-w-2xl">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Name Field -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description Field -->
                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-amber-500 focus:border-amber-500 @error('description') border-red-500 @enderror">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image Field -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category Image</label>

                            <!-- Current Image Preview -->
                            @if ($category->image_path)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($category->image_path) }}" alt="{{ $category->name }}"
                                        class="w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif

                            <!-- Image Upload Area -->
                            <div
                                class="image-upload-area border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                <input type="file" name="image" id="image" class="hidden" accept="image/*">
                                <button type="button"
                                    class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg transition-colors">
                                    Choose New Image
                                </button>
                                <p class="text-sm text-gray-500 mt-2">or drag and drop your image here</p>
                                <div class="preview-container hidden mt-4">
                                    <img src="" alt="Preview" class="mx-auto max-h-48 rounded-lg">
                                </div>
                            </div>
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('categories.index') }}"
                                class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                class="px-6 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition-colors">
                                Update Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image Upload Handling
            const uploadArea = document.querySelector('.image-upload-area');
            const input = uploadArea.querySelector('input[type="file"]');
            const button = uploadArea.querySelector('button');
            const previewContainer = uploadArea.querySelector('.preview-container');

            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    const previewImage = previewContainer.querySelector('img');

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };

                    reader.readAsDataURL(file);
                }
            }

            // Handle click on browse button
            button.addEventListener('click', () => {
                input.click();
            });

            // Handle drag and drop
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('border-amber-600', 'bg-amber-50');
            });

            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('border-amber-600', 'bg-amber-50');
            });

            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('border-amber-600', 'bg-amber-50');

                if (e.dataTransfer.files.length) {
                    input.files = e.dataTransfer.files;
                    handleFiles(input.files);
                }
            });

            // Handle file input change
            input.addEventListener('change', () => {
                handleFiles(input.files);
            });
        </script>
    @endpush
@endsection
