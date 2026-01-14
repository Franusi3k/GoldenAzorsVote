<template>
  <section :class="gridClass">
    <div v-for="card in cards" :key="card.key" :class="['rounded-2xl border p-3 text-xs', card.bgClass]">
      <p class="text-[11px] text-zinc-500 tracking-[0.25em]">
        {{ card.label }}
      </p>

      <p :class="['mt-1 text-xl font-semibold', card.valueClass]">
        {{ card.percentage ? (stats[card.key] || 0) + '%' : stats[card.key] || "0" }}
      </p>

      <div v-if="card.percentage" class="mt-2 h-1.5 rounded-full bg-zinc-800">
        <div class="h-full rounded-full bg-gradient-to-r from-emerald-400 to-emerald-500"
          :style="{ width: stats[card.key] + '%' }" />
      </div>

      <p v-if="card.hint" class="mt-1 text-[11px] text-zinc-500">
        {{ card.hint }}
      </p>
    </div>
  </section>
</template>

<script setup>
const props = defineProps({
  stats: { type: Object, required: true },
  cardsConfig: { type: Array, required: true },
  gridClass: { type: String, default: 'grid gap-3 md:grid-cols-2 lg:grid-cols-4' }
})

const cards = props.cardsConfig
</script>
