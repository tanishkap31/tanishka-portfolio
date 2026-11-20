@if(count($certifications))
<section id="certifications" class="section">
    <div class="wrap">
        <div class="section-head reveal">
            <h2>Certifications</h2>
            <p>Courses and achievements I have completed.</p>
        </div>

        <div class="row g-4">
            @foreach($certifications as $certification)
                <div class="col-md-6 col-lg-4 reveal">
                    <article class="cert-card">
                        <h3>{{ $certification->name }}</h3>
                        <p class="meta">{{ $certification->issuer }}@if($certification->issued_on), {{ $certification->issued_on }}@endif</p>
                        <div class="links">
                            @if($certification->file_url)
                                <a class="btn btn-outline-ink btn-sm-pill" href="{{ $certification->file_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-file-earmark-check" aria-hidden="true"></i> View certificate</a>
                            @endif
                            @if($certification->credential_url)
                                <a class="btn btn-outline-ink btn-sm-pill" href="{{ $certification->credential_url }}" target="_blank" rel="noopener noreferrer"><i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Verify</a>
                            @endif
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
