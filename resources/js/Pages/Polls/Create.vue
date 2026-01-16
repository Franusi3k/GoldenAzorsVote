<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import PollFormBasics from '@/Components/Polls/PollFormBasics.vue'
import PollFormVoting from '@/Components/Polls/PollFormVoting.vue'
import { Head, useForm, Link } from '@inertiajs/vue3'
import { ArrowBigLeft } from 'lucide-vue-next'

const form = useForm({
  name: '',
  slug: '',
  description: '',
  poll_type: 'open',
  opens_at: '',
  closes_at: '',
})

const create = () => {
  form.post(route("#"), {
    preserveScroll: true,
  });
};

</script>

<template>
  <AuthenticatedLayout>

    <Head title="Create poll – GoldenAzorsVote" />

    <template #title>
      Create Poll
    </template>

    <section class="mb-6 flex items-center justify-between gap-3">
      <div>
        <Link href="#" class="text-[11px] text-zinc-400 hover:text-emerald-400 flex items-center">
          <ArrowBigLeft class="w-3 h-3 inline mr-1" /> Back to polls
        </Link>

        <h1 class="mt-1 text-lg font-semibold text-zinc-50">Create a new poll</h1>
        <p class="text-xs text-zinc-400">
          Define the core details of your poll. You can add rounds and media later.
        </p>
      </div>

      <div class="hidden sm:flex flex-col items-end gap-1 text-[11px] text-zinc-400">
        <span class="uppercase tracking-[0.2em] text-zinc-500">Step 1 of 2</span>
        <div class="flex items-center gap-1">
          <span class="h-1.5 w-6 rounded-full bg-emerald-500" />
          <span class="h-1.5 w-6 rounded-full bg-zinc-500" />
        </div>
      </div>
    </section>

    <form class="space-y-6" @submit.prevent="create">
      <section class="space-y-4">
        <PollFormBasics :form="form" />
        <PollFormVoting :form="form" />
        <div class="mt-2 flex items-center justify-end gap-2">
          <button type="submit" :disabled="form.processing"
            class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition disabled:opacity-60 disabled:cursor-not-allowed">
            <span v-if="!form.processing">Create & continue to rounds</span>
            <span v-else>Creating…</span>
          </button>
        </div>
      </section>
    </form>
  </AuthenticatedLayout>
</template>
