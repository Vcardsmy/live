<ul class="nav nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link {{(isset($partName) && $partName == 'overview') ? 'active' : ''}}" href="{{route('vcard.analytics',$vcard->id)}}" tabindex="-1">{{__('messages.analytics.overview')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{(isset($partName) && $partName == 'country') ? 'active' : ''}}" href="{{route('vcard.analytics',$vcard->id).'?part=country'}}" tabindex="-1">{{__('messages.analytics.countries')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{(isset($partName) && $partName == 'device') ? 'active' : ''}}" href="{{route('vcard.analytics',$vcard->id).'?part=device'}}" tabindex="-1">{{__('messages.analytics.devices')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{(isset($partName) && $partName == 'os') ? 'active' : ''}}" href="{{route('vcard.analytics',$vcard->id).'?part=os'}}" tabindex="-1">{{__('messages.analytics.os')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{(isset($partName) && $partName == 'browser') ? 'active' : ''}}" href="{{route('vcard.analytics',$vcard->id).'?part=browser'}}" tabindex="-1">{{__('messages.analytics.browsers')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{(isset($partName) && $partName == 'language') ? 'active' : ''}}" href="{{route('vcard.analytics',$vcard->id).'?part=language'}}" tabindex="-1">{{__('messages.analytics.languages')}}</a>
    </li>
</ul>
