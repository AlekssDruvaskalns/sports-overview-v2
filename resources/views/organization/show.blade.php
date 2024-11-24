<x-app-layout>
    <div class="w-full rounded overflow-hidden shadow-lg p-4 bg-white mb-4">
            <div class="flex justify-between">
                <div>       
                    <a class="font-bold text-xl mb-2" href="{{ route('organization.show', $organization->id) }}">
                        {{ $organization->name }}
                    </a>
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block shadow-lg bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $organization->tag }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('organization.edit', $organization->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <form action="{{ route('organization.destroy', $organization->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="px-6 pt-4 pb-2">
                <h1>Events</h1>
                <table class="w-full table-auto">
                    <tbody>
                        @foreach($organization->events as $event)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $event->name }} | {{ $event->date }}

                                    <form action="{{ route('organization.removeevent', $organization->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="event" value="{{ $event->id }}">
                                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <form action="{{ route('organization.addevent', $organization->id) }}" method="POST" class="inline-block">
                    @csrf
                    <label for="event">Choose a event:</label>
                    <select name="event" id="event">
                        @foreach($allEvents as $event)
                            <option value="{{ $event->id }}">{{ $event->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        Add
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
