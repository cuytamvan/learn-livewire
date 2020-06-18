<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

use Carbon\Carbon;

use App\Comment;

use ImageManagerStatic;
use Storage;

class Comments extends Component
{
    use WithPagination, WithFileUploads;
    // public $comments = [];
    public $body, $image;
    public $ticketId = 1;

    protected $validation = [
        'body' => 'required|string|max:255',
    ];
    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected', // amun boga emit jeung fungsi nu sama, bisa di deklarasi keun kos kieu
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

        $image = $this->storeImage();
        $data = Comment::create([
            'body' => $this->body,
            'image' => $image,
            'user_id' => 1,
            'support_ticket_id' => $this->ticketId,
        ]);
        // $this->comments->prepend($data); // refresh data / add new data
        $this->body = '';
        $this->image = null;

        session()->flash('message', [
            'message' => 'Comment added successfully 😂️',
            'color'   => 'success'
        ]);
    }

    public function deleteComment($id){
        $data = Comment::find($id);
        if($data) {
            $path = 'comments/'.$data->image;
            Storage::disk('public')->delete($path);

            $data->delete();
        }

        // $this->comments = $this->comments->where('id', '!=', $id);
        // $this->comments = $this->comments->except($id);

        session()->flash('message', [
            'message' => 'Comment deleted successfully 😭️',
            'color'   => 'warning'
        ]);
    }

    public function handleFileUpload($img){
        $this->image = $img;
    }

    public function ticketSelected($id){
        $this->ticketId = $id;
    }

    public function storeImage(){
        if(!$this->image) return null;

        $img  = ImageManagerStatic::make($this->image)->encode('jpg');
        $path = 'comments/';
        $rand = Carbon::now()->timestamp.'_'.uniqid().'.jpg';

        Storage::disk('public')->put($path.$rand, $img);
        return $rand;
    }

    public function render(){
        $comments = Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(5);
        return view('livewire.comment', compact('comments'));
    }
}
