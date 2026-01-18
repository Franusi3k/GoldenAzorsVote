<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  accept_terms: false,
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <AuthLayout>

    <Head>
      <title>Register – GoldenAzorsVote</title>
      <meta name="description"
        content="Create a GoldenAzorsVote account to host multi-round polls, award shows and secure voting events." />
    </Head>

    <div
      class="overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-950/80 p-6 shadow-xl shadow-black/50 backdrop-blur md:p-8">
      <div class="mb-6 space-y-2 text-center">
        <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-emerald-400">
          Get started
        </p>
        <h1 class="text-lg font-semibold text-zinc-50 md:text-xl">
          Create your account
        </h1>
        <p class="text-xs text-zinc-400">
          Host polls, manage events and invite your community.
        </p>
      </div>

      <form class="space-y-4" @submit.prevent="submit">
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

        <div class="space-y-1.5">
          <label for="password" class="block text-xs font-medium text-zinc-300">
            Password
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
            Confirm password
          </label>
          <input id="password_confirmation" v-model="form.password_confirmation" type="password"
            autocomplete="new-password" required
            class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
            placeholder="••••••••" />
          <p v-if="form.errors.password_confirmation" class="text-[11px] text-red-400">
            {{ form.errors.password_confirmation }}
          </p>
        </div>

        <div class="pt-1">
          <label
            class="flex items-start gap-3 rounded-2xl border border-zinc-800 bg-zinc-950/40 p-3 text-[11px] text-zinc-400">
            <input v-model="form.accept_terms" type="checkbox"
              class="mt-0.5 h-4 w-4 rounded border-zinc-600 bg-zinc-900 text-emerald-500 focus:ring-emerald-500" />
            <span class="leading-relaxed">
              I agree to the
              <Link href="#" class="font-medium text-emerald-400 hover:text-emerald-300">
                Terms of Service
              </Link>
              and acknowledge the
              <Link href="#" class="font-medium text-emerald-400 hover:text-emerald-300">
                Privacy Policy
              </Link>.
            </span>
          </label>

          <p v-if="form.errors.accept_terms" class="mt-2 text-[11px] text-red-400">
            {{ form.errors.accept_terms }}
          </p>
        </div>

        <button type="submit" :disabled="form.processing"
          class="mt-2 flex w-full items-center justify-center rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2.5 text-sm font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 transition hover:brightness-110 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-70">
          <span v-if="!form.processing">Create account</span>
          <span v-else>Creating account…</span>
        </button>
      </form>

      <div class="mt-6 border-t border-zinc-800 pt-4 text-center">
        <p class="text-[11px] text-zinc-400">
          Already registered?
          <Link :href="route('login')" class="font-medium text-emerald-400 hover:text-emerald-300">
            Log in
          </Link>
        </p>
      </div>
    </div>
  </AuthLayout>
</template>
