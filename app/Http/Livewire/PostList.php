<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    public $isEditMode = false;
    public $search;
    public $selectedId;
    public $title;
    public $content;

    protected $rules = [
        'title' => 'required|min:6',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->isEditMode = false;

        $this->resetForm();

        $this->emit('openPostModal');
    }

    public function edit($post)
    {
        $this->isEditMode = true;

        $this->resetForm();

        $this->selectedId = $post['id'];
        $this->title = $post['title'];
        $this->content = $post['content'];

        $this->emit('openPostModal');
    }

    public function submit()
    {
        $this->validate();

        if ($this->isEditMode) {
            $post = Post::findOrFail($this->selectedId);
            $post->update([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            session()->flash('success', 'Post successfully updated.');
        } else {
            Post::create([
                'title' => $this->title,
                'content' => $this->content,
            ]);

            $this->search = null;

            session()->flash('success', 'Post successfully created.');
        }

        $this->emit('closePostModal');
    }

    public function resetForm()
    {
        $this->resetErrorBag();

        $this->title = null;
        $this->content = null;
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        $this->emit('closePostModal');
    }

    public function render()
    {
        $posts = Post::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->latest('id')->paginate(3);

        return view('livewire.post-list', [
            'posts' => $posts,
        ]);
    }
}
