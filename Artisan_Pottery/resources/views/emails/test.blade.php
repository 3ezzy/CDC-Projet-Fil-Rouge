<!DOCTYPE html>
<html>
<head>
    <title>{{ $details['title'] }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="font-sans text-gray-800 leading-relaxed max-w-xl mx-auto p-5">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-amber-600">Artisan Pottery</h1>
    </div>

    <div class="bg-gray-50 p-6 rounded-lg mb-6 shadow-sm">
        <h2 class="text-xl font-semibold mb-4">{{ $details['title'] }}</h2>
        <p class="mb-4">{{ $details['body'] }}</p>
        <p>This is a test email sent from the Artisan Pottery website to verify that Mailtrap is properly configured.</p>
    </div>

    <div class="text-center text-sm text-gray-500 mt-8">
        <p>© {{ date('Y') }} Artisan Pottery. All rights reserved.</p>
        <p>This is an automated message, please do not reply.</p>
    </div>
</body>
</html> 