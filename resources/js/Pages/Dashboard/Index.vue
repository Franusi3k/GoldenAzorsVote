<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import RecentPolls from '@/Components/Polls/RecentPolls.vue'
import ActivityList from '@/Components/Common/ActivityList.vue'
import HeaderSection from '@/Components/Common/HeaderSection.vue'
import StatsGrid from '@/Components/Common/StatsGrid.vue'

const userCards = [
  { key: 'totalPolls', label: 'Total polls', hint: 'since you started using GoldenAzorsVote', bgClass: 'border-zinc-800 bg-zinc-950/80', valueClass: 'text-zinc-50' },
  { key: 'activePolls', label: 'Active polls', hint: 'currently open for voting', bgClass: 'border-zinc-800 bg-zinc-950/80', valueClass: 'text-emerald-400' },
  { key: 'totalVotes', label: 'Total votes', hint: 'across all rounds', bgClass: 'border-zinc-800 bg-zinc-950/80', valueClass: 'text-zinc-50' },
  { key: 'completionRate', label: 'Completion rate', hint: 'of participants voted', bgClass: 'border-zinc-800 bg-zinc-950/80', valueClass: 'text-emerald-400', percentage: true }
]

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
  
})
</script>

<template>
  <AuthenticatedLayout>

    <Head title="Dashboard – GoldenAzorsVote" />

    <template #title>
      Welcome back
    </template>

    <HeaderSection subtitle="Dashboard" title="Your events and polls at a glance"
      description="Track live votes, prepare upcoming shows and quickly jump into the polls that matter right now.">
      <div class="flex items-center gap-2">
        <Link href="#"
          class="rounded-full border border-zinc-700 px-3 py-2 text-xs text-zinc-200 hover:border-emerald-400 hover:text-emerald-400 transition">
          View all my polls
        </Link>
        <Link href="#"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition">
          New poll
        </Link>
      </div>
    </HeaderSection>

    <div class="mt-6 grid gap-4 md:grid-cols-[2fr,1.2fr]">
      <div class="space-y-4">
        <StatsGrid :stats="stats" :cardsConfig="userCards" />
        <RecentPolls :polls="recentPolls" description="Your latest poll activity" :showOwner="false" />
      </div>
      <div class="space-y-4">
        <ActivityList :items="activity" description="Your latest poll activity" />
      </div>
    </div>
  </AuthenticatedLayout>
</template>