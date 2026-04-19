<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers Management System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">

    <aside class="w-64 bg-slate-900 text-white p-5 hidden md:block">
        <h2 class="text-xl font-bold mb-8 text-blue-400">TMS Dashboard</h2>
        <nav class="space-y-4">
            <a href="#" class="block p-3 hover:bg-slate-800 rounded">Dashboard</a>
            <a href="#" class="block p-3 hover:bg-slate-800 rounded">Teacher List</a>
            <a href="#" class="block p-3 hover:bg-slate-800 rounded">Add Teacher</a>
            <a href="#" class="block p-3 hover:bg-slate-800 rounded">Settings</a>
        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto">
        <header class="bg-white shadow-sm p-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold">Teacher Management</h1>
            <div class="flex items-center gap-3">
                <span>Welcome, Sakib</span>
                <button class="bg-red-500 text-white px-4 py-1 rounded">Logout</button>
            </div>
        </header>

        <div class="p-6">
            @yield('content')
        </div>
    </main>

</body>
</html>
