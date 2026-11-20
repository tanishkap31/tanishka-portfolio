<section id="contact" class="section">
    <div class="wrap">
        <div class="row g-5">
            <div class="col-lg-5 reveal">
                <div class="section-head">
                    <h2>Contact Me</h2>
                    <p>Let's work together! Tell me about your project, your idea or the role you are hiring for, and I will reply by email.</p>
                </div>

                <div class="contact-lines">
                    @if($profile->email)
                        <div class="contact-line">
                            <span class="k">Email</span>
                            <a class="v" href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
                            <button class="copy-btn" type="button" data-copy="{{ $profile->email }}">Copy</button>
                        </div>
                    @endif
                    @if($profile->phone)
                        <div class="contact-line">
                            <span class="k">Phone</span>
                            <span class="v">{{ $profile->phone }}</span>
                            <button class="copy-btn" type="button" data-copy="{{ $profile->phone }}">Copy</button>
                        </div>
                    @endif
                    @if($profile->whatsapp)
                        <div class="contact-line">
                            <span class="k">WhatsApp</span>
                            <a class="v" href="https://wa.me/{{ $profile->whatsapp }}" target="_blank" rel="noopener noreferrer">Message me on WhatsApp</a>
                        </div>
                    @endif
                    @if($profile->linkedin)
                        <div class="contact-line">
                            <span class="k">LinkedIn</span>
                            <a class="v" href="{{ $profile->linkedin }}" target="_blank" rel="noopener noreferrer">{{ preg_replace('#^https?://(www\.)?#', '', $profile->linkedin) }}</a>
                        </div>
                    @endif
                    @if($profile->github)
                        <div class="contact-line">
                            <span class="k">GitHub</span>
                            <a class="v" href="{{ $profile->github }}" target="_blank" rel="noopener noreferrer">{{ preg_replace('#^https?://(www\.)?#', '', $profile->github) }}</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-7 reveal">
                <form class="contact-form" id="contactForm" method="POST" action="{{ route('contact.store') }}" @if($errors->any()) data-scroll-contact @endif>
                    @csrf

                    @if(session('contact_success'))
                        <p class="alert-note" role="status" data-scroll-contact>{{ session('contact_success') }}</p>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="c_name">Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="c_name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter your name" autocomplete="name" maxlength="100" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="c_email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="c_email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter your email" autocomplete="email" maxlength="150" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="form-label" for="c_subject">Subject</label>
                        <input class="form-control @error('subject') is-invalid @enderror" id="c_subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="Enter subject" maxlength="150" required>
                        @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div>
                        <label class="form-label" for="c_message">Message</label>
                        <textarea class="form-control @error('message') is-invalid @enderror" id="c_message" name="message" placeholder="Write your message..." minlength="10" maxlength="3000" required>{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Spam trap: hidden from people, bots fill it in --}}
                    <div class="hp" aria-hidden="true">
                        <label for="c_website">Leave this empty</label>
                        <input id="c_website" name="website" type="text" tabindex="-1" autocomplete="off">
                    </div>

                    <div>
                        <button class="btn btn-primary" type="submit">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
