<script setup>
import PollsList from "@/Components/Polls/PollsList.vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
  polls: {
    type: Object,
    default: () => [],
  },
});
</script>

<template>
  <AdminLayout>

    <Head title="Polls – GoldenAzorsVote" />

    <template #title>
      Polls
    </template>

    <PollsList :polls="polls" />

  </AdminLayout>
</template>
