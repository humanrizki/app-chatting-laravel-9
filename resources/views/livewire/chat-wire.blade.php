<div>
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
            @if ($conversation_id!=null)
                <div class="flex flex-col border p-2">
                    @if ($messages->count() == 0)
                        <p class="p-2 border">Belum ada pesan</p>
                    @else
                        @foreach ($messages as $m)
                            @if ($m->user_id == auth()->user()->id)
                                <div class="block rounded shadow self-end mt-1 w-max p-2 bg-blue-400 mr-0 text-white relative" x-data="{open : false}" @open="open = ! open">
                                    <div class="block message ">
                                        <div class="flex mx-2 justify-end items-start">
                                            <div class="text-white w-max">
                                                {!!$m->message!!}
                                            </div>
                                            <button @click="$dispatch('open')" class="ml-5"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                        </div>
                                        @if ($m->created_at != $m->updated_at)
                                            <p class="text-white text-xs text-right mr-2">{{\Carbon\Carbon::parse($m->created_at)->locale('id_ID')->format('H:i')}} - edited</p>
                                        @else
                                            <p class="text-white text-xs text-right mr-2">{{\Carbon\Carbon::parse($m->created_at)->locale('id_ID')->format('H:i')}}</p>
                                        @endif
                                    </div>
                                    <div x-show="open" @click.away="open = false"  class="absolute bg-white top-[35px] right-[40px] border rounded shadow z-50 w-[150px] h-max">
                                        <ul class="text-gray-700 text-sm">
                                            @if (!is_null($message_id) && $message_id == $m->id)
                                                <li class="w-full hover:bg-yellow-100 text-center p-2 hover:text-yellow-800 text-gray-700"><button wire:click.prevent="cancellEditMessage" x-on:click="open = ! open" class="w-full h-full">Cancel editing</button></li>
                                            @else
                                                <li class="w-full hover:bg-yellow-100 text-center p-2 hover:text-yellow-800 text-gray-700"><button wire:click.prevent="editMessage({{$m->id}})" class="w-full h-full" x-on:click="open = ! open">Edit</button></li>
                                            @endif
                                            <hr>
                                            <li class="w-full hover:bg-red-100 text-center p-2 hover:text-red-500 text-gray-700"><button wire:click.prevent="deleteMessage({{$m->id}})" x-on:click="open = ! open" class="w-full h-full">Delete</button></li>
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="block rounded shadow w-max mt-1 self-start p-2 bg-gray-400 ml-0 text-white">
                                    <p class="text-white ">{!!$m->message!!}</p>
                                    @if ($m->created_at != $m->updated_at)
                                    <p class="text-white text-xs text-left">{{\Carbon\Carbon::parse($m->created_at)->locale('id_ID')->format('H:i')}} - edited</p>
                                    @else
                                    <p class="text-white text-xs text-left">{{\Carbon\Carbon::parse($m->created_at)->locale('id_ID')->format('H:i')}} - edited</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            @else
                <p class="p-2 border">Pilih user</p>
            @endif
            @if (!is_null($conversation_id))
                @if ($message_id == null)
                    <div class="w-full mt-3">
                        <div wire:ignore class="p-2 border-2 border-blue-500 rounded-b mb-2">
                            <trix-editor
                            wire:model.debounce.365ms="message" class="editor-content"></trix-editor>
                        </div>
                        <button wire:click.prevent="addMessage" class="p-2  rounded text-white w-1/5 @if($message == null) bg-gray-400 @else bg-blue-500 @endif" @if ($message == null)
                            disabled
                        @endif>Send</button>
                    </div>
                @elseif($message_id != null)
                    <div class="w-full mt-3">
                        <div wire:ignore class="p-2 border-2 border-blue-500 rounded-b mb-2">
                            <trix-editor wire:model.debounce.365ms="message" class="editor-content"></trix-editor>
                        </div>
                        <button wire:click.prevent="updateMessage({{$message_id}})" class="p-2  rounded text-white w-1/5 @if($message == null) bg-gray-400 @else bg-blue-500 @endif" @if ($message == null)
                            disabled
                        @endif>Edit message</button>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
