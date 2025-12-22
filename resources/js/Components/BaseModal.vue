<script setup>
import { onBeforeUnmount, onMounted, watch, ref, nextTick } from "vue";
import { X } from "lucide-vue-next";

const props = defineProps({
  open: { type: Boolean, default: false },
  title: { type: String, default: "" },
  description: { type: String, default: "" },
  closeOnBackdrop: { type: Boolean, default: true },
  closeOnEsc: { type: Boolean, default: true },
  maxWidthClass: { type: String, default: "max-w-xl" },
});

const emit = defineEmits(["close"]);

const panelRef = ref(null);

const STACK_KEY = "__ga_modal_stack__";
const modalId = `m_${Math.random().toString(36).slice(2)}_${Date.now()}`;

const getStack = () => {
  if (!window[STACK_KEY]) window[STACK_KEY] = [];
  return window[STACK_KEY];
};

const isTopMost = () => {
  const stack = getStack();
  return stack.length && stack[stack.length - 1] === modalId;
};

const register = () => {
  const stack = getStack();
  const idx = stack.indexOf(modalId);
  if (idx !== -1) stack.splice(idx, 1);
  stack.push(modalId);
};

const unregister = () => {
  const stack = getStack();
  const idx = stack.indexOf(modalId);
  if (idx !== -1) stack.splice(idx, 1);
};

const close = () => emit("close");

const onKeydown = (e) => {
  if (!props.open) return;
  if (!props.closeOnEsc) return;
  if (!isTopMost()) return;

  if (e.key === "Escape") {
    e.preventDefault();
    close();
  }
};

const lockScroll = (locked) => {
  const body = document.body;
  if (!body) return;

  if (locked) {
    body.dataset.modalScrollLock = "1";
    body.style.overflow = "hidden";
  } else {
    const stack = getStack();
    if (stack.length === 0 && body.dataset.modalScrollLock === "1") {
      delete body.dataset.modalScrollLock;
      body.style.overflow = "";
    }
  }
};

watch(
  () => props.open,
  async (isOpen) => {
    if (isOpen) {
      register();
      lockScroll(true);

      await nextTick();
      panelRef.value?.focus?.();
    } else {
      unregister();
      lockScroll(false);
    }
  },
  { immediate: true }
);

onMounted(() => window.addEventListener("keydown", onKeydown));

onBeforeUnmount(() => {
  window.removeEventListener("keydown", onKeydown);
  unregister();
  lockScroll(false);
});
</script>


<template>
  <Teleport to="body">
    <Transition enter-active-class="transition duration-150 ease-out" enter-from-class="opacity-0"
      enter-to-class="opacity-100" leave-active-class="transition duration-150 ease-in" leave-from-class="opacity-100"
      leave-to-class="opacity-0">
      <div v-if="open" class="fixed inset-0 z-[80] overflow-y-auto" aria-modal="true" role="dialog"
        @click="closeOnBackdrop ? close() : null">
        <div class="fixed inset-0 bg-black/60" />

        <div class="relative min-h-full w-full flex items-start justify-center p-4 py-6">
          <div ref="panelRef" tabindex="-1" class="relative w-full outline-none" :class="maxWidthClass" @click.stop>
            <div
              class="rounded-3xl border border-zinc-800 bg-zinc-950/95 shadow-2xl shadow-black/40 overflow-hidden flex flex-col"
              style="max-height: calc(100vh - 3rem)">
              <div class="flex items-start justify-between gap-4 px-5 py-4 border-b border-zinc-800/70 shrink-0">
                <div class="min-w-0">
                  <p class="text-sm font-semibold text-zinc-50 truncate">
                    {{ title }}
                  </p>
                  <p v-if="description" class="mt-1 text-[11px] text-zinc-400">
                    {{ description }}
                  </p>
                </div>

                <button type="button"
                  class="rounded-full border border-zinc-800 bg-zinc-950 px-2.5 py-2 text-zinc-400 hover:text-emerald-400 hover:border-emerald-400 transition"
                  @click="close" aria-label="Close modal">
                  <X class="w-4 h-4" />
                </button>
              </div>

              <div class="px-5 py-4 overflow-y-auto">
                <slot />
              </div>

              <div v-if="$slots.footer" class="px-5 py-4 border-t border-zinc-800/70 bg-zinc-950/60 shrink-0">
                <slot name="footer" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>
