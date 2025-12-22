<template>
  <div class="min-h-[100dvh] bg-zinc-950 text-zinc-50">
    <div
      class="pointer-events-none fixed inset-x-0 top-[-10rem] z-0 mx-auto h-72 max-w-xl rounded-full bg-emerald-500/10 blur-3xl" />
    <div
      class="pointer-events-none fixed inset-x-0 bottom-[-12rem] z-0 mx-auto h-80 max-w-xl rounded-full bg-amber-500/10 blur-3xl" />

    <div class="relative z-10 flex min-h-[100dvh] flex-col pb-[env(safe-area-inset-bottom)]">
      <header class="px-4 pt-6">
        <div class="mx-auto flex max-w-6xl items-center justify-between">
          <AppLogo />
          <slot name="header-right" />
        </div>
      </header>

      <main class="flex flex-1 items-center justify-center px-4 py-8">
        <div class="w-full max-w-md">
          <slot />
        </div>
      </main>

      <footer class="px-4 pb-6">
        <div class="mx-auto flex max-w-6xl items-center justify-between text-[11px] text-zinc-500">
          <span>© {{ currentYear }} GoldenAzorsVote</span>

          <div class="flex gap-3">
            <Link href="#" class="hover:text-zinc-300">Privacy</Link>
            <Link href="#" class="hover:text-zinc-300">Terms</Link>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script setup>
import AppLogo from '@/Components/Brand/AppLogo.vue'
import { Link } from '@inertiajs/vue3'

const currentYear = new Date().getFullYear()
</script>
