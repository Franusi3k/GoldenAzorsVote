<script setup>
import { Head } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import RecentPolls from "@/Components/Polls/RecentPolls.vue";
import ActivityList from "@/Components/Common/ActivityList.vue";
import HeaderSection from "@/Components/Common/HeaderSection.vue";
import StatsGrid from "@/Components/Common/StatsGrid.vue";

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

const adminCards = [
  { key: 'activePolls', label: 'Active polls', hint: 'Currently running', bgClass: 'border-zinc-800 bg-zinc-950/60', valueClass: 'text-zinc-50' },
  { key: 'votesToday', label: 'Votes today', hint: 'Last 24 hours', bgClass: 'border-zinc-800 bg-zinc-950/60', valueClass: 'text-zinc-50' },
  { key: 'newUsers', label: 'New users', hint: 'Last 7 days', bgClass: 'border-zinc-800 bg-zinc-950/60', valueClass: 'text-zinc-50' }
]

</script>

<template>
  <AdminLayout>

    <Head title="Admin – Overview | GoldenAzorsVote" />

    <template #title> Overview </template>

    <HeaderSection subtitle="Admin panel" title="Monitor system activity and manage polls and users."
      description="Quick overview of what's happening across the platform." />

    <div class="mt-6 grid gap-4 md:grid-cols-[2fr,1.2fr]">
      <div class="space-y-4">
        <StatsGrid :stats="stats" :cards-config="adminCards" :grid-class="'grid gap-3 lg:grid-cols-3'" />
        <RecentPolls :polls="recentPolls" description="Latest activity across the platform"
          :viewAllHref="route('admin.polls.index')" />
      </div>
      <div class="space-y-4">
        <ActivityList :items="activity" description="Latest admin-relevant events" />
      </div>
    </div>
  </AdminLayout>
</template>
