{{-- Recursive org chart node partial --}}
<li class="org-fade-in" style="animation-delay: {{ $delay ?? 0 }}s">
    <div class="org-card {{ ($isRoot ?? false) ? 'org-card--head' : '' }}">
        @if($member->photo)
            <img src="{{ asset('storage/' . $member->photo) }}" 
                 alt="{{ $member->name ?? $member->position }}" 
                 class="org-card__photo">
        @else
            <div class="org-card__placeholder">
                <svg class="w-8 h-8 {{ ($isRoot ?? false) ? 'text-yellow-300' : 'text-slate-300' }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
        @endif
        <div class="org-card__position">{{ $member->position }}</div>
        <div class="org-card__name">{{ $member->name ?? '-' }}</div>
        @if($member->nip)
            <div class="org-card__nip">NIP. {{ $member->nip }}</div>
        @endif
    </div>

    @if($member->children && $member->children->count() > 0)
        <ul>
            @foreach($member->children as $childIndex => $child)
                @include('profile._org_node', ['member' => $child, 'isRoot' => false, 'delay' => ($delay ?? 0) + ($childIndex + 1) * 0.08])
            @endforeach
        </ul>
    @endif
</li>
