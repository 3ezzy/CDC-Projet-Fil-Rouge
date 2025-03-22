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