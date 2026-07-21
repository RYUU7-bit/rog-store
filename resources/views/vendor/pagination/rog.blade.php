@if ($paginator->hasPages())
<nav style="display:flex; gap:.4rem; align-items:center; flex-wrap:wrap;">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
    <span style="padding:.4rem .85rem; background:#111; border:1px solid #1e1e1e; color:#444; font-size:.8rem; font-weight:700;">‹</span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}" style="padding:.4rem .85rem; background:#111; border:1px solid #2a2a2a; color:#aaa; font-size:.8rem; font-weight:700; text-decoration:none; transition:all .2s;" onmouseover="this.style.borderColor='var(--rog-red)';this.style.color='var(--rog-red)'" onmouseout="this.style.borderColor='#2a2a2a';this.style.color='#aaa'">‹</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
        <span style="padding:.4rem .6rem; color:#444; font-size:.85rem;">…</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span style="padding:.4rem .85rem; background:var(--rog-red); border:1px solid var(--rog-red); color:#fff; font-size:.82rem; font-weight:700;">{{ $page }}</span>
                @else
                <a href="{{ $url }}" style="padding:.4rem .85rem; background:#111; border:1px solid #2a2a2a; color:#aaa; font-size:.82rem; font-weight:700; text-decoration:none; transition:all .2s;" onmouseover="this.style.borderColor='var(--rog-red)';this.style.color='var(--rog-red)'" onmouseout="this.style.borderColor='#2a2a2a';this.style.color='#aaa'">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}" style="padding:.4rem .85rem; background:#111; border:1px solid #2a2a2a; color:#aaa; font-size:.8rem; font-weight:700; text-decoration:none; transition:all .2s;" onmouseover="this.style.borderColor='var(--rog-red)';this.style.color='var(--rog-red)'" onmouseout="this.style.borderColor='#2a2a2a';this.style.color='#aaa'">›</a>
    @else
    <span style="padding:.4rem .85rem; background:#111; border:1px solid #1e1e1e; color:#444; font-size:.8rem; font-weight:700;">›</span>
    @endif
</nav>
@endif
