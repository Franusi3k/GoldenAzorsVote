<script setup>
import { Link } from "@inertiajs/vue3";
import { ChevronLeft, ChevronRight } from "lucide-vue-next";

defineProps({
  links: {
    type: Array,
    required: true,
  },
});
</script>

<template>
  <nav v-if="links.length > 3" class="flex items-center justify-center gap-1" aria-label="Pagination">
    <template v-for="(link, index) in links" :key="index">
      <Link v-if="link.url" :href="link.url" preserve-scroll
        class="inline-flex min-w-[36px] items-center justify-center rounded-full border px-3 py-1.5 text-xs font-semibold transition"
        :class="[
          link.active
            ? 'border-emerald-400 bg-emerald-400/10 text-emerald-300'
            : 'border-zinc-800 bg-zinc-950 text-zinc-400 hover:border-emerald-400 hover:text-emerald-300',
        ]">
        <span v-if="link.label.includes('Previous')">
          <ChevronLeft class="h-4 w-4" />
        </span>

        <span v-else-if="link.label.includes('Next')">
          <ChevronRight class="h-4 w-4" />
        </span>

        <span v-else v-html="link.label" />
      </Link>

      <span v-else
        class="inline-flex min-w-[36px] items-center justify-center rounded-full border border-zinc-900 bg-zinc-900/50 px-3 py-1.5 text-xs font-semibold text-zinc-600"
        >
        <span v-if="link.label.includes('Previous')">
          <ChevronLeft class="h-4 w-4" />
        </span>

        <span v-else-if="link.label.includes('Next')">
          <ChevronRight class="h-4 w-4" />
        </span>
        <span v-else v-html="link.label" />
        </span>
    </template>
  </nav>
</template>
