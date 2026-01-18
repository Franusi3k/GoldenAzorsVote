<script setup>
import { computed } from "vue";
import OptionCard from "@/Components/Polls/OptionCard.vue";

const props = defineProps({
  round: { type: Object, default: null },
  selectedIds: { type: Array, default: () => [] },
  playingId: { type: [Number, String, null], default: null },
  isFirst: { type: Boolean, default: false },
  isLast: { type: Boolean, default: false },
});

const emit = defineEmits([
  "update:selectedIds",
  "update:playingId",
  "confirm",
  "skip",
  "prev",
]);

const options = computed(() =>
  (props.round?.options ?? [])
    .slice()
    .sort((a, b) => (a.position ?? 0) - (b.position ?? 0))
);

const canConfirm = computed(() => (props.selectedIds ?? []).length > 0);
const confirmLabel = computed(() =>
  props.isLast ? "Submit votes" : "Confirm selection"
);
const skipLabel = computed(() =>
  props.isLast ? "Skip round and submit votes" : "Skip this round"
);

function isSelected(id) {
  return (props.selectedIds ?? []).includes(id);
}

function toggleSelect(opt) {
  const id = opt?.id;
  if (id === undefined || id === null) return;

  if (isSelected(id)) {
    emit(
      "update:selectedIds",
      (props.selectedIds ?? []).filter((x) => x !== id)
    );
    return;
  }

  if ((props.selectedIds ?? []).length >= props.round?.max_votes) {
    if (props.round?.max_votes === 1) emit("update:selectedIds", [id]);
    return;
  }

  emit("update:selectedIds", [...(props.selectedIds ?? []), id]);
}

function togglePlay(opt) {
  if (!opt?.youtube_url) return;
  emit("update:playingId", props.playingId === opt.id ? null : opt.id);
}
</script>

<template>
  <section>
    <div class="text-center mb-8">
      <h2 class="text-2xl sm:text-3xl font-semibold text-zinc-100">
        {{ round.title }}
      </h2>

      <p v-if="round.description" class="mt-2 text-sm text-zinc-400">
        {{ round.description }}
      </p>

      <p class="mt-2 text-[11px] text-zinc-500">
        Pick up to
        <span class="text-zinc-200 font-semibold">{{ round.max_votes }}</span> option{{
          round?.max_votes > 1 ? "s" : ""
        }}
      </p>
    </div>

    <div class="flex flex-wrap justify-center gap-10">
      <OptionCard v-for="opt in options" :key="opt.id" :option="opt" :selected="isSelected(opt.id)"
        :playing="playingId === opt.id" @toggle-select="toggleSelect(opt)" @toggle-play="togglePlay(opt)" />
    </div>

    <div class="mt-10 flex flex-col items-center gap-3 sm:flex-row sm:justify-center">
      <button v-if="!isFirst" type="button" @click="emit('prev')"
        class="rounded-full border border-zinc-800 bg-zinc-950/60 px-8 py-3 text-sm font-semibold text-zinc-200 hover:bg-zinc-900/40 active:scale-[0.98] transition">
        Previous round
      </button>

      <button type="button" @click="emit('confirm')" :disabled="!canConfirm"
        class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-8 py-3 text-sm font-semibold text-zinc-950 shadow-lg hover:brightness-110 active:scale-[0.98] transition disabled:opacity-60 disabled:cursor-not-allowed">
        {{ confirmLabel }}
      </button>

      <button type="button" @click="emit('skip')"
        class="rounded-full border border-zinc-800 bg-zinc-950/60 px-8 py-3 text-sm font-semibold text-zinc-200 hover:bg-zinc-900/40 active:scale-[0.98] transition">
        {{ skipLabel }}
      </button>
    </div>

    <p v-if="isLast" class="mt-4 text-center text-[11px] text-zinc-500">
      This is the final round. Submitting will send your votes.
    </p>
  </section>
</template>
