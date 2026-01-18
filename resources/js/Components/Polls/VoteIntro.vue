<script setup>
const props = defineProps({
  name: { type: String, required: true },
  description: { type: String, default: "" },
  disabled: { type: Boolean, default: false },
});

const emit = defineEmits(["start"]);
</script>

<template>
  <section class="text-center">
    <h1 class="text-4xl sm:text-5xl font-semibold tracking-tight text-zinc-100">
      {{ name }}
    </h1>

    <p v-if="description" class="mt-4 text-sm text-zinc-400 max-w-xl mx-auto">
      {{ description }}
    </p>

    <div class="mt-10">
      <button
        type="button"
        @click="emit('start')"
        :disabled="disabled"
        class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-10 py-3 text-sm font-semibold text-zinc-950 shadow-lg hover:brightness-110 disabled:opacity-60 disabled:cursor-not-allowed"
      >
        {{ disabled ? "Voting ended" : "Start voting" }}
      </button>
    </div>
  </section>
</template>
