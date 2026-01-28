<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ConfirmModal from "@/Components/ConfirmModal.vue";
import PollFormBasics from "@/Components/Polls/PollFormBasics.vue";
import PollFormVoting from "@/Components/Polls/PollFormVoting.vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import { ArrowBigLeft } from "lucide-vue-next";
import { ref } from "vue";

const props = defineProps({
  poll: {
    type: Object,
    required: true,
  },
});

const page = usePage()
const user = page.props.auth.user
const isAdmin = user.roles.some(role => role.name === 'admin')

const form = useForm({
  name: props.poll.name ?? "",
  slug: props.poll.slug ?? "",
  description: props.poll.description ?? "",
  poll_type: props.poll.poll_type ?? "open",
  opens_at: props.poll.opens_at ?? "",
  closes_at: props.poll.closes_at ?? "",
});

const save = () => {
  form.put(route("#", props.poll.id), {
    preserveScroll: true,
  });
};

const confirmDeleteOpen = ref(false);

const destroyForm = useForm({});

const destroy = () => {
  confirmDeleteOpen.value = true;
};

const doDestroy = () => {
  destroyForm.delete(route("#", props.poll.id), {
    preserveScroll: true,
    onSuccess: () => {
      confirmDeleteOpen.value = false;
    }
  });
};
</script>

<template>
  <component :is="isAdmin ? AdminLayout : AuthenticatedLayout">

    <Head :title="`Edit – ${poll.name} | GoldenAzorsVote`" />

    <template #title>
      Edit Poll
    </template>

    <section class="mb-6 flex items-start justify-between gap-3">
      <div>
        <Link :href="isAdmin ? route('admin.polls.index') : '#'"
          class="text-[11px] text-zinc-400 hover:text-emerald-400 flex items-center">
          <ArrowBigLeft class="w-3 h-3 inline mr-1" /> Back to polls
        </Link>

        <h1 class="mt-1 text-lg font-semibold text-zinc-50">Edit poll</h1>
        <p class="text-xs text-zinc-400">
          Update details, access rules and schedule. Changes affect the public voting
          page.
        </p>
      </div>

      <div class="flex flex-wrap items-center justify-end gap-2 text-[11px]">
        <Link href="#" class="text-zinc-400 hover:text-emerald-400"> Open poll </Link>

        <Link href="#"
          class="rounded-full border border-zinc-700 bg-zinc-900 px-3 py-1 font-medium text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition">
          Manage rounds
        </Link>
      </div>
    </section>

    <form class="space-y-4" @submit.prevent="save">
      <PollFormBasics :form="form" />
      <PollFormVoting :form="form" />

      <div class="flex items-center justify-end gap-2 pt-2">
        <Link :href="isAdmin ? route('admin.polls.index') : '#'" class="text-xs text-zinc-400 hover:text-zinc-200">
          Cancel
        </Link>

        <button type="submit" :disabled="form.processing"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition disabled:opacity-60 disabled:cursor-not-allowed">
          <span v-if="!form.processing">Save changes</span>
          <span v-else>Saving…</span>
        </button>
      </div>
    </form>

    <section class="mt-8 rounded-3xl border border-red-500/20 bg-red-500/5 p-4 md:p-5">
      <div class="flex items-start justify-between gap-3">
        <div>
          <h2 class="text-sm font-semibold text-zinc-50">Danger zone</h2>
          <p class="mt-1 text-[11px] text-zinc-400">
            Deleting a poll removes all rounds, options and votes. This cannot be
            undone.
          </p>
        </div>

        <button type="button" class="text-xs font-semibold text-red-400 hover:text-red-300" @click="destroy">
          Delete poll
        </button>

        <ConfirmModal :open="confirmDeleteOpen" title="Delete poll?" description="This action cannot be undone."
          confirmText="Delete poll" cancelText="Cancel" :loading="destroyForm.processing" :danger="true"
          @close="confirmDeleteOpen = false" @confirm="doDestroy">
          <p class="text-[11px] text-zinc-400">
            This will permanently delete the poll, its rounds and options.
          </p>
        </ConfirmModal>
      </div>
    </section>
  </component>
</template>
