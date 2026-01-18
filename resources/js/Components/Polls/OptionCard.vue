<script setup>
import { computed } from "vue";
import { Play } from "lucide-vue-next";

const props = defineProps({
  option: { type: Object, required: true },
  selected: { type: Boolean, default: false },
  playing: { type: Boolean, default: false },
});

const emit = defineEmits(["toggle-select", "toggle-play"]);

function youtubeId(url) {
  if (!url) return null;
  const m = String(url).match(/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/);
  return m ? m[1] : null;
}

const ytId = computed(() => youtubeId(props.option?.youtube_url));

const youtubeThumb = computed(() => {
if (!ytId.value) return null;
  return `https://img.youtube.com/vi/${ytId.value}/hqdefault.jpg`;
});

const canPlay = computed(() => props.option?.content_type === "youtube");
</script>

<template>
  <button type="button" @click="emit('toggle-select')"
    class="group w-80 text-left rounded-3xl border bg-zinc-950/60 overflow-hidden transition shadow-xl shadow-black/30"
    :class="selected
      ? 'border-emerald-500/40 ring-1 ring-emerald-400/30'
      : 'border-zinc-800 hover:border-zinc-700'">
    <div class="relative aspect-video w-full bg-black/30 cursor-pointer" @click.stop="emit('toggle-play')">
      <template v-if="playing && props.option?.content_type === 'youtube' && ytId">
        <iframe class="w-full h-full" :src="`https://www.youtube.com/embed/${ytId}?autoplay=1`" frameborder="0"
          allow="autoplay; encrypted-media" allowfullscreen loading="lazy"></iframe>
      </template>

      <template v-else-if="props.option?.content_type === 'youtube'">
        <img :src="youtubeThumb" class="h-full w-full object-cover opacity-90 group-hover:opacity-100 transition"
          :alt="option?.label" loading="lazy" />
      </template>

      <template v-else-if="props.option?.content_type === 'image' && props.option?.image_path">
        <img :src="props.option?.image_path" class="h-full w-full object-cover opacity-90 group-hover:opacity-100 transition"
          :alt="option?.label" loading="lazy" />
      </template>

      <template v-else>
        <div class="h-full w-full grid place-items-center">
          <div class="flex flex-col items-center gap-2 text-zinc-400">
            <div class="h-12 w-12 rounded-2xl border border-zinc-800 bg-zinc-950/60 grid place-items-center">
              <span class="text-lg">🖼️</span>
            </div>
            <span class="text-[11px] text-zinc-500">No media</span>
          </div>
        </div>
      </template>

      <div v-if="!playing && canPlay" class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div
          class="flex h-14 w-14 items-center justify-center rounded-full bg-zinc-950/60 backdrop-blur border border-zinc-700 shadow-lg shadow-black/40 transition group-hover:scale-105">
          <Play class="h-6 w-6 text-zinc-100 fill-zinc-100" />
        </div>
      </div>

      <div v-if="selected"
        class="absolute top-3 left-3 rounded-full bg-emerald-500/15 border border-emerald-500/25 px-3 py-1 text-[11px] font-semibold text-emerald-200 backdrop-blur">
        Selected
      </div>
    </div>

    <div class="p-4">
      <p class="truncate text-sm font-semibold text-zinc-100">
        {{ option.label }}
      </p>
      <p v-if="option.description" class="mt-1 line-clamp-2 text-[11px] text-zinc-400">
        {{ option.description }}
      </p>
    </div>
  </button>
</template>
