<script setup>
defineProps({
  category: { type: Object, required: true },
  form: { type: Object, required: true },
  saving: { type: Boolean, default: false },
})

const emit = defineEmits(['save', 'delete'])
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 bg-zinc-950/80 p-4 md:p-5 space-y-4">
    <div class="flex items-start justify-between gap-3">
      <div>
        <h2 class="text-sm font-semibold text-zinc-50">Edit category</h2>
        <p class="text-[11px] text-zinc-400">
          Update name, description and voting rules for this category.
        </p>
      </div>

      <button type="button"
        class="rounded-full border border-red-500/30 bg-red-500/10 px-3 py-1 text-[11px] font-medium text-red-300 hover:bg-red-500/15 hover:text-red-200 transition"
        @click="$emit('delete')">
        Delete
      </button>
    </div>

    <div class="space-y-3">
      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Title</label>
        <input v-model="form.title" type="text"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="Upadek roku" />
        <p v-if="form.errors.title" class="mt-1 text-[11px] text-red-400">
          {{ form.errors.title }}
        </p>
      </div>

      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Description (optional)</label>
        <textarea v-model="form.description" rows="2"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="Krótki opis tej kategorii..." />
      </div>

      <div class="grid gap-3 sm:grid-cols-2">
        <div>
          <label class="block text-xs font-medium text-zinc-300 mb-1">Max selections</label>
          <input v-model.number="form.max_selections" type="number" min="1"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none" />
        </div>

        <div class="space-y-2 pt-1">
          <label class="flex items-start gap-2 text-[11px] text-zinc-300">
            <input v-model="form.allow_skip" type="checkbox"
              class="mt-[3px] h-3 w-3 rounded border-zinc-600 bg-zinc-900 text-emerald-500 focus:ring-emerald-500" />
            <span>Allow skip</span>
          </label>

          <label class="flex items-start gap-2 text-[11px] text-zinc-300">
            <input v-model="form.show_results_after" type="checkbox"
              class="mt-[3px] h-3 w-3 rounded border-zinc-600 bg-zinc-900 text-emerald-500 focus:ring-emerald-500" />
            <span>Show results after vote</span>
          </label>
        </div>
      </div>

      <div class="flex justify-end gap-2 pt-2">
        <button type="button" :disabled="saving"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition disabled:opacity-60 disabled:cursor-not-allowed"
          @click="$emit('save')">
          <span v-if="!saving">Save category</span>
          <span v-else>Saving…</span>
        </button>
      </div>
    </div>
  </div>
</template>
