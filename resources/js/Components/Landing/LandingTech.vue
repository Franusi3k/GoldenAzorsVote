<template>
  <section id="tech" class="border-b border-zinc-800/70 bg-zinc-950/95">
    <div class="mx-auto max-w-6xl px-4 py-12 md:py-16">
      <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div class="space-y-2">
          <p class="text-xs font-semibold uppercase tracking-[0.25em] text-emerald-400">
            Technology
          </p>
          <h2 class="text-xl font-semibold text-zinc-50 md:text-2xl">
            Modern, battle-tested stack.
          </h2>
          <p class="text-sm text-zinc-400">
            GoldenAzorsVote is built with a Laravel, Vue and Inertia setup that
            feels like a single-page app without giving up backend power.
          </p>
        </div>
      </div>

      <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-4 text-xs text-zinc-300">
          <p class="mb-2 text-[11px] font-semibold text-zinc-100">
            Backend
          </p>
          <ul class="space-y-1">
            <li>Laravel 12</li>
            <li>PHP 8.3+</li>
            <li>MariaDB</li>
          </ul>
        </div>

        <div class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-4 text-xs text-zinc-300">
          <p class="mb-2 text-[11px] font-semibold text-zinc-100">
            Frontend
          </p>
          <ul class="space-y-1">
            <li>Vue 3 </li>
            <li>Inertia.js</li>
            <li>Vite</li>
            <li>TailwindCSS</li>
          </ul>
        </div>

        <div class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-4 text-xs text-zinc-300">
          <p class="mb-2 text-[11px] font-semibold text-zinc-100">
            Planned features
          </p>
          <ul class="space-y-1">
            <li>Real-time results for live events</li>
            <li>Advanced statistics and exports</li>
            <li>Team access and roles for organizers</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>
