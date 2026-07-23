{{-- Pakai: @include('dashboard.partials.icon', ['name' => 'bolt', 'class' => 'w-5 h-5']) --}}
@php $cls = $class ?? 'w-5 h-5'; @endphp

@switch($name)
  @case('bolt')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2 3 14h7l-1 8 10-12h-7l1-8Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('clock')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 3" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('check')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="m8 12 3 3 5-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('alert')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 9v4m0 4h.01M10.3 3.9 1.8 18a2 2 0 0 0 1.7 3h17a2 2 0 0 0 1.7-3L13.7 3.9a2 2 0 0 0-3.4 0Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('plus')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14" stroke-linecap="round"/></svg>
    @break
  @case('refresh')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4v5h5M20 20v-5h-5M4.6 15a8 8 0 0 0 14.4 2M19.4 9A8 8 0 0 0 5 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('layers')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 3 9 5-9 5-9-5 9-5Zm-9 9 9 5 9-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('list')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('bell')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9a6 6 0 1 1 12 0c0 5 2 6 2 6H4s2-1 2-6Z" stroke-linecap="round" stroke-linejoin="round"/><path d="M9.5 19a2.5 2.5 0 0 0 5 0" stroke-linecap="round"/></svg>
    @break
  @case('search')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4.3-4.3" stroke-linecap="round"/></svg>
    @break
  @case('home')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 11 9-8 9 8" stroke-linecap="round" stroke-linejoin="round"/><path d="M5 10v10h14V10" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('activity')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h4l2 8 4-16 2 8h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('apps')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
    @break
  @case('user')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6" stroke-linecap="round"/></svg>
    @break
  @case('menu')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round"/></svg>
    @break
  @case('trash')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m-9 0 1 13a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2l1-13" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('calendar')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M16 3v4M8 3v4M3 10h18" stroke-linecap="round"/></svg>
    @break
  @case('chevron-down')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m6 9 6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('upload')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 16V4m0 0 4 4m-4-4-4 4M4 16v3a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-3" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('shield')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3 4 6v6c0 4.5 3.4 7.7 8 9 4.6-1.3 8-4.5 8-9V6l-8-3Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('database')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="8" ry="3"/><path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 12c0 1.7 3.6 3 8 3s8-1.3 8-3" stroke-linecap="round"/></svg>
    @break
  @case('grid')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
    @break
  @case('filter')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M7 12h10M10 18h4" stroke-linecap="round"/></svg>
    @break
  @case('erp')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2"/><path d="M8 9h8M8 12h8M8 15h5" stroke-linecap="round"/></svg>
    @break
  @case('billing')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 10h18M7 15h4" stroke-linecap="round"/></svg>
    @break
  @case('pulse')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h4l2 8 4-16 2 8h6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('wifi')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 8.5a16 16 0 0 1 20 0M5.5 12a11 11 0 0 1 13 0M9 15.5a6 6 0 0 1 6 0" stroke-linecap="round"/><circle cx="12" cy="19" r="1" fill="currentColor" stroke="none"/></svg>
    @break
  @case('sync')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m17 2 4 4-4 4" stroke-linecap="round" stroke-linejoin="round"/><path d="M3 12v-2a4 4 0 0 1 4-4h14" stroke-linecap="round"/><path d="m7 22-4-4 4-4" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 12v2a4 4 0 0 1-4 4H3" stroke-linecap="round"/></svg>
    @break
  @case('pin')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7Z" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="9" r="2.5"/></svg>
    @break
  @case('alert-circle')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 8v5m0 3h.01" stroke-linecap="round"/></svg>
    @break
  @case('sliders')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 4v6m0 4v6M12 4v3m0 4v9M18 4v10m0 4v2" stroke-linecap="round"/><circle cx="6" cy="12" r="2"/><circle cx="12" cy="13" r="2"/><circle cx="18" cy="16" r="2"/></svg>
    @break
  @case('chevron-right')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m9 6 6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('chevron-left')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 6-6 6 6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('logout')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H6a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3" stroke-linecap="round" stroke-linejoin="round"/><path d="m16 17 5-5-5-5M21 12H9" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
  @case('lock')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="10" width="16" height="10" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3" stroke-linecap="round"/></svg>
    @break
  @case('help')
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $cls }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M9.5 9a2.5 2.5 0 0 1 4.8 1c0 1.5-2.3 1.8-2.3 3.5m0 2.5h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>
    @break
@endswitch
