@extends('chat.app')
@section('head')
<style>
    trix-toolbar [data-trix-button-group="file-tools"]{
        display: none;
    }
    .trix-button--icon-increase-nesting-level,
    .trix-button--icon-decrease-nesting-level,
    .trix-button--icon-link,
    .trix-button--icon-bold,
    .trix-button--icon-italic,
    .trix-button--icon-heading-1,
    .trix-button--icon-strike,
    .trix-button--icon-quote,
    .trix-button--icon-code,
    .trix-button--icon-bullet-list,
    .trix-button--icon-number-list,
    .trix-button-group--text-tools[data-trix-button-group="text-tools"],
    .trix-button-group--block-tools[data-trix-button-group="block-tools"] { display: none; }
</style>
@endsection
@section('content')
<livewire:chat-wire/>
@endsection
