<ul class="nav nav-tabs">
    <li role="presentation" class="{{ Request::segment(3) == '' ? 'active': '' }}"><a href="/consumer/{{ $consumer->id }}">Details</a></li>
    <li role="presentation" class="{{ Request::segment(3) == 'settings' ? 'active': '' }}"><a href="/consumer/{{ $consumer->id }}/settings">Settings</a></li>
    <li role="presentation" class="{{ Request::segment(3) == 'tokens' ? 'active': '' }}"><a href="/consumer/{{ $consumer->id }}/tokens">Access Tokens</a></li>
</ul>

<br>