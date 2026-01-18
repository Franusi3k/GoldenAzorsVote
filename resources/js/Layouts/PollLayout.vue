<template>
  <div class="min-h-screen bg-zinc-950 text-zinc-50">

    <div class="relative z-10 flex min-h-screen flex-col">
      <header class="px-4 pt-3">
        <div class="mx-auto flex max-w-6xl items-center justify-between">
          <AppLogo />

          <slot name="header-right">
            <UserMenu :userName="userName" />
          </slot>
        </div>
      </header>

      <main class="flex-1 px-4 py-4">
        <div class="mx-auto w-full max-w-6xl">
          <slot />
        </div>
      </main>

      <footer class="px-4 pb-3">
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
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import UserMenu from '@/Components/Navigation/UserMenu.vue'

const currentYear = new Date().getFullYear()
const page = usePage()

const userName = computed(() => page.props.auth?.user?.name || 'User')

</script>