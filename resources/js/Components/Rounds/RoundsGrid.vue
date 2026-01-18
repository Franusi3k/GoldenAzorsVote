<script setup>
defineProps({
  rounds: { type: Array, default: () => [] },
  activeId: { type: [Number, String, null], default: null },
})

const emit = defineEmits(['select'])
</script>

<template>
  <div class="rounded-3xl border  border-zinc-800 bg-zinc-950/80 p-4 md:p-5 space-y-3">

    <div>
      <h2 class="text-sm font-semibold text-zinc-50">rounds</h2>
      <p class="text-[11px] text-zinc-400">
        Click a round to edit nominees and settings.
      </p>
    </div>

    <div class="grid gap-3 sm:grid-cols-2">
      <button v-for="cat in rounds" :key="cat.id" type="button"
        class="rounded-2xl border px-3 py-3 text-left transition" :class="cat.id === activeId
            ? 'border-emerald-500/50 bg-emerald-500/5 text-emerald-100'
            : 'border-zinc-800 bg-zinc-950/80 text-zinc-200 hover:border-emerald-500/40 hover:bg-zinc-900'
          " @click.prevent="$emit('select', cat.id)">
        <p class="text-[11px] uppercase tracking-[0.16em] text-zinc-500">
          round
        </p>
        <p class="mt-1 text-sm font-semibold text-zinc-50 line-clamp-2">
          {{ cat.title || 'Untitled round' }}
        </p>
        <p class="mt-1 text-[11px] text-zinc-400 line-clamp-2">
          {{ cat.description || 'No description provided yet.' }}
        </p>
        <div class="mt-2 flex items-center justify-between text-[11px] text-zinc-500">
          <span>{{ cat.options?.length || 0 }} nominees</span>
        </div>
      </button>
    </div>
  </div>
</template>
