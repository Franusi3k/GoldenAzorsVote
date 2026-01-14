<script setup>
import HeaderSection from "@/Components/Common/HeaderSection.vue";
import PollsList from "@/Components/Polls/PollsList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
  polls: {
    type: Object,
    default: () => [],
  },
});
</script>

<template>
  <AuthenticatedLayout>

    <Head title="My Polls – GoldenAzorsVote" />

    <template #title>
      My Polls
    </template>

    <HeaderSection class="mb-4" subtitle="Polls" title="Manage your polls"
      description="Manage all your polls. Create, edit, configure rounds, and track results">
      <Link href="#"
        class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition">
        Create poll
      </Link>
    </HeaderSection>

    <PollsList :polls="polls" :showOwner="false" />

  </AuthenticatedLayout>
</template>
