<script setup>
import PollCard from '@/Components/Polls/PollCard.vue'
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import HeaderSection from '@/Components/Common/HeaderSection.vue'
import { Search } from 'lucide-vue-next'

const props = defineProps({
  polls: {
    type: Object,
    default: () => [],
  },
})

</script>

<template>

  <AuthenticatedLayout>

    <Head title="Explore polls – GoldenAzorsVote" />

    <template v-slot:title>
      Explore polls
    </template>

    <HeaderSection subtitle="Polls" title="Explore polls"
      description="Discover public voting events created by the community.">
      <div
        class="flex w-1/3 items-center gap-1 rounded-full border border-zinc-800 bg-zinc-950 px-3 py-1.5 text-xs text-zinc-400">
        <span class="text-zinc-500">
          <Search class="w-3 h-3" />
        </span>
        <input type="text" placeholder="Search polls..."
          class="bg-transparent outline-none border-none w-full text-xs text-zinc-200 placeholder:text-zinc-500 rounded-full" />
      </div>
    </HeaderSection>

    <div v-if="polls.data?.length" class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
      <PollCard v-for="poll in polls.data" :key="poll.id" :poll="poll" />
    </div>

    <div v-else class="mt-16 rounded-3xl border border-zinc-800 bg-zinc-950/80 p-10 text-center">
      <p class="text-sm text-zinc-400">
        No polls found. Try adjusting your filters.
      </p>
    </div>
  </AuthenticatedLayout>
</template>
