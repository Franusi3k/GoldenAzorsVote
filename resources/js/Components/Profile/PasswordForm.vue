<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.put(route('password.update'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
    },
  })
}
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 px-4 py-4 md:px-6 md:py-5">
    <h2 class="text-lg font-medium text-zinc-50">Password settings</h2>
    <p class="mt-1 text-sm text-zinc-400">
      Update your password.
    </p>

    <form class="mt-6 max-w-xl space-y-4" @submit.prevent="submit">

      <div class="space-y-1.5">
        <label for="current_password" class="block text-xs font-medium text-zinc-300">
          Password
        </label>
        <input id="current_password" v-model="form.current_password" type="password" autocomplete="current-password"
          required
          class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
          placeholder="••••••••" />
        <p v-if="form.errors.current_password" class="text-[11px] text-red-400">
          {{ form.errors.current_password }}
        </p>
      </div>

      <div class="space-y-1.5">
        <label for="password" class="block text-xs font-medium text-zinc-300">
          New password
        </label>
        <input id="password" v-model="form.password" type="password" autocomplete="new-password" required
          class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
          placeholder="••••••••" />
        <p v-if="form.errors.password" class="text-[11px] text-red-400">
          {{ form.errors.password }}
        </p>
      </div>

      <div class="space-y-1.5">
        <label for="password_confirmation" class="block text-xs font-medium text-zinc-300">
          Confirm New password
        </label>
        <input id="password_confirmation" v-model="form.password_confirmation" type="password"
          autocomplete="new-password" required
          class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
          placeholder="••••••••" />
        <p v-if="form.errors.password_confirmation" class="text-[11px] text-red-400">
          {{ form.errors.password_confirmation }}
        </p>
      </div>
      <div class="flex items-center gap-4">
        <button type="submit" :disabled="form.processing"
          class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-5 py-2 text-sm font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition">
          <span v-if="!form.processing">Update password</span>
          <span v-else>Updating…</span>
        </button>
        <p v-if="form.recentlySuccessful" class="text-[11px] text-emerald-400">
          Password updated successfully.
        </p>
      </div>
    </form>
  </div>
</template>
