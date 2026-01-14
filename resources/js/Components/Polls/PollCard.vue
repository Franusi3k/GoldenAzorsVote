<script setup>
import PollStatusBadge from './PollStatusBadge.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  poll: {
    type: Object,
    required: true,
  },
})

</script>

<template>
  <div
    class="group relative flex h-full flex-col rounded-3xl border border-zinc-800 bg-zinc-950/80 p-5 transition hover:-translate-y-0.5 hover:border-emerald-500 hover:shadow-xl hover:shadow-emerald-500/10">

    <PollStatusBadge :status="poll.status" class="absolute right-4 top-4" />

    <div class="flex-1">
      <h3 class="text-base font-medium text-zinc-50">
        {{ poll.name }}
      </h3>

      <p class="mt-1 line-clamp-2 text-sm text-zinc-400">
        {{ poll.description }}
      </p>

      <div class="mt-4 flex gap-4 text-xs text-zinc-500">
        <span>{{ poll.categories_count ?? 0 }} categories</span>
        <span>{{ poll.votes_count ?? 0 }} votes</span>
      </div>
    </div>

    <div class="mt-5 flex items-center justify-between">
      <div class="text-[11px] text-zinc-500">
        <div>Opens: {{ poll.opens_at ?? '—' }}</div>
        <div>Closes: {{ poll.closes_at ?? '—' }}</div>
      </div>

      <Link href="#"
        class="rounded-xl bg-emerald-500 px-3 py-1.5 text-xs font-medium text-black transition hover:bg-emerald-400">
        View Poll
      </Link>
    </div>
  </div>
</template>
