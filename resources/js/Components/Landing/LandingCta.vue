<template>
  <section class="bg-gradient-to-b from-zinc-950/95 to-zinc-950">
    <div class="mx-auto max-w-6xl px-4 py-12 md:py-16">
      <div
        class="overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-950/70 p-6 text-center shadow-xl shadow-black/60 md:p-10">
        <p class="mb-2 text-[11px] font-semibold uppercase tracking-[0.25em] text-emerald-400">
          Ready when you are
        </p>
        <h2 class="mx-auto max-w-2xl text-balance text-xl font-semibold text-zinc-50 md:text-3xl">
          Ready to host your next awards show or community poll?
        </h2>
        <p class="mx-auto mt-3 max-w-xl text-sm text-zinc-400">
          Spin up your first event, invite your community and run a full
          multi-category show without wrestling spreadsheets or ad-hoc votes.
        </p>

        <div class="mt-6 flex flex-wrap items-center justify-center gap-3 text-sm">
          <Link href="#"
            class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-6 py-2.5 text-sm font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition">
            Get started for free
            <span aria-hidden="true">
              <ArrowBigRight class="w-3 h-3" />
            </span>
          </Link>

          <Link
            class="inline-flex items-center gap-2 rounded-full border border-zinc-700 px-4 py-2 text-xs font-medium text-zinc-200 hover:border-emerald-400 hover:text-emerald-400 transition">
            Browse example polls
          </Link>
        </div>

        <p class="mt-4 text-[11px] text-zinc-500">
          Built with Laravel 12, Vue 3, Inertia.js, Vite and TailwindCSS.
        </p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { ArrowBigRight } from "lucide-vue-next";
</script>