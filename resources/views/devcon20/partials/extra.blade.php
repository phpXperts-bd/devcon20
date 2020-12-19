  <!-- Speaker ifo -->
<div class="modal" id="SpeakerInfo-uniqueNumber">
    <div class="modal__overlay" data-dismiss></div>
    <div class="modal__content">
        <button class="modal__closeTop" data-dismiss>
        <svg viewBox="0 0 32 32" width="18px" height="18px">
            <path d="M29.4,4L28,2.6l-12,12L4,2.6L2.6,4l12,12l-12,12L4,29.4l12-12l12,12l1.4-1.4l-12-12L29.4,4z"/>
        </svg>
        </button>
        <main>
        <div class="speakerInfoBanner" style="background-image: url({{ asset('devcon20/images/a0-600x290@2x.jpg') }});"></div>
        <div class="speakerInfoContent">
            <h2 class="heading">Mizanur Rahman</h2>
            <p class="copy">Founder & CEO, TechMasters</p>
            <div class="divider"></div>
            <h2 class="title">About</h2>
            <p class="copy">A passionate developer, community activist, PHP & JavaScript hacker & the author of the book “PHP Application Development with NetBeans: Beginner’s Guide”. He is working at Vantage Labs, Dhaka where he is maintaining a highly available SAAS platforms like Amped that is the single most intuitive and easy to use Customer Relationship Management system on the market and Delyte that is the new generation Customer Support for any company support reps.</p>
            <h3 class="label">Topic:</h3>
            <p class="copy">Co-variance & contra-variance in PHP</p>
            <h3 class="label">Time:</h3>
            <p class="copy">9:45 am - 10:30 am</p>

        </div>
        </main>
    </div>
</div>
<!-- Registration -->
<div class="modal" id="Registration">
<div class="modal__overlay" data-dismiss></div>
<div class="modal__content">
    <button class="modal__closeTop" data-dismiss>
    <svg viewBox="0 0 32 32" width="18px" height="18px">
        <path d="M29.4,4L28,2.6l-12,12L4,2.6L2.6,4l12,12l-12,12L4,29.4l12-12l12,12l1.4-1.4l-12-12L29.4,4z"/>
    </svg>
    </button>
    <main>
    <div class="registrationBanner" style="background-image: url({{ asset('devcon20/images/registration.svg') }});"></div>
    <div class="registrationContent">
        <h2 class="heading">Registration for DevCon</h2>
        <div class="divider"></div>
        <form class="form" method="post" action="{{ route('live.registration.post') }}">
            @csrf()
            <div class="field">
                <label class="field__label" for="name">Full Name</label>
                <input class="field__input" required type="text" name="name" placeholder="Write full name here">
            </div>
            <div class="field">
                <label class="field__label" for="mobile">Email</label>
                <input class="field__input" required type="email" name="email" placeholder="Write your email address">
                <!-- <p class="field__error">Error message</p> -->
            </div>
            <div class="field">
                <label class="field__label" for="mobile">Mobile</label>
                <input class="field__input" required type="text" name="mobile" placeholder="Write your mobile number">
                <!-- <p class="field__error">Error message</p> -->
            </div>


            <div class="checkboxWrapper">
                <label class="checkbox">
                <div class="checkbox__box">
                    <input type="checkbox" name="checkbox1" value="">
                    <span class="checkbox__checkbox"></span>
                    <span class="checkbox__text">I’ve read and understand <a href="#link">DevCon’s Privacy Policy</a></span>
                </div>
                </label>
                <label class="checkbox">
                <div class="checkbox__box">
                    <input type="checkbox" name="checkbox1" value="">
                    <span class="checkbox__checkbox"></span>
                    <span class="checkbox__text">I understand by checking this box, I agree to receive communications from DevCon and their partners.</span>
                </div>
                </label>
            </div>
            <button class="registerNowButton" type="submit">Register Now!</button>
        </form>
    </div>
    </main>
</div>
</div>
