<script setup>
import PollStatusBadge from "@/Components/Polls/PollStatusBadge.vue";
import { Link } from "@inertiajs/vue3";
import { useDateTime } from "@/Composables/useDateTime";

defineProps({
  polls: {
    type: Array,
    required: true,
  },
  showOwner: {
    type: Boolean,
    default: false,
  },
});
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 bg-zinc-950/80 overflow-hidden">
    <table class="w-full text-left text-xs">
      <thead class="bg-zinc-900/60 text-zinc-500 uppercase text-[10px] tracking-[0.16em]">
        <tr>
          <th class="px-4 py-3 font-medium">Poll</th>
          <th v-if="showOwner" class="px-4 py-3 font-medium">Owner</th>
          <th class="px-4 py-3 font-medium">Status & stats</th>
          <th class="px-4 py-3 font-medium">Opens & Closes</th>
          <th class="px-4 py-3 text-right font-medium">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="poll in polls" :key="poll.id" class="border-t border-zinc-800/60 hover:bg-zinc-900/40 transition">
          <td class="px-4 py-3 align-top">
            <div class="flex flex-col gap-0.5">
              <p class="text-sm font-semibold text-zinc-50 truncate">
                {{ poll.name ?? "—" }}
              </p>
              <p class="text-[11px] text-zinc-500 truncate">
                {{ poll.slug || "No slug set" }} · Created: {{ useDateTime(poll.created_at).dateTime }}
              </p>
            </div>
          </td>
          <td class="px-4 py-3 align-top" v-if="showOwner">
            <p class="text-sm text-zinc-100">
              {{ poll?.owner?.name ?? "—" }}
            </p>
            <p class="text-[11px] text-zinc-400 truncate">
              {{ poll?.owner?.email ?? "—" }}
            </p>
          </td>

          <td class="px-4 py-3 align-top">
            <div class="flex flex-col gap-1">
              <PollStatusBadge :status="poll.status" class="w-fit" />
              <p class="text-[11px] text-zinc-400">
                {{ poll.rounds_count ?? 0 }} rounds · {{ poll.votes_count ?? 0 }} votes
              </p>
            </div>
          </td>

          <td class="px-5 py-4">
            <p class="mt-1 text-[11px] text-zinc-500">
              Opens: <span class="text-zinc-300">{{ useDateTime(poll.opens_at).dateTime }}</span>
            </p>
            <p class="mt-1 text-[11px] text-zinc-500">
              Closes: <span class="text-zinc-300">{{ useDateTime(poll.closes_at).dateTime }}</span>
            </p>
          </td>

          <td class="px-4 py-3 align-top text-right">
            <div class="flex flex-col items-end gap-1 text-[11px]">
              <Link :href="route('admin.polls.show', poll.id)" class="text-zinc-400 hover:text-emerald-400">
                Open poll
              </Link>
              <Link href="#"
                class="rounded-full border border-zinc-700 bg-zinc-900 px-3 py-1 text-[11px] font-medium text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition">
                Edit
              </Link>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
