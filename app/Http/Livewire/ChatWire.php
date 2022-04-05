<?php

namespace App\Http\Livewire;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
class ChatWire extends Component
{
    public $messages;
    public $conversation_id;
    public $conversations;
    public $message;
    public $user_select_id;
    public function mount(){
        $this->conversations = Conversation::search(auth()->user()->id)->get();
    }
    public function setConversation($id, $user_id){
        $this->conversation_id = Conversation::find($id);
        $this->user_select_id = $user_id;
        // dd($this->user_select_id);
    }
    public function addMessage(){
        Message::create([
            'conversation_id'=>$this->conversation_id->id,
            'user_id'=>auth()->user()->id,
            'message'=>$this->message
        ]);
        $this->reset('message');
    }
    public function render()
    {
        if($this->conversation_id != null){
            $this->messages = Message::where('conversation_id',$this->conversation_id->id)->get();
        }
        return view('livewire.chat-wire');
    }
}
