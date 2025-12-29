<script setup>
import { Link } from '@inertiajs/vue3'
import { MoveRight } from 'lucide-vue-next'
import PollStatusBadge from '@/Components/Polls/PollStatusBadge.vue'

defineProps({
  polls: {
    type: Array,
    default: () => []
  },
})
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 bg-zinc-950/60 p-4 shadow-sm">
    <div class="mb-3 flex items-center justify-between">
      <div>
        <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-zinc-500">
          Recent polls
        </p>
        <p class="text-xs text-zinc-400">
          Latest activity across the platform
        </p>
      </div>

      <Link :href="route('admin.polls.index')" class="text-xs text-zinc-400 hover:text-emerald-400 transition">
        View all
        <MoveRight class="inline h-4 w-4" />
      </Link>
    </div>

    <div class="space-y-2">
      <div v-for="poll in polls" :key="poll.id"
        class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-3 hover:border-zinc-700 hover:bg-zinc-900/40 transition">
        <div class="flex items-start justify-between gap-3">
          <div class="min-w-0">
            <p class="truncate text-sm font-semibold text-zinc-100">
              {{ poll.name ?? '—' }}
            </p>
            <p class="mt-1 text-[11px] text-zinc-500">
              Owner: <span class="text-zinc-300">{{ poll?.owner?.name ?? '—' }} · {{ poll?.owner?.email ?? '—' }}</span>
            </p>
          </div>
          <PollStatusBadge :status="poll.status" class="w-fit" />
        </div>
        <div class="mt-2 flex flex-wrap items-center gap-3 text-[11px] text-zinc-400">
          <span>
            Categories: <span class="text-zinc-200">{{ poll.categories_count ?? 0 }}</span>
          </span>
          <span class="text-zinc-600">•</span>
          <span>
            Votes: <span class="text-zinc-200">{{ poll.votes_count ?? 0 }}</span>
          </span>
          <span class="ml-auto">
            <Link :href="route('admin.polls.show', poll.id)" class="text-zinc-300 hover:text-emerald-400 transition">
              Open
              <MoveRight class="inline h-4 w-4" />
            </Link>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
