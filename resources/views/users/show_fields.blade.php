<div class="flex-column flex-lg-row-auto w-100 w-xl-400px mb-10">
    <div class="card mb-5 mb-xl-8">
        <div class="card-body pt-0 pt-lg-1">
            <div class="card">
                <div class="card-body d-flex flex-center flex-column pt-12 p-9 px-0">
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        <img src="{{$user->profile_image}}" alt="image"/>
                    </div>
                    <span
                            class="fs-3 text-gray-800 fw-bolder mb-3">{{$user->full_name}}</span>
                </div>
            </div>
            <div class="d-flex flex-stack fs-4 py-3">
                <div class="fw-bolder rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details"
                     role="button" aria-expanded="false"
                     aria-controls="kt_user_view_details">{{__('messages.common.details')}}
                </div>
                <a href="{{route('users.edit', $user->id)}}"
                   class="btn btn-sm btn-light-primary">{{__('messages.common.edit')}}</a>
            </div>
            <div class="separator"></div>
            <div id="kt_user_view_details" class="collapse show">
                <div class="pb-5 fs-6">
                    <div class="fw-bolder mt-5">{{__('messages.user.email')}}</div>
                    <div class="text-gray-600">{{$user->email}}</div>
                    <div class="fw-bolder mt-5">{{__('messages.user.contact_number')}}</div>
                    <div class="text-gray-600">{{$user->contact ?? 'N/A'}}</div>
                    <div class="fw-bolder mt-5">{{__('messages.user.registered_date')}}</div>
                    <div class="text-gray-600">{{\Carbon\Carbon::parse($user->created_at)->format('jS \of F Y')}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="flex-lg-row-fluid ms-xl-15">
    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">{{__('messages.vcard.vcard')}}</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
            <div class="card card-flush mb-6 mb-xl-9 w-xl-800px w-100">
                <div class="card-body p-9 pt-4">
                    <div class="tab-content">
                        <div class="fw-bold ms-5 livewire-table">
                            <livewire:user-show-v-card-table  :user-id="$user->id"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
