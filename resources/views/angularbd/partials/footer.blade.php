<footer class="Meetup__share">
    <h5 class="Meetup__sectionTitle">Show some love</h5>
    <a class="Meetup__shareLink"
       href="https://www.facebook.com/sharer/sharer.php?u=https://phpxperts.net" target="_blank"><img
            src="{{ asset('phpxperts/icons/share-facebook.svg') }}" alt=""></a>
    <a class="Meetup__shareLink"
       href="http://www.linkedin.com/shareArticle?mini=true&title=phpXperts%DevCon%20%2720%20&url=https://phpxperts.net"
       target="_blank"><img src="{{ asset('phpxperts/icons/share-linkedin.svg') }}" alt=""></a>

    <div class="Foo">
        <a class="Meetup__shareLink" href="{{ env('GROUP_FACEBOOK_LINK') }}" target="_blank"><img
                src="{{ asset('phpxperts/icons/link-group.svg') }}" alt=""></a>
        <a class="Meetup__shareLink" href="{{ env('EVENT_FACEBOOK_LINK') }}" target="_blank"><img
                src="{{ asset('phpxperts/icons/link-event.svg') }}" alt=""></a>
    </div>
    <div class="Credit">Designed by <a href="https://www.facebook.com/zafree" target="_blank">Zafree</a></div>
</footer>
