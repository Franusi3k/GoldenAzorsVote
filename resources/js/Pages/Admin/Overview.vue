<script setup>
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import AdminHeader from "@/Components/Admin/AdminHeader.vue";
import AdminStats from "@/Components/Admin/AdminStats.vue";
import AdminRecentPolls from "@/Components/Admin/AdminRecentPolls.vue";
import AdminActivity from "@/Components/Admin/AdminActivity.vue";

defineProps({
  recentPolls: {
    type: Array,
    default: () => [],
  },
  activity: {
    type: Array,
    default: () => [],
  },
  stats: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<template>
  <AdminLayout>

    <Head title="Admin – Overview | GoldenAzorsVote" />

    <template #title> Overview </template>

    <AdminHeader />

    <div class="mt-6 grid gap-4 md:grid-cols-[2fr,1.2fr]">
      <div class="space-y-4">
        <AdminStats :stats="stats" />
        <AdminRecentPolls :polls="recentPolls" />
      </div>
      <div class="space-y-4">
        <AdminActivity :items="activity" />
      </div>
    </div>
  </AdminLayout>
</template>
