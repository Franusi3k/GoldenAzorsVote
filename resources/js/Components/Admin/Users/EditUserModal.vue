<script setup>
import { computed, watch, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import BaseModal from "@/Components/BaseModal.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";

const props = defineProps({
  open: { type: Boolean, default: false },
  user: { type: Object, default: null },
});

const emit = defineEmits(["close"]);
const close = () => emit("close");

const form = useForm({
  name: "",
  email: "",
});

const deleteForm = useForm({});
const confirmDeleteOpen = ref(false);

const title = computed(() => "Edit user");
const description = computed(() => "Update basic user information.");

watch(
  () => props.open,
  (isOpen) => {
    if (!isOpen) {
      form.reset("name", "email");
      form.clearErrors();
      confirmDeleteOpen.value = false;
      return;
    }

    form.clearErrors();
    form.name = props.user?.name ?? "";
    form.email = props.user?.email ?? "";
  }
);

const save = () => {
  if (!props.user?.id) return;

  form.put(route("#", props.user.id), {
    preserveScroll: true,
    onSuccess: () => close(),
  });
};

const askDelete = () => {
  if (!props.user) return;
  confirmDeleteOpen.value = true;
};

const doDelete = () => {
  if (!props.user?.id) return;

  deleteForm.delete(route("#", props.user.id), {
    preserveScroll: true,
    onSuccess: () => {
      confirmDeleteOpen.value = false;
      close();
    },
  });
};
</script>

<template>
  <BaseModal :open="open" :title="title" :description="description" maxWidthClass="max-w-lg" @close="close">
    <div v-if="!user" class="text-xs text-zinc-400">
      No user selected.
    </div>

    <div v-else class="grid gap-3">
      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Name</label>
        <input v-model="form.name" type="text"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="John Doe" />
        <p v-if="form.errors.name" class="mt-1 text-[11px] text-red-400">
          {{ form.errors.name }}
        </p>
      </div>

      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Email</label>
        <input v-model="form.email" type="email"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="john@example.com" />
        <p v-if="form.errors.email" class="mt-1 text-[11px] text-red-400">
          {{ form.errors.email }}
        </p>
      </div>

      <div class="rounded-2xl border flex justify-between border-red-500/30 bg-red-500/5 p-3">
        <p class="text-[11px] text-zinc-400">
          Deleting a user is permanent.
        </p>

        <button type="button"
          class="text-xs font-semibold text-red-400 hover:text-red-300 transition disabled:opacity-60"
          @click="askDelete" :disabled="deleteForm.processing">
          Delete user
        </button>
      </div>
    </div>

    <template #footer>
      <div class="flex items-center justify-end gap-2">
        <button type="button"
          class="rounded-full border border-zinc-700 bg-zinc-900 px-4 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition disabled:opacity-60"
          @click="close" :disabled="form.processing || deleteForm.processing">
          Cancel
        </button>

        <button type="button"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition disabled:opacity-60 disabled:cursor-not-allowed"
          @click="save" :disabled="form.processing || deleteForm.processing || !user">
          <span v-if="!form.processing">Save</span>
          <span v-else>Saving…</span>
        </button>
      </div>
    </template>

    <ConfirmModal :open="confirmDeleteOpen" title="Delete user?" description="This action cannot be undone."
      confirmText="Delete user" :loading="deleteForm.processing" @close="confirmDeleteOpen = false" @confirm="doDelete">
      <p class="text-[11px] text-zinc-400">
        You’re deleting: <span class="text-zinc-200">{{ user?.name }}</span> ·
        <span class="text-zinc-200">{{ user?.email }}</span>
      </p>
    </ConfirmModal>
  </BaseModal>
</template>
