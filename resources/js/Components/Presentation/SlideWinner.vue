<script setup>
import { toEmbedUrl } from '@/Composables/useYouTubeEmbed'

defineProps({
  round: { type: Object, required: true },
  option: { type: Object, default: null },
})
</script>

<template>
  <div class="w-full h-full flex flex-col items-center justify-center">
    <div class="w-full max-w-6xl flex flex-col items-center">

      <div class="text-center">
        <div class="text-[11px] uppercase tracking-[0.3em] text-zinc-500">
          {{ round.title }}
        </div>

        <div class="mt-3 text-4xl md:text-6xl font-extrabold tracking-tight">
          WINNER
        </div>

        <div class="mt-2 text-3xl md:text-5xl font-extrabold text-emerald-300">
          {{ option?.label || '—' }}
        </div>
      </div>

      <div class="mt-6 w-full flex items-center justify-center">
        <div v-if="option?.youtube_url"
          class="relative w-full max-w-5xl aspect-video rounded-3xl overflow-hidden border border-emerald-500/30 bg-black shadow-2xl">
          <iframe :src="toEmbedUrl(option.youtube_url)" class="absolute inset-0 w-full h-full" frameborder="0"
            allow="autoplay; encrypted-media" allowfullscreen />
        </div>
      </div>

    </div>
  </div>
</template>
