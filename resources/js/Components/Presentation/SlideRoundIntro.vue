<script setup>
defineProps({
  poll: { type: Object, required: true },
  round: { type: Object, required: true },
})
</script>

<template>
  <div class="w-full h-full flex items-center justify-center">
    <div class="text-center max-w-5xl px-6">
      <div class="text-[11px] uppercase tracking-[0.4em] text-zinc-500">
        Round
      </div>
      <h1 class="mt-3 text-4xl md:text-6xl font-extrabold tracking-tight">
        {{ round.title }}
      </h1>
      <p v-if="round.description" class="mt-4 text-base md:text-lg text-zinc-300">
        {{ round.description }}
      </p>
      <div
        class="mt-6 inline-flex items-center gap-2 rounded-full border border-zinc-800 bg-zinc-950/70 px-4 py-2 text-[11px] text-zinc-300">
        <span class="text-emerald-300 font-semibold">GoldenAzorsVote</span>
        <span class="text-zinc-500">·</span>
        <span>{{ (round.options || []).length }} options</span>
      </div>
    </div>
  </div>
</template>
