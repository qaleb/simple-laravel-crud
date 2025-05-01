<div>
    @section('title', 'Simple User Management')

    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    
    <div class="mt-2 text-center">
        <img src="{{ asset('assets/img/logo.svg') }}" alt="" style="width: 150px; height: auto;">
    </div>
    
    <div class="mt-3">
        <!-- Trigger Modal Button -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
            {{ $updateMode ? 'Edit User' : 'Add User' }}
        </button>
    </div>

    <!-- User Modal -->
    @include('livewire.add-user')

    <div class="card">
        <div class="card-header">
            <h5>User List</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->favourite_color }}</td>
                            <td>
                                <button type="button" wire:click="edit({{ $user->id }})" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#userModal">Edit</button>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $user->id }})">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('delete', { id: id }); // Pass payload as an object
                Swal.fire(
                    'Deleted!',
                    'The user has been deleted.',
                    'success'
                )
            }
        });
    }
</script>
@endsection