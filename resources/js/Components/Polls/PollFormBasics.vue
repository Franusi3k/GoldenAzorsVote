<script setup>
const props = defineProps({
  form: {
    type: Object,
    required: true,
  },
  isCreate: {
    type: Boolean,
    default: false,
  },
})
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 bg-zinc-950/80 p-4 md:p-5 space-y-4">
    <div>
      <h2 class="text-sm font-semibold text-zinc-50">
        Basic information
      </h2>
      <p class="text-[11px] text-zinc-400">
        Give your poll a clear name and optional description. This is what your
        participants will see.
      </p>
    </div>

    <div class="space-y-3">
      <div class="grid md:grid-cols-2 gap-3">

        <div>
          <label for="poll-name" class="block text-xs font-medium text-zinc-300 mb-1">
            Poll name
          </label>
          <input id="poll-name" v-model="form.name" type="text"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
            placeholder="Streamer Awards 2025" />
          <p v-if="isCreate" class="mt-1 text-[11px] text-zinc-500">
            You can change this later.
          </p>
          <p v-if="form.errors.name" class="mt-1 text-[11px] text-red-400">
            {{ form.errors.name }}
          </p>
        </div>
        <div>
          <label for="poll-slug" class="block text-xs font-medium text-zinc-300 mb-1">
            Slug (optional)
          </label>
          <input id="poll-slug" v-model="form.slug" type="text"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
            placeholder="streamer-awards-2025" />
          <p class="mt-1 text-[11px] text-zinc-500">
            Used in the URL of the public voting page.
          </p>
          <p v-if="form.errors.slug" class="mt-1 text-[11px] text-red-400">
            {{ form.errors.slug }}
          </p>
        </div>
      </div>

      <div>
        <label for="poll-description" class="block text-xs font-medium text-zinc-300 mb-1">
          Description (optional)
        </label>
        <textarea id="poll-description" v-model="form.description" rows="3"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="Short description shown on the voting page..." />
        <p v-if="form.errors.description" class="mt-1 text-[11px] text-red-400">
          {{ form.errors.description }}
        </p>
      </div>
    </div>
  </div>
</template>
