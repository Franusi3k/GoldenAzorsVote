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
  <div class="rounded-3xl border border-zinc-800 bg-zinc-950/80 overflow-hidden">
    <table class="w-full text-left text-xs">
      <thead class="bg-zinc-900/60 text-zinc-500 uppercase text-[10px] tracking-[0.16em]">
        <tr>
          <th class="px-4 py-3 font-medium">User</th>
          <th class="px-4 py-3 font-medium">Stats</th>
          <th class="px-4 py-3 font-medium">Created</th>
          <th class="px-4 py-3 text-right font-medium">Actions</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="user in users" :key="user.id" class="border-t border-zinc-800/60 hover:bg-zinc-900/40 transition">
          <td class="px-4 py-3 align-top">
            <div class="flex flex-col gap-0.5 min-w-0">
              <p class="text-sm font-semibold text-zinc-50 truncate">
                {{ user.name ?? "—" }}
              </p>
              <p class="text-[11px] text-zinc-500 truncate">
                {{ user.email ?? "—" }}
              </p>
            </div>
          </td>

          <td class="px-4 py-3 align-top text-[11px] text-zinc-400">
            <p>Polls: {{ user.polls_count ?? 0 }}</p>
            <p>Votes: {{ user.votes_count ?? 0 }}</p>
          </td>

          <td class="px-4 py-3 align-top">
            <p class="text-[11px] text-zinc-500">
              {{ useDateTime(user.created_at).dateTime }}
            </p>
          </td>

          <td class="px-4 py-3 align-top text-right">
            <button type="button"
              class="rounded-full border border-zinc-700 bg-zinc-900 px-3 py-2 text-[11px] font-medium text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition"
              @click="onEdit(user)">
              Edit
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
