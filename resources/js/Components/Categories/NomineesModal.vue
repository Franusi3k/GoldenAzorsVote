<script setup>
import { computed, ref, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import Draggable from "vuedraggable";
import { GripVertical, Plus, Pencil, Trash2, Play } from "lucide-vue-next";
import BaseModal from "@/Components/BaseModal.vue";
import NomineeModal from "@/Components/Categories/NomineeModal.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";

const props = defineProps({
  open: { type: Boolean, default: false },
  pollId: { type: [Number, String], required: true },
  category: { type: Object, default: null },
});

const emit = defineEmits(["close"]);

const close = () => emit("close");

const nomineesLocal = ref([]);
watch(
  () => props.open,
  (isOpen) => {
    if (!isOpen) return;
    nomineesLocal.value = [...(props.category?.options ?? [])];
  }
);

const reorderForm = useForm({ order: [] });

const persistNomineeOrder = () => {
  if (!props.category?.id) return;
  reorderForm.order = nomineesLocal.value.map((n) => n.id);

  reorderForm.put(
    route("polls.categories.nominees.reorder", [props.pollId, props.category.id]),
    { preserveScroll: true }
  );
};

const ytId = (url) => {
  const u = (url || "").trim();
  const m1 = u.match(/[?&]v=([^&]+)/);
  if (m1?.[1]) return m1[1];

  const m2 = u.match(/youtu\.be\/([^?]+)/);
  if (m2?.[1]) return m2[1];

  const m3 = u.match(/youtube\.com\/embed\/([^?]+)/);
  if (m3?.[1]) return m3[1];

  return "";
};

const ytThumb = (url) => {
  const id = ytId(url);
  return id ? `https://img.youtube.com/vi/${id}/hqdefault.jpg` : "";
};

const selectedNominee = ref(null);
const nomineeModalOpen = ref(false);
const nomineeMode = ref("create");

const openCreate = () => {
  selectedNominee.value = null;
  nomineeMode.value = "create";
  nomineeModalOpen.value = true;
};

const openEdit = (nominee) => {
  selectedNominee.value = nominee;
  nomineeMode.value = "edit";
  nomineeModalOpen.value = true;
};

const confirmNomineeDeleteOpen = ref(false);
const nomineeToDelete = ref(null);

const deleteForm = useForm({});

const DeleteNominee = (nominee) => {
  nomineeToDelete.value = nominee;
  confirmNomineeDeleteOpen.value = true;
};

const doDeleteNominee = () => {
  if (!props.category?.id || !nomineeToDelete.value?.id) return;

  deleteForm.delete(route("#", [props.pollId, props.category.id, nomineeToDelete.value.id]), {
    preserveScroll: true,
    onSuccess: () => {
      confirmNomineeDeleteOpen.value = false;
      nomineeToDelete.value = null;
    },
  });
};

const title = computed(() => (props.category ? `Edit nominees · ${props.category.title}` : "Edit nominees"));
</script>

<template>
  <BaseModal :open="open" :title="title" description="Reorder, add, and edit nominees. Order affects presentation."
    maxWidthClass="max-w-3xl" @close="close">
    <div v-if="!category" class="text-xs text-zinc-400">
      No category selected.
    </div>

    <div v-else class="space-y-3">
      <div class="flex items-center justify-between gap-2">
        <p class="text-[11px] text-zinc-500">
          {{ nomineesLocal.length }} nominees
        </p>

        <button type="button"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition"
          @click="openCreate">
          <Plus class="w-3 h-3 inline mr-1" /> Add nominee
        </button>
      </div>

      <div v-if="!nomineesLocal.length"
        class="rounded-2xl border border-dashed border-zinc-800 bg-zinc-950/60 px-4 py-8 text-center text-xs text-zinc-400">
        No nominees yet. Add your first nominee.
      </div>

      <Draggable v-else v-model="nomineesLocal" item-key="id" handle=".drag-handle" class="space-y-2"
        @end="persistNomineeOrder">
        <template #item="{ element: n, index }">
          <div class="rounded-2xl border border-zinc-800 bg-zinc-950/70 p-3">
            <div class="flex items-start gap-3">
              <button type="button" class="drag-handle mt-1 text-zinc-500 hover:text-zinc-300 transition"
                title="Drag to reorder">
                <GripVertical class="w-4 h-4" />
              </button>

              <div
                class="w-20 h-12 rounded-xl bg-zinc-900/60 border border-zinc-800 overflow-hidden flex items-center justify-center shrink-0">
                <img v-if="ytThumb(n.youtube_url)" :src="ytThumb(n.youtube_url)" alt=""
                  class="w-full h-full object-cover" />
                <span v-else class="text-[10px] text-zinc-500">No clip</span>
              </div>

              <div class="min-w-0 flex-1">
                <div class="flex items-center justify-between gap-2">
                  <p class="text-sm font-semibold text-zinc-50 truncate">
                    {{ index + 1 }}. {{ n.label }}
                  </p>

                  <div class="flex items-center gap-2 text-[11px]">
                    <button type="button" class="text-zinc-400 hover:text-emerald-400 transition" @click="openEdit(n)">
                      <Pencil class="w-3 h-3 inline mr-1" /> Edit
                    </button>

                    <button type="button" class="text-red-400 hover:text-red-300 transition disabled:opacity-60"
                      @click="DeleteNominee(n)" :disabled="deleteForm.processing">
                      <Trash2 class="w-3 h-3 inline mr-1" /> Delete
                    </button>
                  </div>
                </div>

                <p class="mt-1 text-[11px] text-zinc-500 line-clamp-2">
                  {{ n.description || "No description" }}
                </p>

                <div v-if="n.youtube_url" class="mt-1 text-[11px] text-zinc-500 truncate">
                  <Play class="w-3 h-3 inline mr-1 text-zinc-500" />
                  {{ n.youtube_url }}
                </div>
              </div>
            </div>
          </div>
        </template>
      </Draggable>
    </div>

    <template #footer>
      <div class="flex items-center justify-end">
        <button type="button"
          class="rounded-full border border-zinc-700 bg-zinc-900 px-4 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition"
          @click="close">
          Close
        </button>
      </div>
    </template>

    <NomineeModal :open="nomineeModalOpen" :mode="nomineeMode" :poll-id="pollId" :category-id="category?.id"
      :nominee="selectedNominee" @close="nomineeModalOpen = false" />
  </BaseModal>
  <ConfirmModal :open="confirmNomineeDeleteOpen" title="Delete nominee?" description="This action cannot be undone."
    confirmText="Delete nominee" :loading="deleteForm.processing" @close="confirmNomineeDeleteOpen = false"
    @confirm="doDeleteNominee">
    <p class="text-[11px] text-zinc-400">
      You’re deleting: <span class="text-zinc-200">{{ nomineeToDelete?.label }}</span>
    </p>
  </ConfirmModal>
</template>
