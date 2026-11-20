@if(count($experiences) || count($education))
<section id="experience" class="section">
    <div class="wrap">
        <div class="section-head reveal">
            <h2>Experience &amp; Education</h2>
            <p>Internships, degree, college and academic achievements.</p>
        </div>

        <div class="row g-5">
            @if(count($experiences))
                <div class="col-lg-6 reveal">
                    <h3 class="col-title">Experience</h3>
                    <ul class="timeline">
                        @foreach($experiences as $experience)
                            <li>
                                <h4>{{ $experience->role }}</h4>
                                <p class="sub">{{ $experience->company }}@if($experience->location), {{ $experience->location }}@endif</p>
                                <p class="when">{{ $experience->duration }}</p>
                                @if(count($experience->bullet_list))
                                    <ul>
                                        @foreach($experience->bullet_list as $point)
                                            <li>{{ $point }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(count($education))
                <div class="col-lg-6 reveal">
                    <h3 class="col-title">Education</h3>
                    <ul class="timeline">
                        @foreach($education as $item)
                            <li>
                                <h4>{{ $item->degree }}</h4>
                                <p class="sub">{{ $item->college }}</p>
                                @if($item->university)
                                    <p>{{ $item->university }}</p>
                                @endif
                                <p class="when">{{ $item->duration }}@if($item->duration && $item->grade) | @endif{{ $item->grade }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</section>
@endif
