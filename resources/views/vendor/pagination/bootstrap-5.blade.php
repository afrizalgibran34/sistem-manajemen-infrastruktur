@if ($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
    @endphp

    <nav aria-label="Pagination Navigation">
        <ul class="pagination custom-pagination justify-content-center mb-0">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Logic --}}
            @if ($lastPage <= 7)
                {{-- Show all pages if 7 or less --}}
                @for ($i = 1; $i <= $lastPage; $i++)
                    <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                        <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
            @else
                {{-- Complex pagination with ellipsis --}}
                @if ($currentPage <= 3)
                    {{-- Near the beginning: 1 2 3 ... last --}}
                    @for ($i = 1; $i <= 3; $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item page-jump-container">
                        <div class="page-jump-wrapper">
                            <a class="page-link" href="javascript:void(0)" onclick="togglePageJump(this, {{ $lastPage }})" title="Jump to page">...</a>
                            <div class="page-jump-input" style="display: none;">
                                <input type="number" min="1" max="{{ $lastPage }}" placeholder="Page" class="jump-input" onkeypress="handleJumpEnter(event, {{ $lastPage }})">
                                <button type="button" class="jump-btn" onclick="jumpToPageFromInput(this, {{ $lastPage }})">Go</button>
                            </div>
                        </div>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @elseif ($currentPage >= $lastPage - 2)
                    {{-- Near the end: 1 ... last-2 last-1 last --}}
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                    </li>
                    <li class="page-item page-jump-container">
                        <div class="page-jump-wrapper">
                            <a class="page-link" href="javascript:void(0)" onclick="togglePageJump(this, {{ $lastPage }})" title="Jump to page">...</a>
                            <div class="page-jump-input" style="display: none;">
                                <input type="number" min="1" max="{{ $lastPage }}" placeholder="Page" class="jump-input" onkeypress="handleJumpEnter(event, {{ $lastPage }})">
                                <button type="button" class="jump-btn" onclick="jumpToPageFromInput(this, {{ $lastPage }})">Go</button>
                            </div>
                        </div>
                    </li>
                    @for ($i = $lastPage - 2; $i <= $lastPage; $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                @else
                    {{-- In the middle: 1 ... current-1 current current+1 ... last --}}
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url(1) }}">1</a>
                    </li>
                    <li class="page-item page-jump-container">
                        <div class="page-jump-wrapper">
                            <a class="page-link" href="javascript:void(0)" onclick="togglePageJump(this, {{ $lastPage }})" title="Jump to page">...</a>
                            <div class="page-jump-input" style="display: none;">
                                <input type="number" min="1" max="{{ $lastPage }}" placeholder="Page" class="jump-input" onkeypress="handleJumpEnter(event, {{ $lastPage }})">
                                <button type="button" class="jump-btn" onclick="jumpToPageFromInput(this, {{ $lastPage }})">Go</button>
                            </div>
                        </div>
                    </li>
                    @for ($i = $currentPage - 1; $i <= $currentPage + 1; $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item page-jump-container">
                        <div class="page-jump-wrapper">
                            <a class="page-link" href="javascript:void(0)" onclick="togglePageJump(this, {{ $lastPage }})" title="Jump to page">...</a>
                            <div class="page-jump-input" style="display: none;">
                                <input type="number" min="1" max="{{ $lastPage }}" placeholder="Page" class="jump-input" onkeypress="handleJumpEnter(event, {{ $lastPage }})">
                                <button type="button" class="jump-btn" onclick="jumpToPageFromInput(this, {{ $lastPage }})">Go</button>
                            </div>
                        </div>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->url($lastPage) }}">{{ $lastPage }}</a>
                    </li>
                @endif
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>

    <script>
        function togglePageJump(element, lastPage) {
            // Close all other open jump inputs
            document.querySelectorAll('.page-jump-input').forEach(input => {
                if (input !== element.nextElementSibling) {
                    input.style.display = 'none';
                }
            });
            
            // Toggle current input
            const inputDiv = element.nextElementSibling;
            if (inputDiv.style.display === 'none') {
                inputDiv.style.display = 'flex';
                const input = inputDiv.querySelector('.jump-input');
                input.focus();
                input.value = '';
            } else {
                inputDiv.style.display = 'none';
            }
        }
        
        function jumpToPageFromInput(button, lastPage) {
            const input = button.previousElementSibling;
            const page = parseInt(input.value);
            
            if (page >= 1 && page <= lastPage) {
                const url = new URL(window.location.href);
                url.searchParams.set('page', page);
                window.location.href = url.toString();
            }
        }
        
        function handleJumpEnter(event, lastPage) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const input = event.target;
                const page = parseInt(input.value);
                
                if (page >= 1 && page <= lastPage) {
                    const url = new URL(window.location.href);
                    url.searchParams.set('page', page);
                    window.location.href = url.toString();
                }
            }
        }
        
        // Close jump input when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.page-jump-container')) {
                document.querySelectorAll('.page-jump-input').forEach(input => {
                    input.style.display = 'none';
                });
            }
        });
    </script>
@endif
