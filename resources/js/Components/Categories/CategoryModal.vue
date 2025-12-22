<script setup>
import { computed, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import BaseModal from "@/Components/BaseModal.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";
import { ref } from "vue";

const props = defineProps({
  open: { type: Boolean, default: false },
  pollId: { type: [Number, String], required: true },
  category: { type: Object, default: null },
});

const emit = defineEmits(["close"]);

const form = useForm({
  title: "",
  description: "",
});


const close = () => emit("close");

watch(
  () => props.open,
  (isOpen) => {
    if (!isOpen) return;

    form.title = props.category?.title ?? "";
    form.description = props.category?.description ?? "";
    form.clearErrors();
  }
);

const canSave = computed(() => !!props.category?.id);

const save = () => {
  if (!props.category?.id) return;

  form.put(route("#", [props.pollId, props.category.id]), {
    preserveScroll: true,
    onSuccess: () => close(),
  });
};


const confirmDeleteOpen = ref(false);

const destroy = () => {
  confirmDeleteOpen.value = true;
};

const deleteForm = useForm({});

const doDelete = () => {
  deleteForm.delete(route("#", [props.pollId, props.category.id]), {
    preserveScroll: true,
    onSuccess: () => {
      confirmDeleteOpen.value = false;
      close();
    },
  });
};
</script>

<template>
  <BaseModal :open="open" title="Edit category" description="Update the title and description." @close="close">
    <div v-if="!category" class="text-xs text-zinc-400">
      No category selected.
    </div>

    <div v-else class="grid gap-3">
      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Title</label>
        <input v-model="form.title" type="text"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none" />
        <p v-if="form.errors.title" class="mt-1 text-[11px] text-red-400">{{ form.errors.title }}</p>
      </div>

      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Description (optional)</label>
        <textarea v-model="form.description" rows="3"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none" />
        <p v-if="form.errors.description" class="mt-1 text-[11px] text-red-400">{{ form.errors.description }}</p>
      </div>
    </div>

    <template #footer>
      <div class="flex items-center justify-between gap-3">
        <button type="button"
          class="text-xs font-semibold text-red-400 hover:text-red-300 transition disabled:opacity-60" @click="destroy"
          :disabled="deleteForm.processing || !category">
          Delete category
        </button>

        <ConfirmModal :open="confirmDeleteOpen" title="Delete category?" description="This action cannot be undone."
          confirmText="Delete category" :loading="deleteForm.processing" @close="confirmDeleteOpen = false"
          @confirm="doDelete">
          <p class="text-[11px] text-zinc-400">
            This will remove the category and all its nominees.
          </p>
        </ConfirmModal>

        <div class="flex items-center gap-2">
          <button type="button"
            class="rounded-full border border-zinc-700 bg-zinc-900 px-4 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition disabled:opacity-60"
            @click="close" :disabled="form.processing || deleteForm.processing">
            Cancel
          </button>

          <button type="button"
            class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition disabled:opacity-60 disabled:cursor-not-allowed"
            @click="save" :disabled="form.processing || !canSave">
            <span v-if="!form.processing">Save</span>
            <span v-else>Saving…</span>
          </button>
        </div>
      </div>
    </template>
  </BaseModal>
</template>
