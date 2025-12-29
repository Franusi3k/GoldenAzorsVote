<template>
  <div class="min-h-screen bg-zinc-950 text-zinc-50 flex">
    <aside class="hidden md:flex md:w-60 lg:w-64 flex-col border-r border-zinc-800 bg-zinc-950/95">
      <div class="flex items-center px-6 py-4 border-b border-zinc-800/70">
        <AppLogo />
      </div>

      <nav class="flex-1 px-3 py-4 space-y-1 text-sm bg-zinc-950">
        <Link :href="route('admin.dashboard')" class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('admin.dashboard')
          ? 'bg-zinc-900 text-emerald-400'
          : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'">
          <LayoutDashboard class="w-5 h-5" />
          <span>Overview</span>
        </Link>

        <Link :href="route('admin.polls.index')" class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('admin.polls.*')
          ? 'bg-zinc-900 text-emerald-400'
          : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'">
          <BarChart3 class="w-5 h-5" />
          <span>Polls</span>
        </Link>

        <Link :href="route('admin.users.index')" class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('admin.users.*')
          ? 'bg-zinc-900 text-emerald-400'
          : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'">
          <UsersRound class="w-5 h-5" />
          <span>Users</span>
        </Link>

        <div class="pt-2">
          <p class="px-3 pb-2 text-[10px] uppercase tracking-[0.2em] text-zinc-600">
            Account
          </p>

          <Link class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('#')
            ? 'bg-zinc-900 text-emerald-400'
            : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'">
            <Settings class="w-5 h-5" />
            <span>Settings</span>
          </Link>
        </div>
      </nav>

      <div class="border-t border-zinc-800 px-4 py-3 text-[11px] text-zinc-500">
        <p class="truncate">
          Admin:
          <span class="text-zinc-300">{{ userEmail }}</span>
        </p>
      </div>
    </aside>
    <div class="flex-1 flex flex-col min-w-0">
      <header class="sticky top-0 z-20 border-b border-zinc-800/70 bg-zinc-950">
        <div class="mx-auto max-w-6xl flex items-center justify-between px-4 py-3 gap-3">
          <div class="flex items-center gap-2">
            <button type="button"
              class="inline-flex md:hidden h-9 w-9 items-center justify-center rounded-xl border border-zinc-700 text-zinc-200"
              @click="mobileOpen = true">
              <Menu class="w-5 h-5" />
            </button>

            <div class="flex flex-col leading-tight">
              <p class="text-xs text-zinc-500 uppercase tracking-[0.2em]">
                Admin
              </p>
              <h1 class="text-sm font-semibold text-zinc-100">
                <slot name="title">Dashboard</slot>
              </h1>
            </div>
          </div>

          <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2 rounded-full border border-zinc-800 bg-zinc-950 px-2 py-1.5">
              <div
                class="h-7 w-7 rounded-full bg-gradient-to-br from-emerald-500 to-amber-400 flex items-center justify-center text-[11px] font-semibold text-zinc-950">
                <User class="w-4 h-4" />
              </div>
              <div class="flex flex-col leading-tight">
                <span class="text-xs text-zinc-100 truncate max-w-[160px]">
                  {{ userName }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </header>

      <main class="flex-1">
        <div class="mx-auto max-w-6xl px-4 py-6 md:py-8">
          <slot />
        </div>
      </main>
    </div>
    <transition name="fade">
      <div v-if="mobileOpen" class="fixed inset-0 z-30 flex md:hidden">
        <div class="flex h-full w-64 flex-col border-r border-zinc-800 bg-zinc-950">
          <div class="flex items-center justify-between px-4 py-3 border-b border-zinc-800">
            <AppLogo />
            <button type="button"
              class="h-8 w-8 flex justify-center items-center rounded-xl border border-zinc-700 text-zinc-300"
              @click="mobileOpen = false">
              <X class="w-5 h-5" />
            </button>
          </div>

          <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
            <Link :href="route('admin.dashboard')" class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('admin.dashboard')
              ? 'bg-zinc-900 text-emerald-400'
              : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'" @click="mobileOpen = false">
              <LayoutDashboard class="w-5 h-5" />
              <span>Overview</span>
            </Link>

            <Link :href="route('admin.polls.index')" class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('admin.polls.*')
              ? 'bg-zinc-900 text-emerald-400'
              : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'" @click="mobileOpen = false">
              <BarChart3 class="w-5 h-5" />
              <span>Polls</span>
            </Link>

            <Link :href="route('admin.users.index')" class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('admin.users.*')
              ? 'bg-zinc-900 text-emerald-400'
              : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'" @click="mobileOpen = false">
              <UsersRound class="w-5 h-5" />
              <span>Users</span>
            </Link>

            <div class="pt-2">
              <p class="px-3 pb-2 text-[10px] uppercase tracking-[0.2em] text-zinc-600">
                Account
              </p>

              <Link href="#" class="flex items-center gap-2 rounded-xl px-3 py-2" :class="isCurrent('#')
                ? 'bg-zinc-900 text-emerald-400'
                : 'text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400'" @click="mobileOpen = false">
                <Settings class="w-5 h-5" />
                <span>Settings</span>
              </Link>
            </div>
          </nav>

          <div class="border-t border-zinc-800 px-4 py-3 text-[11px] text-zinc-500">
            <p class="truncate">
              Admin:
              <span class="text-zinc-300">{{ userEmail }}</span>
            </p>
          </div>
        </div>

        <div class="flex-1 bg-black/50" @click="mobileOpen = false" />
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { LayoutDashboard, BarChart3, UsersRound, Settings, Menu, X, User } from 'lucide-vue-next'
import AppLogo from '@/Components/Brand/AppLogo.vue'

const mobileOpen = ref(false)
const page = usePage()

const userName = computed(() => page.props.auth?.user?.name || 'Admin')
const userEmail = computed(() => page.props.auth?.user?.email || 'admin@example.com')

const isCurrent = (pattern) => {
  if (!pattern.includes('*')) return route().current(pattern)
  const routeName = route().current() || ''
  const base = pattern.replace('.*', '')
  return routeName.startsWith(base)
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.16s ease-out;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
