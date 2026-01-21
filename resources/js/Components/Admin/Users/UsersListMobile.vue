<script setup>
import { useDateTime } from '@/Composables/useDateTime';

defineProps({
  users: {
    type: Array,
    required: true,
  },
});

const emit = defineEmits(["edit"]);

const onEdit = (user) => emit("edit", user);
</script>

<template>
  <div class="space-y-3">
    <div v-for="user in users" :key="user.id"
      class="rounded-3xl border border-zinc-800 bg-zinc-950/80 px-4 py-3 text-xs text-zinc-300">
      <div class="flex items-start justify-between gap-3">
        <div class="min-w-0">
          <p class="text-sm font-semibold text-zinc-50 truncate">
            {{ user.name ?? "—" }}
          </p>
          <p class="mt-0.5 text-[11px] text-zinc-500 truncate">
            {{ user.email ?? "—" }}
          </p>

          <div class="mt-2 text-[11px] text-zinc-400">
            <span class="text-zinc-500">Polls:</span> {{ user.polls_count ?? 0 }}
            <span class="mx-2 text-zinc-700">•</span>
            <span class="text-zinc-500">Votes:</span> {{ user.votes_count ?? 0 }}
          </div>

          <div class="mt-2 text-[11px] text-zinc-500">
            Created: <span class="text-zinc-300">{{ useDateTime(user.created_at).dateTime }}</span>
          </div>
        </div>

        <button type="button"
          class="rounded-full border border-zinc-700 bg-zinc-900 px-3 py-1 text-[11px] font-medium text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition"
          @click="onEdit(user)">
          Edit
        </button>
      </div>
    </div>
  </div>
</template>
