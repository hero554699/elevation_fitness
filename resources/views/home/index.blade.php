@extends('layouts.app')
@section('title', 'Elevation Fitness Gym — Davao City')

@section('content')

{{-- ════════════════════════════════════════════════ HERO ══ --}}
<section class="relative overflow-hidden" style="min-height:90vh; background:#0a0a0a;">
    <div class="absolute inset-0 stripe-bg"></div>
    <div class="absolute left-0 top-0 bottom-0 w-1" style="background:var(--red);"></div>
    <div class="absolute bottom-0 left-0 right-0 overflow-hidden pointer-events-none select-none" style="opacity:.04;line-height:1;">
        <span class="display text-white" style="font-size:22vw;white-space:nowrap;">ELEVATE</span>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 flex flex-col justify-center" style="min-height:90vh;">
        <div class="max-w-3xl">
            <div class="flex items-center gap-3 mb-6">
                <div style="height:2px;width:40px;background:var(--red);"></div>
                <span class="condensed text-xs tracking-widest uppercase" style="color:var(--red);">Davao City, Philippines · Est. 2017</span>
            </div>
            <h1 class="display text-white" style="font-size:clamp(3.5rem,10vw,8rem);line-height:.92;">
                NOWHERE<br>TO GO<br><span style="color:var(--red);">BUT UP.</span>
            </h1>
            <p class="text-gray-400 text-lg mt-7 mb-10 max-w-xl leading-relaxed" style="font-weight:300;">
                Premium gym facilities at affordable prices — open-air cardio &amp; strength equipment,
                indoor cycling, Zumba, and personal training across 6 branches in the Davao Region.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('login') }}" class="btn-red   px-10 py-4 text-base">Get Started</a>
                <a href="#plans" class="btn-ghost px-10 py-4 text-base">View Plans</a>
            </div>
            <div class="flex flex-wrap gap-12 mt-16 pt-10" style="border-top:1px solid #222;">
                <div>
                    <div class="display text-4xl" style="color:var(--red);">3,000+</div>
                    <div class="condensed text-gray-500 text-xs uppercase tracking-widest mt-1">Registered Members</div>
                </div>
                <div>
                    <div class="display text-white text-4xl">6</div>
                    <div class="condensed text-gray-500 text-xs uppercase tracking-widest mt-1">Branches</div>
                </div>
                <div>
                    <div class="display text-white text-4xl">2017</div>
                    <div class="condensed text-gray-500 text-xs uppercase tracking-widest mt-1">Year Founded</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════ PLANS ══ --}}
<section id="plans" class="py-24" style="background:#111;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <div class="flex items-center gap-3 mb-3">
                <div style="height:2px;width:40px;background:var(--red);"></div>
                <span class="condensed text-xs tracking-widest uppercase" style="color:var(--red);">Membership Plans</span>
            </div>
            <h2 class="display text-white" style="font-size:3.2rem;">CHOOSE YOUR COMMITMENT</h2>
        </div>
        @php
        $plans = [
        ['name'=>'1-Day Pass','price'=>'₱150', 'sub'=>'per day', 'tag'=>'', 'features'=>['Open-air Gym Access','Cardio & Strength Equipment']],
        ['name'=>'1-Month', 'price'=>'₱1,000','sub'=>'per month','tag'=>'', 'features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
        ['name'=>'3-Month', 'price'=>'₱2,700','sub'=>'₱900/mo', 'tag'=>'POPULAR', 'features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
        ['name'=>'6-Month', 'price'=>'₱4,500','sub'=>'₱750/mo', 'tag'=>'SAVE 25%', 'features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
        ['name'=>'1-Year', 'price'=>'₱6,500','sub'=>'₱542/mo', 'tag'=>'BEST VALUE','features'=>['Open-air Gym','Cardio & Strength','Indoor Cycling','Zumba','Free Parking']],
        ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach($plans as $plan)
            @php $featured = in_array($plan['tag'], ['POPULAR','BEST VALUE']); @endphp
            <div class="card p-6 relative {{ $featured ? 'red-glow':'' }}"
                style="{{ $featured ? 'border-color:var(--red);':'' }}">
                @if($plan['tag'])
                <div class="absolute -top-3 left-4">
                    <span class="condensed text-xs font-bold tracking-widest px-3 py-1"
                        style="background:var(--red);color:#fff;">{{ $plan['tag'] }}</span>
                </div>
                @endif
                <div class="condensed text-gray-500 text-xs uppercase tracking-widest mb-1">{{ $plan['name'] }}</div>
                <div class="display text-white mb-1" style="font-size:2.4rem;">{{ $plan['price'] }}</div>
                <div class="condensed text-gray-600 text-xs mb-5">{{ $plan['sub'] }}</div>
                <ul class="space-y-2 mb-6">
                    @foreach($plan['features'] as $f)
                    <li class="text-gray-400 text-xs flex items-center gap-2">
                        <span style="color:var(--red);">■</span> {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('login') }}" class="btn-red block text-center py-2 text-sm w-full">Choose Plan</a>
            </div>
            @endforeach
        </div>
        <p class="text-gray-600 text-xs mt-5 text-center">Personal Training: ₱1,500–₱2,000 for 12 sessions · One-on-one instructor</p>
    </div>
</section>

{{-- ════════════════════════════════════════════ SERVICES ══ --}}
<section class="py-24" style="background:#0a0a0a;">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <div class="flex items-center gap-3 mb-3">
                <div style="height:2px;width:40px;background:var(--red);"></div>
                <span class="condensed text-xs tracking-widest uppercase" style="color:var(--red);">What We Offer</span>
            </div>
            <h2 class="display text-white" style="font-size:3.2rem;">BUILT TO PERFORM</h2>
        </div>
        @php
        $services = [
        ['icon'=>'⚡','title'=>'Open-Air Gym', 'desc'=>'Modern cardio and strength training machines in spacious open-air facilities.'],
        ['icon'=>'🚴','title'=>'Indoor Cycling', 'desc'=>'High-energy cycling sessions with certified instructors for all levels.'],
        ['icon'=>'💃','title'=>'Zumba Classes', 'desc'=>'Fun dance-based fitness sessions that make working out feel like a party.'],
        ['icon'=>'🏋️','title'=>'Personal Training','desc'=>'One-on-one instructor sessions tailored to your specific fitness goals.'],
        ['icon'=>'🅿️','title'=>'Free Parking', 'desc'=>'Ample free parking available at all branches — no hassle, just gains.'],
        ['icon'=>'🌆','title'=>'6 Branches', 'desc'=>'Conveniently located across Davao City, Panabo, and Tagum for easy access.'],
        ];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            @foreach($services as $s)
            <div class="card p-7" style="transition:border-color .2s;"
                onmouseover="this.style.borderColor='#3a0a0a'"
                onmouseout="this.style.borderColor='#2a2a2a'">
                <div class="text-3xl mb-4">{{ $s['icon'] }}</div>
                <h3 class="display text-white text-2xl mb-2">{{ $s['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $s['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════ CTA ══ --}}
<section class="py-20" style="background:var(--red);">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="display text-white mb-4" style="font-size:3.8rem;">START YOUR JOURNEY TODAY</h2>
        <p class="mb-8 text-lg" style="color:rgba(255,255,255,.8);font-weight:300;">
            Join over 3,000 members across 6 branches in the Davao Region.
        </p>
        <a href="{{ route('login') }}"
            class="inline-block px-12 py-4 condensed font-bold text-base tracking-widest uppercase"
            style="background:#fff;color:var(--red);border:2px solid #fff;transition:background .2s,color .2s;"
            onmouseover="this.style.background='transparent';this.style.color='#fff';"
            onmouseout="this.style.background='#fff';this.style.color='var(--red)';">
            Log In to Get Started →
        </a>
    </div>
</section>

@endsection