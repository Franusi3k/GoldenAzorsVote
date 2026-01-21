<script setup>
import { useDateTime } from '@/Composables/useDateTime';

defineProps({
  items: { type: Array, default: () => [] },
  description: String,
})
import { Vote, User } from 'lucide-vue-next'

const icon = (type) => {
  const t = (type || '').toLowerCase()
  if (t === 'poll') return Vote
  if (t === 'user') return User
  return null
}
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 bg-zinc-950/60 p-4 shadow-sm">
    <div class="mb-3">
      <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-zinc-500">
        Activity
      </p>
      <p v-if="description" class="text-xs text-zinc-400">
        {{ description }}
      </p>
    </div>

    <div class="space-y-2">
      <div v-for="item in items" :key="item.id" class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-3">
        <div class="flex items-start gap-3">
          <div class="mt-0.5 flex h-7 w-7 items-center justify-center rounded-xl bg-zinc-900 text-[12px]">
            <component :is="icon(item.type)" class="w-4 h-4 text-zinc-400" />
          </div>

          <div class="min-w-0 flex-1">
            <p class="text-xs text-zinc-200">
              {{ item.description }}
            </p>
            <p class="mt-1 text-[11px] text-zinc-500">
              {{ useDateTime(item.time).relative }}
            </p>
          </div>
        </div>
      </div>

      <div v-if="!items.length"
        class="rounded-2xl border border-zinc-800 bg-zinc-950/60 p-4 text-center text-xs text-zinc-500">
        No recent activity.
      </div>
    </div>
  </div>
</template>
