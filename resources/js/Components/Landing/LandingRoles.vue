<template>
  <section id="features" class="border-b border-zinc-800/70 bg-zinc-950/95">
    <div class="mx-auto max-w-6xl px-4 py-12 md:py-16">
      <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
        <div class="max-w-xl space-y-2">
          <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-400">
            Built for everyone
          </p>
          <h2 class="text-xl font-semibold text-zinc-50 md:text-2xl">
            Designed for organizers and voters.
          </h2>
          <p class="text-sm text-zinc-400">
            GoldenAzorsVote keeps organizers in control while making voting
            frictionless for participants.
          </p>
        </div>
      </div>

      <div class="grid gap-4 md:grid-cols-2">
        <div class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-5 shadow-sm">
          <p class="mb-2 text-[11px] font-semibold uppercase tracking-[0.22em] text-amber-400">
            For organizers
          </p>
          <h3 class="mb-3 text-sm font-semibold text-zinc-50">
            Control the whole event from one dashboard.
          </h3>
          <ul class="space-y-2 text-xs text-zinc-300">
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Create multi-category polls with independent categories and nominees.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Choose between open polls or invite-only closed polls.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>
                Decide if results should be visible to everyone or only backstage.
              </span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Use the admin panel to manage users, access and polls.</span>
            </li>
          </ul>
          <p class="mt-4 text-[11px] text-zinc-500">
            Perfect for events, streamers, esports teams, internal awards and
            community shows.
          </p>
        </div>

        <div class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-5 shadow-sm">
          <p class="mb-2 text-[11px] font-semibold uppercase tracking-[0.22em] text-emerald-400">
            For voters
          </p>
          <h3 class="mb-3 text-sm font-semibold text-zinc-50">
            A clean, distraction-free voting experience.
          </h3>
          <ul class="space-y-2 text-xs text-zinc-300">
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Log in once and vote securely across all your polls.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>See nominees with descriptions and embedded YouTube clips.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>Clearly see how many choices you can make in each category.</span>
            </li>
            <li class="flex items-start gap-2">
              <span class="mt-[3px] text-emerald-400">
                <Check class="w-3 h-3" />
              </span>
              <span>
                Optionally view live results if the organizer makes them public.
              </span>
            </li>
          </ul>
          <p class="mt-4 text-[11px] text-zinc-500">
            No confusing UI, just fair voting that works well on desktop and
            mobile.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Check } from 'lucide-vue-next'
</script>