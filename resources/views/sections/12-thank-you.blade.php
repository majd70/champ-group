<section
    id="page-12"
    class="relative w-full overflow-hidden bg-[var(--color-bg-navy)]"
    aria-labelledby="thank-you-title"
>
    {{-- faint concentric radial rings, gold tinted --}}
    <div
        aria-hidden="true"
        class="pointer-events-none absolute inset-0 -z-10 opacity-[0.10]"
        style="background-image:
            radial-gradient(circle at 50% 55%, transparent 0, transparent 30%, rgba(244,184,30,0.40) 30.2%, transparent 31%),
            radial-gradient(circle at 50% 55%, transparent 0, transparent 45%, rgba(244,184,30,0.30) 45.2%, transparent 46%),
            radial-gradient(circle at 50% 55%, transparent 0, transparent 60%, rgba(244,184,30,0.20) 60.2%, transparent 61%);"
    ></div>

    <div class="mx-auto flex min-h-screen max-w-[1440px] flex-col items-center justify-center gap-12 px-6 py-20 md:px-12 md:py-24">

        {{-- THANK YOU. stacked headline --}}
        <h2 id="thank-you-title" class="flex flex-col items-center text-center leading-[0.88]">
            <span class="text-[clamp(96px,18vw,320px)] uppercase text-white" style="font-family: var(--font-display);">Thank</span>
            <span class="text-[clamp(96px,18vw,320px)] uppercase text-[var(--color-accent-gold)]" style="font-family: var(--font-display);">You.</span>
        </h2>

        {{-- closing tagline --}}
        <p class="max-w-[60ch] text-center text-[14px] leading-[1.8] text-[var(--color-text-muted)] md:text-[16px]">
            A diversified sports ecosystem advancing the sports sector in MENA since 2015 — let&rsquo;s build the next chapter together.
        </p>
    </div>
</section>
