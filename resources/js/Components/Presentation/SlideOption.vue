<script setup>
import { toEmbedUrl } from '@/Composables/useYouTubeEmbed'

defineProps({
  round: { type: Object, required: true },
  option: { type: Object, required: true },
})
</script>

<template>
  <div class="w-full h-full flex flex-col items-center justify-center">
    <div class="w-full max-w-6xl flex flex-col items-center">

      <div class="text-center">
        <div class="text-[11px] uppercase tracking-[0.3em] text-zinc-500">
          {{ round.title }}
        </div>

        <div class="mt-2 text-3xl md:text-5xl font-extrabold tracking-tight">
          {{ option.label }}
        </div>

        <div v-if="option.description" class="mt-3 text-sm md:text-base text-zinc-300 max-w-3xl mx-auto">
          {{ option.description }}
        </div>
      </div>

      <div class="mt-6 w-full flex items-center justify-center">
        <div v-if="option.youtube_url"
          class="relative w-full max-w-5xl aspect-video rounded-3xl overflow-hidden border border-zinc-800 bg-black shadow-2xl">
          <iframe :src="toEmbedUrl(option.youtube_url)" class="absolute inset-0 w-full h-full" frameborder="0"
            allow="autoplay; encrypted-media" allowfullscreen />
        </div>

        <div v-else
          class="flex h-[320px] w-full max-w-5xl items-center justify-center rounded-3xl border border-zinc-800 bg-zinc-900 text-zinc-400">
          No video available
        </div>
      </div>

    </div>
  </div>
</template>
