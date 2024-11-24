<x-app-layout>
    <div class="container mx-auto max-w-lg mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-extrabold mb-8 text-center text-blue-600">Create Event</h1>
        <form action="{{ route('event.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="form-group">
                <label for="name" class="block text-sm font-medium text-gray-800">Event Name</label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       placeholder="Enter event name" 
                       class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-600 focus:border-blue-600 placeholder-gray-400" 
                       required>
            </div>
            <div class="form-group">
                <label for="date" class="block text-sm font-medium text-gray-800">Event Date</label>
                <input type="date" 
                       id="date" 
                       name="date" 
                       class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-600 focus:border-blue-600" 
                       required>
            </div>
            <div class="form-group">
                <label for="location" class="block text-sm font-medium text-gray-800">Event Location</label>
                <input type="text" 
                       id="location" 
                       name="location" 
                       placeholder="Enter event location" 
                       class="mt-2 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-600 focus:border-blue-600 placeholder-gray-400" 
                       required>
            </div>
            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold text-lg py-3 px-4 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
                Create Event
            </button>
        </form>
    </div>
</x-app-layout>
