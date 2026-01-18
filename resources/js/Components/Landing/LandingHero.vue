<template>
  <section id="hero"
    class="relative overflow-hidden border-b border-zinc-800/70 bg-gradient-to-b from-zinc-950 via-zinc-950 to-zinc-950/95">
    <div class="pointer-events-none absolute -left-40 top-[-10rem] h-80 w-80 rounded-full bg-emerald-500/10 blur-3xl" />
    <div class="pointer-events-none absolute -right-40 top-40 h-80 w-80 rounded-full bg-amber-500/10 blur-3xl" />

    <div class="relative mx-auto flex max-w-6xl flex-col items-center gap-10 px-4 py-12 md:flex-row md:py-20">
      <div class="w-full md:w-1/2">
        <div
          class="mb-4 inline-flex items-center gap-2 rounded-full border border-zinc-800 bg-zinc-950/60 px-3 py-1 text-[11px] font-medium text-zinc-300 shadow-sm">
          <span
            class="inline-flex h-4 w-4 items-center justify-center rounded-full bg-emerald-500/20 text-[10px] text-emerald-400">
            ●
          </span>
          <span class="uppercase tracking-[0.2em] text-zinc-400">
            EVENT-READY VOTING
          </span>
          <span class="hidden text-zinc-500 sm:inline">
            Built for award shows, streams and teams.
          </span>
        </div>

        <h1 class="text-balance text-3xl font-semibold tracking-tight text-zinc-50 md:text-5xl">
          Host
          <span class="bg-gradient-to-r from-amber-400 via-emerald-400 to-emerald-500 bg-clip-text text-transparent">
            multi-round polls
          </span>
          for your community.
        </h1>

        <p class="mt-4 max-w-xl text-sm text-zinc-300 md:text-base">
          GoldenAzorsVote lets you create Twitch-style award shows, multi-round
          polls and live voting events with secure logins, detailed stats and a
          presentation mode ready for projectors and streams.
        </p>

        <div class="mt-6 flex flex-wrap items-center gap-3">
          <Link href="#"
            class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-5 py-2 text-sm font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition">
            Create your first poll
            <span aria-hidden="true">
              <ArrowBigRight class="w-3 h-3" />
            </span>

          </Link>

          <button type="button"
            class="inline-flex items-center gap-2 rounded-full border border-zinc-700 px-4 py-2 text-sm font-medium text-zinc-200 hover:border-emerald-400 hover:text-emerald-400 transition">
            <span class="flex h-6 w-6 items-center justify-center rounded-full border border-zinc-600 text-[11px]"
              aria-hidden="true">
              <Play class="w-3 h-3" />
            </span>
            View live demo
          </button>
        </div>

        <p class="mt-3 text-xs text-zinc-500">
          No credit card required • Free to use
        </p>

        <div class="mt-6 flex flex-wrap items-center gap-4 text-[11px] text-zinc-500">
          <div class="flex items-center gap-1">
            <span class="text-emerald-400">✓</span>
            <span>Multi-round polls</span>
          </div>
          <div class="flex items-center gap-1">
            <span class="text-emerald-400">✓</span>
            <span>YouTube clips per option</span>
          </div>
          <div class="flex items-center gap-1">
            <span class="text-emerald-400">✓</span>
            <span>Admin panel for organizers</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Play, ArrowBigRight } from "lucide-vue-next"
import { Link } from "@inertiajs/vue3"
</script>