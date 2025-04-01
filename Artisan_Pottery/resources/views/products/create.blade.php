@extends('layouts.admin.master')

@section('title', 'Seller Dashboard')

@section('content')

    <!-- Top Navigation -->
    <nav class="bg-white shadow-sm p-4 md:hidden">
        <button class="text-gray-500 hover:text-gray-700" id="openSidebar">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Products Content -->
    <div class="p-6">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div class="mb-4 md:mb-0">
                <h1 class="text-2xl font-playfair font-bold text-gray-800 mb-2">Manage Products</h1>
                <p class="text-gray-600">Add and manage your pottery products</p>
            </div>
            
        </div>

        <!-- Add/Edit Product Form -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
            <h2 class="font-playfair text-xl font-bold text-gray-800 mb-6">Product Information</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Product Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name*</label>
                        <input type="text" id="name" name="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="Enter product name" required>
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category*</label>
                        <select id="category_id" name="category_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price*</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">$</span>
                            <input type="number" id="price" name="price"
                                class="w-full pl-8 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                                placeholder="0.00" step="0.01" required>
                        </div>
                    </div>

                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity*</label>
                        <input type="number" id="stock" name="stock"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="Enter quantity" required>
                    </div>

                    <!-- Discount -->
                    <div>
                        <label for="discount" class="block text-sm font-medium text-gray-700 mb-1">Discount (%)</label>
                        <input type="number" id="discount" name="discount"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                            placeholder="Enter discount percentage" step="0.01">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description*</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent"
                        placeholder="Enter product description" required></textarea>
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Images*</label>
                    <div class="drag-drop-zone p-8 rounded-lg text-center" id="dropZone">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-600 mb-2">Drag and drop your images here</p>
                        <p class="text-sm text-gray-500 mb-4">or</p>
                        <button type="button"
                            class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-2 rounded-lg transition-colors">
                            Browse Files
                        </button>
                        <input type="file" class="hidden" id="fileInput" name="image" multiple accept="image/*">
                    </div>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-4" id="imagePreview">
                        <!-- Image previews will be inserted here -->
                    </div>
                </div>
                
                <!-- Submit Buttons -->
                <div class="flex flex-col md:flex-row justify-end space-y-4 md:space-y-0 md:space-x-4">
                    <a href="{{ route('products.index') }}"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
<script>
    // Image Upload Handling
    const uploadArea = document.querySelector('.drag-drop-zone');
    const input = uploadArea.querySelector('input[type="file"]');
    const button = uploadArea.querySelector('button');
    const previewContainer = document.getElementById('imagePreview');

    function handleFiles(files) {
        previewContainer.innerHTML = ''; // Clear previous previews
        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                const img = document.createElement('img');
                img.classList.add('w-full', 'h-auto', 'object-cover', 'rounded-lg');

                reader.onload = function(e) {
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
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