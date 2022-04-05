<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div>
        {{-- Nothing in the world is as soft and yielding as water. --}}
        <div class="flex flex-wrap">
            <div class="w-1/5 p-2">
                <div class="auth-user p-2 text-center bg-gray-300">
                    <p>{{auth()->user()->name}}</p>
                </div>
                <hr>
                <div class="conversation-user w-full border">
                    @foreach ($conversations as $conversation)
                        @if ($conversation->user_two != auth()->user()->id)
                        <div class="block border-b-2 hover:cursor-pointer w-full p-2 {{(!is_null($user_select_id) && ($conversation->user_one == $user_select_id || $conversation->user_two == $user_select_id)) ? 'text-white bg-green-400' : ''}}" wire:click.prevent="setConversation({{$conversation->id}}, {{$conversation->user_two}})">
                            <p class="">{{$conversation->user_two_instance->name}}</p>
                        </div>
                        @elseif($conversation->user_one != auth()->user()->id)
                        <div class="block border-b-2 hover:cursor-pointer w-full p-2 {{(!is_null($user_select_id) && ($conversation->user_two == $user_select_id || $conversation->user_one == $user_select_id)) ? 'text-white bg-green-400' : ''}}" wire:click.prevent="setConversation({{$conversation->id}}, {{$conversation->user_one}})">
                            <p class="">{{$conversation->user_one_instance->name}}</p>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="w-4/5 p-2 ">
                @if ($messages!=null)
                    <div class="flex flex-col border p-2">
                        @foreach ($messages as $m)
                            @if ($m->user_id == auth()->user()->id)
                                <div class="block rounded shadow self-end mt-1 w-max p-2 bg-blue-400 mr-0 text-white">
                                    <p class="text-white ">{!!$m->message!!}</p>
                                    <p class="text-white text-xs">{{\Carbon\Carbon::parse($m->created_at)->locale('id_ID')->diffForHumans()}}</p>
                                </div>
                            @else
                            <div class="block rounded shadow w-max mt-1 self-start p-2 bg-gray-400 ml-0 text-white">
                                <p class="text-white ">{!!$m->message!!}</p>
                                <p class="text-white text-xs">{{\Carbon\Carbon::parse($m->created_at)->locale('id_ID')->diffForHumans()}}</p>
                            </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <p class="p-2 border">Pilih user</p>
                @endif
                @if (!is_null($conversation_id))
                <div class="w-full mt-3">
                    <div wire:ignore class="p-2 border-2 border-blue-500 rounded-b mb-2">
                        <trix-editor
                        wire:model.debounce.365ms="message" class="editor-content"></trix-editor>
                    </div>
                    {{-- <input type="text" wire:model="message" class="p-2 border-blue rounded border w-4/5"> --}}
                    <button wire:click.prevent="addMessage" class="p-2 bg-blue-500 rounded text-white w-1/5">Send</button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
