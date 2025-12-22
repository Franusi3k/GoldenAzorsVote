<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

defineProps({
  canResetPassword: {
    type: Boolean,
  },
  status: {
    type: String,
  },
})

const form = useForm({
  email: '',
  password: '',
  remember: false,
})

const submit = () => {
  form.post(route('login'), {
    onFinish: () => form.reset('password'),
  })
}
</script>

<template>
  <AuthLayout>

    <Head>
      <title>Log in – GoldenAzorsVote</title>
      <meta name="description" content="Log in to GoldenAzorsVote to create polls, manage events and vote securely." />
    </Head>

    <div
      class="overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-950/80 p-6 shadow-xl shadow-black/50 backdrop-blur md:p-8">
      <div v-if="status"
        class="mb-4 rounded-2xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-[11px] text-emerald-200">
        {{ status }}
      </div>


      <div class="mb-6 space-y-2 text-center">
        <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-emerald-400">
          Welcome back
        </p>
        <h1 class="text-lg font-semibold text-zinc-50 md:text-xl">
          Log in to your account
        </h1>
        <p class="text-xs text-zinc-400">
          Access your polls, events and voting history.
        </p>
      </div>

      <form class="space-y-4" @submit.prevent="submit">
        <div class="space-y-1.5">
          <label for="email" class="block text-xs font-medium text-zinc-300">
            Email
          </label>
          <input id="email" v-model="form.email" type="email" autocomplete="username" required autofocus
            class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
            placeholder="you@example.com" />
          <p v-if="form.errors.email" class="text-[11px] text-red-400">
            {{ form.errors.email }}
          </p>
        </div>

        <div class="space-y-1.5">
          <div class="flex items-center justify-between">
            <label for="password" class="block text-xs font-medium text-zinc-300">
              Password
            </label>

            <Link v-if="canResetPassword" :href="route('password.request')"
              class="text-[11px] text-zinc-400 hover:text-emerald-400">
              Forgot password?
            </Link>
          </div>
          <input id="password" v-model="form.password" type="password" autocomplete="current-password" required
            class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
            placeholder="••••••••" />
          <p v-if="form.errors.password" class="text-[11px] text-red-400">
            {{ form.errors.password }}
          </p>
        </div>

        <div class="flex items-center justify-between pt-1">
          <label class="inline-flex items-center gap-2 text-[11px] text-zinc-400">
            <input v-model="form.remember" type="checkbox" name="remember"
              class="h-3 w-3 rounded border-zinc-600 bg-zinc-900 text-emerald-500 focus:ring-emerald-500" />
            <span>Remember me on this device</span>
          </label>
        </div>

        <button type="submit" :disabled="form.processing"
          class="mt-2 flex w-full items-center justify-center rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2.5 text-sm font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 transition hover:brightness-110 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-70">
          <span v-if="!form.processing">Log in</span>
          <span v-else>Logging in…</span>
        </button>
      </form>

      <div class="mt-6 border-t border-zinc-800 pt-4 text-center">
        <p class="text-[11px] text-zinc-400">
          New to GoldenAzorsVote?
          <Link :href="route('register')" class="font-medium text-emerald-400 hover:text-emerald-300">
            Create an account
          </Link>
        </p>
      </div>
    </div>
  </AuthLayout>
</template>
