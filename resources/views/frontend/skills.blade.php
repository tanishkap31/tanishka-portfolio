@if(count($skills))
<section id="skills" class="section">
    <div class="wrap">
        <div class="section-head reveal">
            <h2>Technical Skills</h2>
            <p>The languages, frameworks and tools I work with.</p>
        </div>

        @foreach($skills as $category => $items)
            <div class="skill-group reveal">
                <h3>{{ $category }}</h3>
                <ul class="chip-list">
                    @foreach($items as $skill)
                        <li class="chip">
                            @if($skill->icon)
                                <i class="bi {{ $skill->icon }}" aria-hidden="true"></i>
                            @endif
                            {{ $skill->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>
@endif
