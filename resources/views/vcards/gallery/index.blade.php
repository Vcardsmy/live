<div class="card-body livewire-table">
    <livewire:vcard-gallery-table  :vcard-id="$vcard->id"/>
    @include('vcards.gallery.templates.templates')
    @include('vcards.gallery.create')
    @include('vcards.gallery.edit')
</div>
