<script setup>
defineProps({
  nominees: { type: Array, default: () => [] },
})

const emit = defineEmits(['play'])
</script>

<template>
  <div>
    <div v-if="nominees.length" class="grid gap-3 sm:grid-cols-2">
      <div v-for="n in nominees" :key="n.id"
        class="rounded-2xl border border-zinc-800 bg-zinc-950 px-3 py-3 text-xs text-zinc-200">
        <div class="flex items-start justify-between gap-2">
          <div class="min-w-0">
            <p class="text-sm font-semibold text-zinc-50 truncate">
              {{ n.label }}
            </p>
            <p class="mt-1 text-[11px] text-zinc-400 line-clamp-2">
              {{ n.description || 'No description provided.' }}
            </p>
          </div>

          <button v-if="n.youtube_url" type="button"
            class="rounded-full border border-zinc-700 bg-zinc-900 px-2 py-1 text-[10px] text-zinc-200 hover:border-emerald-400 hover:text-emerald-400 transition"
            @click="$emit('play', n)">
            Play
          </button>
        </div>

        <div class="mt-2 text-[11px] text-zinc-500 truncate">
          {{ n.youtube_url || 'No YouTube link' }}
        </div>
      </div>
    </div>

    <div v-else
      class="rounded-2xl border border-dashed border-zinc-800 bg-zinc-950/60 px-4 py-6 text-center text-[11px] text-zinc-500">
      No nominees yet. Add the first one below.
    </div>
  </div>
</template>
