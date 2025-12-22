<script setup>
import { watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import BaseModal from "@/Components/BaseModal.vue";

const props = defineProps({
  open: { type: Boolean, default: false },
  pollId: { type: [Number, String], required: true },
});

const emit = defineEmits(["close"]);

const form = useForm({
  title: "",
  description: "",
});

watch(
  () => props.open,
  (v) => {
    if (v) {
      form.clearErrors();
    } else {
      form.reset("title", "description");
      form.clearErrors();
    }
  }
);

const close = () => emit("close");

const save = () => {
  form.post(route("polls.categories.store", props.pollId), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset("title", "description");
      close();
    },
  });
};
</script>

<template>
  <BaseModal :open="open" title="Add category" description="Create a new category for your poll." @close="close">
    <div class="grid gap-3">
      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Title</label>
        <input v-model="form.title" type="text"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="Upadek roku" />
        <p v-if="form.errors.title" class="mt-1 text-[11px] text-red-400">{{ form.errors.title }}</p>
      </div>

      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Description (optional)</label>
        <textarea v-model="form.description" rows="3"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="Krótki opis tej kategorii..." />
        <p v-if="form.errors.description" class="mt-1 text-[11px] text-red-400">{{ form.errors.description }}</p>
      </div>
    </div>

    <template #footer>
      <div class="flex items-center justify-end gap-2">
        <button type="button"
          class="rounded-full border border-zinc-700 bg-zinc-900 px-4 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition"
          @click="close" :disabled="form.processing">
          Cancel
        </button>

        <button type="button"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition disabled:opacity-60 disabled:cursor-not-allowed"
          @click="save" :disabled="form.processing">
          <span v-if="!form.processing">Add</span>
          <span v-else>Adding…</span>
        </button>
      </div>
    </template>
  </BaseModal>
</template>
