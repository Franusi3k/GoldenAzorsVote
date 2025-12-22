<script setup>
import { Link } from "@inertiajs/vue3";
import PollStatusBadge from "@/Components/Polls/PollStatusBadge.vue";

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
  <div class="space-y-3">
    <div v-for="poll in polls" :key="poll.id"
      class="rounded-3xl border border-zinc-800 bg-zinc-950/80 px-4 py-3 text-xs text-zinc-300">
      <div class="flex items-start justify-between gap-2">
        <div class="min-w-0">
          <p class="text-sm font-semibold text-zinc-50 truncate">
            {{ poll.name ?? "—" }}
          </p>
          <p class="mt-0.5 text-[11px] text-zinc-500 truncate">
            {{ poll.slug || "No slug set" }} · Created: {{ poll.created_at ?? "—" }}
          </p>
        </div>
        <PollStatusBadge :status="poll.status" />
      </div>

      <div class="mt-2 text-[11px] text-zinc-400" v-if="showOwner">
        {{ poll?.owner?.name ?? "—" }} · {{ poll?.owner?.email ?? "—" }}
      </div>

      <div class="mt-2 text-[11px] text-zinc-400">
        {{ poll.categories_count ?? 0 }} categories · {{ poll.votes_count ?? 0 }} votes
      </div>

      <div class="mt-0.5 text-[11px] text-zinc-500">Starts: {{ poll.starts_at ?? "—" }}</div>
      <div class="mt-0.5 text-[11px] text-zinc-500">Ends: {{ poll.ends_at ?? "—" }}</div>

      <div class="flex items-center justify-end gap-6">
        <Link href="#" class="text-[11px] text-zinc-400 hover:text-emerald-400">
          Open poll
        </Link>
        <Link href="#"
          class="rounded-full border border-zinc-700 bg-zinc-900 px-3 py-1 text-[11px] font-medium text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition">
          Edit
        </Link>
      </div>
    </div>
  </div>
</template>
