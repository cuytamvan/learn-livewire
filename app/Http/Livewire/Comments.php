<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

use Carbon\Carbon;
use App\Comment;

class Comments extends Component
{
    use WithPagination;
    // public $comments = [];
    public $body;

    protected $validation = [
        'body' => 'required|string|max:255'
    ];

    // fungsi na okos constructor 
    // public function mount(){
    //     $initialComments = Comment::latest()->get();
    //     $this->comments = $initialComments;
    // }

    // fungsi bawaan livewire ajang realtime validation
    public function updated($field){
        $this->validateOnly($field, $this->validation);
    }

    public function addComment(){
        $this->validate($this->validation);

        $data = Comment::create([
            'body' => $this->body,
            'user_id' => 1
        ]);
        // $this->comments->prepend($data); // refresh data / add new data
        $this->body = '';

        session()->flash('message', [
            'message' => 'Comment added successfully 😂️',
            'color'   => 'success'
        ]);
    }

    public function deleteComment($id){
        $data = Comment::find($id);
        if($data) $data->delete();

        // $this->comments = $this->comments->where('id', '!=', $id);
        // $this->comments = $this->comments->except($id);

        session()->flash('message', [
            'message' => 'Comment deleted successfully 😭️',
            'color'   => 'warning'
        ]);
    }

    public function render(){
        $comments = Comment::latest()->paginate(20);
        return view('livewire.comment', compact('comments'));
    }
}
