<script setup>
defineProps({
  status: String,
})

const styleMap = {
  active: 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20',
  scheduled: 'bg-amber-500/10 text-amber-400 border-amber-500/20',
  closed: 'bg-red-500/10 text-red-400 border-red-500/20',
  draft: 'bg-zinc-700/20 text-zinc-300 border-zinc-600',
}
</script>

<template>
  <span class="inline-flex items-center rounded-full border px-2 py-0.5 text-[10px]"
    :class="styleMap[status] || 'bg-zinc-800 text-zinc-300 border-zinc-700'">
    {{ status.toUpperCase() }}
  </span>
</template>
