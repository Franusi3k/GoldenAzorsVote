<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  email: {
    type: String,
    required: true,
  },
  token: {
    type: String,
    required: true,
  },
});

const form = useForm({
  token: props.token,
  email: props.email,
  password: '',
  password_confirmation: '',
});

const submit = () => {
  form.post(route('password.store'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>

<template>
  <AuthLayout>

    <Head>
      <title>Reset password – GoldenAzorsVote</title>
      <meta name="description" content="Set a new password for your GoldenAzorsVote account." />
    </Head>

    <div
      class="overflow-hidden rounded-3xl border border-zinc-800 bg-zinc-950/80 p-6 shadow-xl shadow-black/50 backdrop-blur md:p-8">
      <div class="mb-6 space-y-2 text-center">
        <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-emerald-400">
          Security
        </p>
        <h1 class="text-lg font-semibold text-zinc-50 md:text-xl">
          Reset your password
        </h1>
        <p class="text-xs text-zinc-400">
          Choose a new password for your account.
        </p>
      </div>

      <form class="space-y-4" @submit.prevent="submit">
        <div class="space-y-1.5">
          <label for="email" class="block text-xs font-medium text-zinc-300">
            Email
          </label>
          <input id="email" v-model="form.email" type="email" autocomplete="username" required readonly
            class="block w-full cursor-not-allowed rounded-xl border border-zinc-800 bg-zinc-950/60 px-3 py-2 text-sm text-zinc-300 outline-none ring-0 placeholder:text-zinc-600" />
          <p v-if="form.errors.email" class="text-[11px] text-red-400">
            {{ form.errors.email }}
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
            Confirm new password
          </label>
          <input id="password_confirmation" v-model="form.password_confirmation" type="password"
            autocomplete="new-password" required
            class="block w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 outline-none ring-0 placeholder:text-zinc-500 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500"
            placeholder="••••••••" />
          <p v-if="form.errors.password_confirmation" class="text-[11px] text-red-400">
            {{ form.errors.password_confirmation }}
          </p>
        </div>

        <button type="submit" :disabled="form.processing"
          class="mt-2 flex w-full items-center justify-center rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2.5 text-sm font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 transition hover:brightness-110 active:scale-[0.98] disabled:cursor-not-allowed disabled:opacity-70">
          <span v-if="!form.processing">Reset password</span>
          <span v-else>Resetting…</span>
        </button>
      </form>

      <div class="mt-6 border-t border-zinc-800 pt-4 text-center">
        <p class="text-[11px] text-zinc-400">
          Remembered your password?
          <Link :href="route('login')" class="font-medium text-emerald-400 hover:text-emerald-300">
            Log in
          </Link>
        </p>
      </div>
    </div>
  </AuthLayout>
</template>
