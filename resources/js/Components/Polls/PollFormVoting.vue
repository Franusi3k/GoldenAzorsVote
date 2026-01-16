<script setup>
const props = defineProps({
  form: {
    type: Object,
    required: true,
  },
})

const setPollType = type => {
  props.form.poll_type = type
}
</script>

<template>
  <div class="rounded-3xl border border-zinc-800 bg-zinc-950/80 p-4 md:p-5 space-y-4">
    <div class="flex items-center justify-between gap-2">
      <div>
        <h2 class="text-sm font-semibold text-zinc-50">
          Voting & access
        </h2>
        <p class="text-[11px] text-zinc-400">
          Control who can vote and when your poll is available.
        </p>
      </div>
    </div>

    <div class="space-y-3">
      <div>
        <p class="text-[11px] font-medium text-zinc-300 mb-1.5">
          Poll type
        </p>
        <div class="inline-flex gap-2 rounded-full bg-zinc-950/80 p-1 border border-zinc-800 text-[11px]">
          <button type="button" class="rounded-full px-3 py-1" :class="form.poll_type === 'open'
            ? 'bg-zinc-900 text-zinc-100 border border-zinc-700'
            : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900'" @click="setPollType('open')">
            Open (any logged-in user)
          </button>
          <button type="button" class="rounded-full px-3 py-1" :class="form.poll_type === 'closed'
            ? 'bg-zinc-900 text-zinc-100 border border-zinc-700'
            : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-900'" @click="setPollType('closed')">
            Closed (invite only)
          </button>
        </div>
        <p v-if="form.errors.poll_type" class="mt-1 text-[11px] text-red-400">
          {{ form.errors.poll_type }}
        </p>
      </div>

      <div class="grid gap-3 md:grid-cols-2">
        <div>
          <label for="opens-at" class="block text-xs font-medium text-zinc-300 mb-1">
            Opens at
          </label>
          <input id="opens-at" v-model="form.opens_at" type="datetime-local"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none" />
          <p v-if="form.errors.opens_at" class="mt-1 text-[11px] text-red-400">
            {{ form.errors.opens_at }}
          </p>
        </div>
        <div>
          <label for="closes-at" class="block text-xs font-medium text-zinc-300 mb-1">
            Closes at
          </label>
          <input id="closes-at" v-model="form.closes_at" type="datetime-local"
            class="w-full rounded-xl border border-zinc-700 bg-zinc-950/80 px-3 py-2 text-sm text-zinc-50 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none" />
          <p v-if="form.errors.closes_at" class="mt-1 text-[11px] text-red-400">
            {{ form.errors.closes_at }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
