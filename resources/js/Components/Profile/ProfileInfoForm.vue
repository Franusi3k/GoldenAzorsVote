<script setup>
import { useForm, usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user

const form = useForm({
  name: user.name,
  email: user.email,
})
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 px-4 py-4 md:px-6 md:py-5">
    <h2 class="text-lg font-medium text-zinc-50">Profile information</h2>
    <p class="mt-1 text-sm text-zinc-400">
      Update your name and email address.
    </p>

    <form class="mt-6 max-w-xl space-y-4" @submit.prevent="form.patch(route('profile.update'))">
      <div class="space-y-1.5">
        <label for="name" class="block text-xs font-medium text-zinc-300">
          Name
        </label>
        <input id="name" v-model="form.name" type="text" autocomplete="name" required autofocus
          class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
          placeholder="Your name or nickname" />
        <p v-if="form.errors.name" class="text-[11px] text-red-400">
          {{ form.errors.name }}
        </p>
      </div>

      <div class="space-y-1.5">
        <label for="email" class="block text-xs font-medium text-zinc-300">
          Email
        </label>
        <input id="email" v-model="form.email" type="email" autocomplete="username" required
          class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
          placeholder="you@example.com" />
        <p v-if="form.errors.email" class="text-[11px] text-red-400">
          {{ form.errors.email }}
        </p>
      </div>

      <div class="flex items-center gap-4">
        <button type="submit" :disabled="form.processing"
          class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-5 py-2 text-sm font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition">
          <span v-if="!form.processing">Save changes</span>
          <span v-else>Saving…</span>
        </button>
        <p v-if="form.recentlySuccessful" class="text-[11px] text-emerald-400">
          Saved
        </p>
      </div>
    </form>
  </div>
</template>
