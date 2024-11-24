<x-app-layout>
    <div class="w-full rounded overflow-hidden shadow-lg p-4 bg-white mb-4">
            <div class="flex justify-between">
                <div>       
                    <a class="font-bold text-xl mb-2" href="{{ route('event.show', $event->id) }}">
                        {{ $event->name }}
                    </a>
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block shadow-lg bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $event->date }}</span>
                    </div>
                    <div class="px-6 pt-4 pb-2">
                        <span class="inline-block shadow-lg bg-gray-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $event->location }}</span>
                    </div>
                </div>
                <div>
                    <a href="{{ route('event.edit', $event->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Edit
                    </a>
                    <form action="{{ route('event.destroy', $event->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="px-6 pt-4 pb-2">
                <h1>Organizations</h1>
                <table class="w-full table-auto">
                    <tbody>
                        @foreach($event->organizations as $organization)
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $organization->name }} | {{ $organization->tag }}

                                    <form action="{{ route('event.removeorganization', $event->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="organization" value="{{ $organization->id }}">
                                        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <form action="{{ route('event.addorganization', $event->id) }}" method="POST" class="inline-block">
                    @csrf
                    <label for="organization">Choose a organization:</label>
                    <select name="organization" id="organization">
                        @foreach($allorganizations as $organization)
                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
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
