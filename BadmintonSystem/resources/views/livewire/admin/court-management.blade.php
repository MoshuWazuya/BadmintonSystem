<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Court Management</h2>

    @if(session()->has('error'))
        <div class="bg-red-100 text-red-700 p-2 mb-4 rounded">{{ session('error') }}</div>
    @endif

    <form wire:submit.prevent="saveCourt" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <input type="text" wire:model="court_name" placeholder="Court Name" class="border p-2 rounded" required>
        <input type="text" wire:model="court_type" placeholder="Court Type" class="border p-2 rounded" required>
        <input type="text" wire:model="location" placeholder="Location" class="border p-2 rounded" required>
        <select wire:model="status" class="border p-2 rounded">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
        <div class="md:col-span-4 mt-2">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ $editCourtId ? 'Update Court' : 'Add Court' }}
            </button>
            <button type="button" wire:click="resetInputs" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                Reset
            </button>
        </div>
    </form>

    <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($courts as $court)
            <tr>
                <td>{{ $court->court_id }}</td>
                <td>{{ $court->court_name }}</td>
                <td>{{ $court->court_type }}</td>
                <td>{{ $court->location }}</td>
                <td>
                    <select wire:change="updateCourtStatus({{ $court->court_id }}, $event.target.value)"
                            class="border px-2 py-1 rounded">
                        <option value="active" {{ $court->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $court->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </td>
                <td>
                    <button wire:click="editCourt({{ $court->court_id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>

                    @if($court->bookings()->whereIn('status',['pending','approved'])->count() === 0)
                        <button wire:click="deleteCourt({{ $court->court_id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    @else
                        <span class="text-gray-500">Cannot delete</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>








