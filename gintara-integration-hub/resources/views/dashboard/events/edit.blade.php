@extends('dashboard.layouts.app')
@section('title', 'Edit Event - Gintara Net')

@section('content')

<div class="mb-4 lg:mb-6 flex items-center gap-3">
  <a href="{{ route('events.show', $event) }}" class="w-9 h-9 rounded-xl bg-white shadow-card flex items-center justify-center text-ink-soft shrink-0">
    @include('dashboard.partials.icon', ['name' => 'chevron-left', 'class' => 'w-4 h-4'])
  </a>
  <div>
    <p class="hidden lg:block text-sm text-ink-soft">GINTARA NET &bull; Manajemen Event</p>
    <h1 class="text-lg lg:text-2xl font-bold text-ink">Edit Event</h1>
  </div>
</div>

<div class="g-card lg:max-w-xl">
  <form action="{{ route('events.update', $event) }}" method="POST">
    @method('PUT')
    @include('dashboard.events._form', ['event' => $event, 'submitLabel' => 'Update'])
  </form>
</div>

@endsection
