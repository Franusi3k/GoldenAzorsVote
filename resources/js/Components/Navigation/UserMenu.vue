<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import { User, Settings, LogOut, ChevronDown, Home } from "lucide-vue-next";

const props = defineProps({
  userName: {
    type: String,
    required: true,
  },
});

const page = usePage()
const role = page.props.auth.user.roles.some(role => role.name === 'admin') ? 'admin' : 'user'

const open = ref(false);
const menuRef = ref(null);

const toggle = () => {
  open.value = !open.value;
};

const close = () => {
  open.value = false;
};

const handleClickOutside = (e) => {
  if (menuRef.value && !menuRef.value.contains(e.target)) {
    close();
  }
};

const handleEsc = (e) => {
  if (e.key === "Escape") close();
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
  document.addEventListener("keydown", handleEsc);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", handleClickOutside);
  document.removeEventListener("keydown", handleEsc);
});
</script>

<template>
  <div ref="menuRef" class="relative">
    <button type="button" @click="toggle"
      class="flex items-center gap-2 rounded-full border border-zinc-800 bg-zinc-950 px-2 py-1.5 hover:border-emerald-400 transition">
      <div
        class="h-7 w-7 rounded-full bg-gradient-to-br from-emerald-500 to-amber-400 flex items-center justify-center text-[11px] font-semibold text-zinc-950">
        <User class="w-4 h-4" />
      </div>

      <span class="text-xs text-zinc-100 truncate max-w-[140px] hidden sm:block">
        {{ userName }}
      </span>

      <ChevronDown class="w-4 h-4 text-zinc-400 transition" :class="open && 'rotate-180'" />
    </button>

    <transition enter-active-class="transition ease-out duration-150"
      enter-from-class="opacity-0 scale-95 translate-y-1" enter-to-class="opacity-100 scale-100 translate-y-0"
      leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100 scale-100 translate-y-0"
      leave-to-class="opacity-0 scale-95 translate-y-1">
      <div v-if="open"
        class="absolute right-0 z-50 mt-2 w-56 rounded-2xl border border-zinc-800 bg-zinc-950 shadow-xl shadow-black/40 backdrop-blur">
        <div class="p-2">
          <div class="px-3 py-2 text-[10px] uppercase tracking-wide rounded-xl mb-1 flex items-center justify-between"
            :class="role === 'admin'
              ? 'bg-amber-500/10 text-amber-400'
              : 'bg-emerald-500/10 text-emerald-400'
              ">
            <span>
              {{ role === 'admin' ? 'Administrator' : 'User account' }}
            </span>

            <span class="rounded-full px-2 py-0.5 text-[9px] font-semibold" :class="role === 'admin'
              ? 'bg-amber-400 text-zinc-950'
              : 'bg-emerald-400 text-zinc-950'
              ">
              {{ role }}
            </span>
          </div>

          <Link :href="route(role === 'admin' ? 'admin.dashboard' : 'user.dashboard')"
            class="flex items-center gap-2 rounded-xl px-3 py-2 text-xs text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400 transition"
            @click="close">
            <Home class="w-4 h-4" />
            Dashboard
          </Link>

          <Link :href="route('profile.edit')"
            class="flex items-center gap-2 rounded-xl px-3 py-2 text-xs text-zinc-300 hover:bg-zinc-900 hover:text-emerald-400 transition"
            @click="close">
            <Settings class="w-4 h-4" />
            Settings
          </Link>

          <div class="my-1 h-px bg-zinc-800"></div>

          <Link :href="route('logout')" method="post"
            class="flex w-full items-center gap-2 rounded-xl px-3 py-2 text-xs text-zinc-300 hover:bg-red-500/10 hover:text-red-400 transition">
            <LogOut class="w-4 h-4" />
            Log out
          </Link>
        </div>
      </div>
    </transition>
  </div>
</template>
