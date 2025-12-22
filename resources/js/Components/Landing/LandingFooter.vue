<template>
  <footer class="border-t border-zinc-800 bg-zinc-950">
    <div
      class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-3 px-4 py-6 text-[11px] text-zinc-500 md:flex-row md:text-xs">
      <div class="flex items-center gap-2">
        <span class="font-medium text-zinc-300">GoldenAzorsVote</span>
        <span class="text-zinc-600">•</span>
        <span>© {{ currentYear }} All rights reserved.</span>
      </div>
      <div class="flex flex-wrap items-center gap-4">
        <Link href="#" class="hover:text-zinc-300">Privacy</Link>
        <Link href="#" class="hover:text-zinc-300">Terms</Link>
        <a href="https://github.com/Franusi3k/GoldenAzorsVote" target="_blank" rel="noopener noreferrer"
          class="hover:text-zinc-300">GitHub</a>
        <a href="mailto:" class="hover:text-zinc-300">
          Contact
        </a>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';

const currentYear = new Date().getFullYear()
</script>