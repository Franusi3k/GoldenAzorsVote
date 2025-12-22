<script setup>
import { computed, watch } from "vue";
import { useForm } from "@inertiajs/vue3";
import BaseModal from "@/Components/BaseModal.vue";
import { ref } from "vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";

const props = defineProps({
  open: { type: Boolean, default: false },
  mode: { type: String, default: "create" },
  pollId: { type: [Number, String], required: true },
  categoryId: { type: [Number, String], required: true },
  nominee: { type: Object, default: null },
});

const emit = defineEmits(["close"]);
const close = () => emit("close");

const form = useForm({
  label: "",
  description: "",
  youtube_url: "",
});

watch(
  () => props.open,
  (isOpen) => {
    if (!isOpen) return;

    form.clearErrors();
    form.label = props.nominee?.label ?? "";
    form.description = props.nominee?.description ?? "";
    form.youtube_url = props.nominee?.youtube_url ?? "";
  }
);

const title = computed(() => (props.mode === "edit" ? "Edit nominee" : "Add nominee"));
const description = computed(() =>
  props.mode === "edit" ? "Update nominee details and clip URL." : "Create a new nominee for this category."
);

const ytId = computed(() => {
  const u = (form.youtube_url || "").trim();

  const m1 = u.match(/[?&]v=([^&]+)/);
  if (m1?.[1]) return m1[1];

  const m2 = u.match(/youtu\.be\/([^?]+)/);
  if (m2?.[1]) return m2[1];

  const m3 = u.match(/youtube\.com\/embed\/([^?]+)/);
  if (m3?.[1]) return m3[1];

  return "";
});

const embedUrl = computed(() => (ytId.value ? `https://www.youtube.com/embed/${ytId.value}` : ""));

const save = () => {
  if (props.mode === "create") {
    form.post(route("#", [props.pollId, props.categoryId]), {
      preserveScroll: true,
      onSuccess: () => close(),
    });
    return;
  }

  if (!props.nominee?.id) return;

  form.put(
    route("#", [props.pollId, props.categoryId, props.nominee.id]),
    {
      preserveScroll: true,
      onSuccess: () => close(),
    }
  );
};

const confirmNomineeDeleteOpen = ref(false);

const deleteForm = useForm({});

const DeleteNominee = () => {
  confirmNomineeDeleteOpen.value = true;
};

const doDeleteNominee = () => {
  if (!props.categoryId || !props.nominee?.id) return;

  deleteForm.delete(route("#", [props.pollId, props.categoryId, props.nominee.id]), {
    preserveScroll: true,
    onSuccess: () => {
      confirmNomineeDeleteOpen.value = false;
      close();
    }
  });
};

</script>

<template>
  <BaseModal :open="open" :title="title" :description="description" maxWidthClass="max-w-2xl" @close="close">
    <div class="grid gap-3">
      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Name</label>
        <input v-model="form.label" type="text"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="Max" />
        <p v-if="form.errors.label" class="mt-1 text-[11px] text-red-400">{{ form.errors.label }}</p>
      </div>

      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">YouTube URL</label>
        <input v-model="form.youtube_url" type="url"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="https://www.youtube.com/watch?v=..." />
        <p v-if="form.errors.youtube_url" class="mt-1 text-[11px] text-red-400">{{ form.errors.youtube_url }}</p>
      </div>

      <div>
        <label class="block text-xs font-medium text-zinc-300 mb-1">Description (optional)</label>
        <textarea v-model="form.description" rows="3"
          class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
          placeholder="Krótki opis klipu / momentu..." />
      </div>

      <div class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-3">
        <p class="text-[11px] text-zinc-400 mb-2">Preview</p>

        <div v-if="embedUrl" class="aspect-video rounded-xl overflow-hidden border border-zinc-800 bg-black">
          <iframe :src="embedUrl" class="w-full h-full" title="YouTube preview" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen />
        </div>

        <p v-else class="text-xs text-zinc-500">
          Paste a YouTube link to preview the clip.
        </p>
      </div>
    </div>

    <template #footer>
      <div class="flex items-center justify-between gap-3">
        <button v-if="mode === 'edit'" type="button"
          class="text-xs font-semibold text-red-400 hover:text-red-300 transition disabled:opacity-60"
          @click="DeleteNominee" :disabled="deleteForm.processing || !nominee">
          Delete nominee
        </button>
        <div v-else />
        <ConfirmModal :open="confirmNomineeDeleteOpen" title="Delete nominee?"
          description="This action cannot be undone." confirmText="Delete nominee" :loading="deleteForm.processing"
          @close="confirmNomineeDeleteOpen = false" @confirm="doDeleteNominee">
          <p class="text-[11px] text-zinc-400">
            You’re deleting: <span class="text-zinc-200">{{ nominee?.label }}</span>
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
            @click="save" :disabled="form.processing">
            <span v-if="!form.processing">{{ mode === "edit" ? "Save" : "Add" }}</span>
            <span v-else>{{ mode === "edit" ? "Saving…" : "Adding…" }}</span>
          </button>
        </div>
      </div>
    </template>
  </BaseModal>
</template>
