<template>
  <header class="sticky top-0 z-30 border-b border-zinc-800/70 bg-zinc-950/85 backdrop-blur">
    <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3 md:py-4">
      <AppLogo />

      <div class="hidden items-center gap-8 text-sm text-zinc-300 md:flex">
        <a href="#how-it-works"
          :class="activeSection === 'how-it-works' ? 'text-emerald-400 font-semibold' : 'hover:text-emerald-400'"
          @click.prevent="scrollToSection('how-it-works')">
          How it works
        </a>
        <a href="#features"
          :class="activeSection === 'features' ? 'text-emerald-400 font-semibold' : 'hover:text-emerald-400'"
          @click.prevent="scrollToSection('features')">
          Features
        </a>
        <a href="#demo" :class="activeSection === 'demo' ? 'text-emerald-400 font-semibold' : 'hover:text-emerald-400'"
          @click.prevent="scrollToSection('demo')">
          Demo
        </a>

        <a href="#tech" :class="activeSection === 'tech' ? 'text-emerald-400 font-semibold' : 'hover:text-emerald-400'"
          @click.prevent="scrollToSection('tech')">
          Tech stack
        </a>
        <div class="ml-4 flex items-center gap-3">
          <template v-if="!user">
            <Link :href="route('login')"
              class="text-xs font-medium text-zinc-300 hover:text-emerald-400 transition-colors">
              Log in
            </Link>
            <Link :href="route('register')"
              class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-1.5 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition">
              Get started
            </Link>
          </template>

          <template v-else>
            <UserMenu :userName="userName" />
          </template>
        </div>

      </div>
      <button type="button"
        class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-zinc-700 text-zinc-200 hover:border-emerald-400 hover:text-emerald-400 md:hidden"
        @click="mobileOpen = !mobileOpen">
        <span v-if="!mobileOpen" class="text-lg" aria-hidden="true">☰</span>
        <span v-else class="text-lg" aria-hidden="true">✕</span>
      </button>
    </nav>

    <transition name="fade-down">
      <div v-if="mobileOpen" class="border-t border-zinc-800/70 bg-zinc-950/95 md:hidden">
        <div class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-3 text-sm">
          <a href="#how-it-works" @click.prevent="mobileSectionNavigate('how-it-works')" class="rounded-md px-2 py-1.5"
            :class="activeSection === 'how-it-works'
              ? 'text-emerald-400'
              : 'hover:bg-zinc-900 hover:text-emerald-400 text-zinc-200'">
            How it works
          </a>
          <a href="#features" @click.prevent="mobileSectionNavigate('features')" class="rounded-md px-2 py-1.5" :class="activeSection === 'features'
            ? 'text-emerald-400'
            : 'hover:bg-zinc-900 hover:text-emerald-400 text-zinc-200'">
            Features
          </a>
          <a href="#demo" @click.prevent="mobileSectionNavigate('demo')" class="rounded-md px-2 py-1.5" :class="activeSection === 'demo'
            ? 'text-emerald-400'
            : 'hover:bg-zinc-900 hover:text-emerald-400 text-zinc-200'">
            Demo
          </a>
          <a href="#tech" @click.prevent="mobileSectionNavigate('tech')" class="rounded-md px-2 py-1.5" :class="activeSection === 'tech'
            ? 'text-emerald-400'
            : 'hover:bg-zinc-900 hover:text-emerald-400 text-zinc-200'">
            Tech stack
          </a>
          <div class="mt-2 flex gap-3">
            <template v-if="!user">
              <Link :href="route('login')"
                class="flex-1 rounded-full border border-zinc-700 px-3 py-1.5 text-xs font-medium text-zinc-200 hover:border-emerald-400 hover:text-emerald-400">
                Log in
              </Link>
              <Link :href="route('register')"
                class="flex-1 rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-3 py-1.5 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30">
                Get started
              </Link>
            </template>

            <template v-else>
              <Link :href="route(role === 'admin' ? 'admin.dashboard' : 'user.dashboard')"
                class="flex-1 rounded-full max-w-fit bg-gradient-to-r from-amber-400 to-emerald-500 px-3 py-1.5 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30"
                @click="closeMobile">
                Go to dashboard
              </Link>
            </template>
          </div>

        </div>
      </div>
    </transition>
  </header>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import AppLogo from '@/Components/Brand/AppLogo.vue';
import { useScrollSpy } from '@/Composables/useScrollSpy.js'
import { useScrollToSection } from '@/Composables/useScrollToSection'
import UserMenu from '../Navigation/UserMenu.vue';

const page = usePage()
const user = computed(() => page.props.auth?.user)
const userName = computed(() => user.value?.name || 'User')

const { activeSection } = useScrollSpy([
  'hero',
  'features',
  'how-it-works',
  'demo',
  'tech'
])

const { scrollToSection } = useScrollToSection(0)

const mobileSectionNavigate = (id) => {
  scrollToSection(id)
  closeMobile()
}

const mobileOpen = ref(false)

const closeMobile = () => {
  mobileOpen.value = false
}
</script>

<style scoped>
.fade-down-enter-active,
.fade-down-leave-active {
  transition: all 0.16s ease-out;
}

.fade-down-enter-from,
.fade-down-leave-to {
  opacity: 0;
  transform: translateY(-6px);
}
</style>
