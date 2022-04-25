@if ($showSearch)
    <div class="mb-3 mb-md-0 input-group">
        <svg xmlns="http://www.w3.org/2000/svg" width="22.75px" height="22.75px" viewBox="0 0 24 24" version="1.1"
             class="search-box-icon">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="22.75" height="22.75"></rect>
                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                      fill="#a1a5b7" fill-rule="nonzero" opacity="0.3"></path>
                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                      fill="#a1a5b7" fill-rule="nonzero"></path>
            </g>
        </svg>
        <input
                wire:model{{ $this->searchFilterOptions }}="filters.search"
                placeholder="@lang('Search')"
                type="text"
                class="form-control search-box"
        >

        @if (isset($filters['search']) && strlen($filters['search']))
            <button wire:click="$set('filters.search', null)" class="btn btn-outline-secondary" type="button">
                <svg style="width:.75em;height:.75em" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        @endif
    </div>
@endif
