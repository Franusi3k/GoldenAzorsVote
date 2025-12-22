<script setup>
import BaseModal from "@/Components/BaseModal.vue";

const props = defineProps({
  open: { type: Boolean, default: false },

  title: { type: String, default: "Are you sure?" },
  description: { type: String, default: "" },

  confirmText: { type: String, default: "Confirm" },
  cancelText: { type: String, default: "Cancel" },

  danger: { type: Boolean, default: true },

  loading: { type: Boolean, default: false },
  closeOnBackdrop: { type: Boolean, default: true },
  closeOnEsc: { type: Boolean, default: true },
});

const emit = defineEmits(["close", "confirm"]);

const close = () => emit("close");
const confirm = () => emit("confirm");
</script>

<template>
  <BaseModal :open="open" :title="title" :description="description" :closeOnBackdrop="closeOnBackdrop"
    :closeOnEsc="closeOnEsc" maxWidthClass="max-w-lg" @close="close">
    <div class="text-xs text-zinc-400">
      <slot />
    </div>

    <template #footer>
      <div class="flex items-center justify-end gap-2">
        <button type="button"
          class="rounded-full border border-zinc-700 bg-zinc-900 px-4 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition disabled:opacity-60 disabled:cursor-not-allowed"
          @click="close" :disabled="loading">
          {{ cancelText }}
        </button>

        <button type="button"
          class="rounded-full px-4 py-2 text-xs font-semibold transition disabled:opacity-60 disabled:cursor-not-allowed"
          :class="danger
            ? 'border border-red-500/50 bg-red-500/10 text-red-300 hover:bg-red-500/15 hover:border-red-400'
            : 'bg-gradient-to-r from-amber-400 to-emerald-500 text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110'
            " @click="confirm" :disabled="loading">
          <span v-if="!loading">{{ confirmText }}</span>
          <span v-else>Working…</span>
        </button>
      </div>
    </template>
  </BaseModal>
</template>
