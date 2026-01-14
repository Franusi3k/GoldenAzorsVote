<script setup>
import PollsList from "@/Components/Polls/PollsList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

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

    <PollsList :polls="polls" :showOwner="false" />

  </AuthenticatedLayout>
</template>
