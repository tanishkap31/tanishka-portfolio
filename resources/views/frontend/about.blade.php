@if($profile->about)
<section id="about" class="section">
    <div class="wrap">
        <div class="section-head reveal">
            <h2>About Me</h2>
            <p>A short introduction, my education and what I am looking for.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-7 reveal">
                <div class="about-text">
                    @foreach(preg_split('/\R{2,}/', trim($profile->about)) as $paragraph)
                        <p>{!! nl2br(e($paragraph)) !!}</p>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-5 reveal">
                <div class="info-card">
                    @if($profile->location)
                        <div class="row-item"><span class="k">Location</span><span class="v">{{ $profile->location }}</span></div>
                    @endif
                    @foreach($education as $item)
                        <div class="row-item">
                            <span class="k">Degree</span>
                            <span class="v">{{ $item->degree }}@if($item->university), {{ $item->university }}@endif</span>
                        </div>
                        @if($item->grade)
                            <div class="row-item"><span class="k">Result</span><span class="v">{{ $item->grade }}@if($item->duration), {{ $item->duration }}@endif</span></div>
                        @endif
                    @endforeach
                    @if($profile->email)
                        <div class="row-item"><span class="k">Email</span><span class="v">{{ $profile->email }}</span></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
