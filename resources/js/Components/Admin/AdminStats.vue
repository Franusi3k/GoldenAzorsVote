<script setup>
const props = defineProps({
  stats: {
    type: Object,
    required: true
  },
})

const cards = [
  { key: 'activePolls', label: 'Active polls', hint: 'Currently running' },
  { key: 'votes_today', label: 'Votes today', hint: 'Last 24 hours' },
  { key: 'newUsers', label: 'New users', hint: 'Last 7 days' },
]
</script>

<template>
  <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    <div v-for="c in cards" :key="c.key" class="rounded-3xl border border-zinc-800 bg-zinc-950/60 p-4 shadow-sm">
      <p class="text-[11px] uppercase tracking-[0.25em] text-zinc-500">
        {{ c.label }}
      </p>
      <p class="mt-2 text-2xl font-semibold text-zinc-50">
        {{ stats[c.key] }}
      </p>
      <p class="mt-1 text-xs text-zinc-400">
        {{ c.hint }}
      </p>
    </div>
  </div>
</template>
