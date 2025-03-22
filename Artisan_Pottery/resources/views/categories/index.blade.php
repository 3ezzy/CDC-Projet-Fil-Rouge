@extends('layouts.admin.master')

@section('title', 'Seller Dashboard')

@section('content')

    <div class="p-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-playfair font-bold text-gray-800 mb-2">Category Management</h1>
                <p class="text-gray-600">Add and manage product categories</p>
            </div>
            <button class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg transition-colors">
                <i class="fas fa-plus mr-2"></i>Add New Category
            </button>
        </div>

        <!-- Category Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Add Category Form -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="font-playfair text-xl font-bold text-gray-800 mb-6">Add New Category</h2>
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <!-- Category Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Category Name*
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-amber-500"
                            placeholder="Enter category name" required>
                        @error('name')
                            <div class="flex items-center mt-1">
                                <svg class="h-4 w-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Category Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-2 border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-2 focus:ring-amber-500"
                            placeholder="Enter category description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="flex items-center mt-1">
                                <svg class="h-4 w-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Category Image -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                        <div
                            class="image-upload-area border-2 border-dashed {{ $errors->has('image') ? 'border-red-500' : 'border-gray-300' }} p-8 rounded-lg text-center">
                            <i
                                class="fas fa-cloud-upload-alt text-4xl {{ $errors->has('image') ? 'text-red-400' : 'text-gray-400' }} mb-3"></i>
                            <p class="text-gray-600 mb-2">Drag and drop your image here</p>
                            <p class="text-sm text-gray-500 mb-4">or</p>
                            <button type="button" onclick="document.getElementById('image').click()"
                                class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg transition-colors">
                                Browse Files
                            </button>
                            <input type="file" id="image" name="image" class="hidden" accept="image/*">
                            <div class="preview-container mt-4 hidden">
                                <img src="" alt="Preview" class="max-w-full h-auto mx-auto rounded-lg">
                            </div>
                        </div>
                        @error('image')
                            <div class="flex items-center mt-1">
                                <svg class="h-4 w-4 text-red-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <!-- Featured Checkbox -->
                    <div class="flex items-center">
                        <input type="checkbox" id="featured" name="featured" {{ old('featured') ? 'checked' : '' }}
                            class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                        <label for="featured" class="ml-2 text-sm text-gray-700">
                            Show in featured categories
                        </label>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('categories.index') }}"
                            class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>

            <!-- Existing Categories -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="font-playfair text-xl font-bold text-gray-800 mb-6">Existing Categories</h2>
                <div class="space-y-4">
                    <!-- Category Item -->
                    <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <img src="https://via.placeholder.com/50" alt="Vases"
                                class="w-12 h-12 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium text-gray-800">Vases</h3>
                                <p class="text-sm text-gray-500">24 products</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Category Item -->
                    <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <img src="https://via.placeholder.com/50" alt="Plates"
                                class="w-12 h-12 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium text-gray-800">Plates</h3>
                                <p class="text-sm text-gray-500">18 products</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Category Item -->
                    <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <img src="https://via.placeholder.com/50" alt="Bowls"
                                class="w-12 h-12 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium text-gray-800">Bowls</h3>
                                <p class="text-sm text-gray-500">15 products</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Category Item -->
                    <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                        <div class="flex items-center space-x-4">
                            <img src="https://via.placeholder.com/50" alt="Tea Sets"
                                class="w-12 h-12 rounded-lg object-cover">
                            <div>
                                <h3 class="font-medium text-gray-800">Tea Sets</h3>
                                <p class="text-sm text-gray-500">12 products</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            // Image Upload Handling
            const uploadAreas = document.querySelectorAll('.image-upload-area');

            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    const previewContainer = document.querySelector('.preview-container');
                    const previewImage = previewContainer.querySelector('img');

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.classList.remove('hidden');
                    };

                    reader.readAsDataURL(file);
                }
            }

            uploadAreas.forEach(area => {
                const input = area.querySelector('input[type="file"]');
                const button = area.querySelector('button');

                // Handle click on browse button
                button.addEventListener('click', () => {
                    input.click();
                });

                // Handle drag and drop
                area.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    area.classList.add('border-amber-600', 'bg-amber-50');
                });

                area.addEventListener('dragleave', () => {
                    area.classList.remove('border-amber-600', 'bg-amber-50');
                });

                area.addEventListener('drop', (e) => {
                    e.preventDefault();
                    area.classList.remove('border-amber-600', 'bg-amber-50');

                    if (e.dataTransfer.files.length) {
                        input.files = e.dataTransfer.files;
                        handleFiles(input.files);
                    }
                });

                // Handle file input change
                input.addEventListener('change', () => {
                    handleFiles(input.files);
                });
            });
        </script>
    @endpush
@endsection
