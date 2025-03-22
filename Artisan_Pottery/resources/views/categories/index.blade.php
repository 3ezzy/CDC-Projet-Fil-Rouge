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
                @include('categories.create')
            </div>

            <!-- Existing Categories -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="font-playfair text-xl font-bold text-gray-800 mb-6">Existing Categories</h2>
                <div class="space-y-4">
                    @foreach ($categories as $category)
                        <!-- Category Item -->
                        <div class="flex items-center justify-between p-4 border rounded-lg hover:bg-gray-50">
                            <div class="flex items-center space-x-4">
                                @if ($category->image_path)
                                    <img src="{{ Storage::url($category->image_path) }}" alt="{{ $category->name }}"
                                        class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <img src="https://via.placeholder.com/50" alt="{{ $category->name }}"
                                        class="w-12 h-12 rounded-lg object-cover">
                                @endif
                                <div>
                                    <h3 class="font-medium text-gray-800">{{ $category->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $category->products_count ?? '0' }} products</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    @if ($categories->isEmpty())
                        <div class="text-center py-8">
                            <p class="text-gray-500">No categories found</p>
                        </div>
                    @endif

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $categories->links() }}
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
