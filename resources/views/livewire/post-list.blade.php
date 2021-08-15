<div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-4">
                <input type="search" wire:model.debounce="search" class="form-control" placeholder="Search...">
            </div>
            <div class="col-4 offset-4">
                <button class="btn btn-primary float-end" wire:click="create">Create</button>
            </div>
            <div class="col-12 mt-3">

                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ Str::limit($post->content, 50) }}</td>
                            <td>
                                <button class="btn btn-success" wire:click="edit({{ $post }})">Edit</button>
                                <button class="btn btn-danger mr-2" wire:click="destroy({{ $post->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </thead>
                </table>
                {{ $posts->appends(request()->query())->links() }}

                @include('livewire.post-form')
            </div>
        </div>
    </div>
    @section('script')
    <script>
        var postModal = new bootstrap.Modal(document.getElementById('postModal'), {});

        Livewire.on('openPostModal', () => {
            postModal.show();
        });

        Livewire.on('closePostModal', () => {
            postModal.hide();
        });
    </script>
    @stop
</div>