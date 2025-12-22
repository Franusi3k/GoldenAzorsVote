<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import PollsTable from "@/Components/Polls/PollsTable.vue";
import PollsListMobile from "@/Components/Polls/PollsListMobile.vue";
import { Head } from "@inertiajs/vue3";
import { Search } from "lucide-vue-next";
import { ref, computed } from "vue";

const props = defineProps({
  polls: {
    type: Array,
    default: () => [],
  },
});

const filter = ref("all");

const filteredPolls = computed(() => {
  if (filter.value === "all") return props.polls;
  return props.polls.filter((p) => p.status === filter.value);
});

const filters = [
  { label: "All", value: "all" },
  { label: "Active", value: "active" },
  { label: "Scheduled", value: "scheduled" },
  { label: "Draft", value: "draft" },
  { label: "Closed", value: "closed" },
];

const resetFilters = () => {
  filter.value = "all";
};
</script>

<template>
  <AdminLayout>

    <Head title="Polls – GoldenAzorsVote" />

    <template #title>
      Polls
    </template>

    <div class="mb-4 flex items-center justify-between gap-3 flex-wrap">
      <div class="flex gap-1">
        <button v-for="f in filters" :key="f.value" @click="filter = f.value" type="button"
          class="rounded-full px-3 py-1.5 text-[11px] border transition" :class="filter === f.value
            ? 'bg-zinc-900 border-zinc-700 text-emerald-400'
            : 'bg-zinc-950 border-zinc-800 text-zinc-400 hover:text-emerald-400'
            ">
          {{ f.label }}
        </button>
      </div>

      <div
        class="flex items-center gap-1 rounded-full border border-zinc-800 bg-zinc-950 px-3 py-1.5 text-xs text-zinc-400">
        <span class="text-zinc-500">
          <Search class="w-3 h-3" />
        </span>
        <input type="text" placeholder="Search polls..."
          class="bg-transparent outline-none border-none text-xs text-zinc-200 placeholder:text-zinc-500 rounded-full" />
      </div>
    </div>

    <div v-if="filteredPolls.length">
      <PollsListMobile class="md:hidden" :polls="filteredPolls" :showOwner="true" />
      <PollsTable class="hidden md:block" :polls="filteredPolls" :showOwner="true" />
    </div>
    <div v-else
      class="rounded-3xl border border-dashed border-zinc-800 bg-zinc-950/60 px-6 py-12 text-center text-sm text-zinc-400">
      <p class="mb-2 text-zinc-300">No results found.</p>
      <p class="text-[11px] text-zinc-500 mb-6">
        Try changing filters or clearing the search query.
      </p>

      <button type="button"
        class="rounded-full border border-zinc-700 bg-zinc-900 px-5 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition"
        @click="resetFilters()">
        Reset filters
      </button>
    </div>
  </AdminLayout>
</template>
