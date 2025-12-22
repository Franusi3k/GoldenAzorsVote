<template>
  <section id="demo" class="border-b border-zinc-800/70 bg-zinc-950/90">
    <div class="mx-auto max-w-6xl px-4 py-12 md:py-16">
      <div class="mb-8 grid gap-6 md:grid-cols-[1.2fr,1fr] md:items-center">
        <div class="space-y-3">
          <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-400">
            Live demo preview
          </p>
          <h2 class="text-xl font-semibold text-zinc-50 md:text-2xl">
            See your event like a real awards show.
          </h2>
          <p class="text-sm text-zinc-400">
            Use the presentation mode to display categories, nominees and
            winners with animated results. Perfect for Twitch overlays, big
            screens and projectors.
          </p>
          <ul class="space-y-2 text-xs text-zinc-300">
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Full-screen layout optimized for TVs and projectors.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Keyboard controls for easy navigation during live shows.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Winner reveal and detailed results per category.</span>
            </li>
          </ul>
          <div class="pt-2">
            <Link
              class="inline-flex items-center gap-2 rounded-full border border-zinc-700 px-4 py-2 text-xs font-medium text-zinc-200 hover:border-emerald-400 hover:text-emerald-400 transition">
              Open presentation demo
              <span aria-hidden="true">
                <Play class="w-3 h-5" />
              </span>
            </Link>
          </div>
        </div>
        <div class="rounded-3xl border border-zinc-800 bg-zinc-950/70 p-6 mx-6 shadow-xl shadow-black/60">
          <div class="flex flex-col items-center text-center">
            <div class="text-[10px] uppercase tracking-[0.3em] text-zinc-500">
              Category
            </div>
            <div class="mt-2 text-xl font-extrabold tracking-tight text-zinc-50">
              Clip of the year
            </div>
            <div class="mt-2 max-w-md text-xs text-zinc-400">
              A legendary moment that defined the entire season and stayed in everyone’s memory.
            </div>
            <div class="mt-5 w-full max-w-xl rounded-2xl border border-zinc-800 bg-zinc-900/70 p-6">
              <div class="flex items-center justify-center gap-3 text-zinc-500">
                <div class="flex min-h-10 min-w-10 items-center justify-center rounded-xl bg-zinc-800 text-lg">
                  <Spotlight class="w-5 h-5" />
                </div>
                <div class="text-left">
                  <p class="text-xs font-medium text-zinc-300">
                    Nominee highlight
                  </p>
                  <p class="text-[10px] text-zinc-500">
                    Video preview appears during live presentation
                  </p>
                </div>
              </div>
            </div>
            <div class="mt-4 text-[10px] text-zinc-500">
              Live presentation with keyboard controls or autoplay
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { Play, Check, Spotlight } from 'lucide-vue-next';
</script>