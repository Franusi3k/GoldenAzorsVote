<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage, Link } from "@inertiajs/vue3";
import { ref } from "vue";
import {
  BarChart3,
  Calendar,
  Clock,
  Eye,
  Layers,
  Users,
  Pencil,
  Trophy,
  Link2,
  Check
} from "lucide-vue-next";
import { useDateTime } from "@/Composables/useDateTime";

const props = defineProps({
  poll: {
    type: Object,
    default: () => ({}),
  },
});

const page = usePage();
const user = page.props.auth.user;
const isAdmin = user.roles.some((role) => role.name === "admin");

const copied = ref(false)

const publicUrl = `${window.location.origin}/polls/${props.poll.slug}`

const copyLink = async () => {
  await navigator.clipboard.writeText(publicUrl)
  copied.value = true
  setTimeout(() => (copied.value = false), 2000)
}


</script>

<template>
  <component :is="isAdmin ? AdminLayout : AuthenticatedLayout">

    <Head :title="`Details – ${poll.name} | GoldenAzorsVote`" />

    <template #title> Poll Details </template>

    <div class="space-y-10">
      <section class="rounded-3xl border border-zinc-800 bg-zinc-950/80 p-6">
        <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
          <div class="space-y-2">
            <h1 class="text-xl font-semibold text-zinc-50">
              {{ poll.name }}
            </h1>
            <div class="flex flex-wrap items-center gap-4 text-xs text-zinc-400">
              <div class="flex items-center gap-1">
                <Calendar class="h-4 w-4" />
                Opens: {{ useDateTime(poll.opens_at).dateTimeLong ?? "—" }}
              </div>
              <div class="flex items-center gap-1">
                <Clock class="h-4 w-4" />
                Closes: {{ useDateTime(poll.closes_at).dateTimeLong ?? "—" }}
              </div>
              <div class="flex items-center gap-1">
                <Eye class="h-4 w-4" />
                {{ poll.poll_type === 'open' ? 'Public' : 'Private' }} poll
              </div>
            </div>
          </div>

          <div class="flex flex-wrap items-center gap-2">
            <Link href="#"
              class="rounded-full border border-zinc-700 bg-zinc-900 px-4 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition">
              <Pencil class="h-4 w-4 inline-block mr-1" />
              Edit poll
            </Link>

            <Link href="#"
              class="rounded-full border border-zinc-700 bg-zinc-900 px-4 py-2 text-xs font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition">
              <Layers class="h-4 w-4 inline-block mr-1" />
              Manage Rounds
            </Link>
          </div>
        </div>
      </section>

      <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-6 xl:grid-cols-7">
        <div class="rounded-3xl border border-zinc-800 bg-zinc-950/70 p-5">
          <div class="flex items-center justify-between">
            <p class="text-xs text-zinc-400">Total votes</p>
            <BarChart3 class="h-4 w-4 text-emerald-400" />
          </div>
          <p class="mt-3 text-2xl font-semibold text-zinc-50">
            {{ poll.votes_count ?? 0 }}
          </p>
        </div>

        <div class="rounded-3xl border border-zinc-800 bg-zinc-950/70 p-5">
          <div class="flex items-center justify-between">
            <p class="text-xs text-zinc-400">Voters</p>
            <Users class="h-4 w-4 text-emerald-400" />
          </div>
          <p class="mt-3 text-2xl font-semibold text-zinc-50">
            {{ poll.voters_count ?? 0 }}
          </p>
        </div>

        <div class="rounded-3xl border border-zinc-800 bg-zinc-950/70 p-5">
          <div class="flex items-center justify-between">
            <p class="text-xs text-zinc-400">Rounds</p>
            <Layers class="h-4 w-4 text-emerald-400" />
          </div>
          <p class="mt-3 text-2xl font-semibold text-zinc-50">
            {{ poll.rounds.length ?? 0 }}
          </p>
        </div>

        <div class="rounded-3xl border border-zinc-800 bg-zinc-950/70 p-5">
          <div class="flex items-center justify-between">
            <p class="text-xs text-zinc-400">Status</p>
            <Clock class="h-4 w-4 text-emerald-400" />
          </div>
          <p class="mt-3 text-xl capitalize font-semibold text-zinc-50">
            {{ poll.status }}
          </p>
        </div>

        <div class="col-span-2 xl:col-span-3 rounded-3xl border border-zinc-800 bg-zinc-950/70 p-5">
          <div class="space-y-2">
            <div class="flex items-center justify-between">
              <p class="text-xs text-zinc-400">Shareable link</p>
              <Link2 class="h-4 w-4 text-emerald-400" />
            </div>
            <div class="mt-4 flex items-center gap-3 rounded-xl border border-zinc-800 bg-zinc-900/60 px-2 py-1">
              <span class="text-[12px] text-zinc-400 truncate">
                {{ publicUrl }}
              </span>

              <button @click="copyLink" title="Copy public link"
                class="ml-auto select-none inline-flex items-center gap-1 rounded-full border border-zinc-700 bg-zinc-950 px-2 py-1 text-[10px] font-semibold text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition">
                <Check v-if="copied" class="h-3 w-3 text-emerald-400" />
                <span>{{ copied ? 'Copied' : 'Copy' }}</span>
              </button>
            </div>
          </div>
        </div>
      </section>

      <section class="rounded-3xl border border-zinc-800 bg-zinc-950/80 p-6">
        <div class="mb-4 flex items-center gap-2">
          <Trophy class="h-4 w-4 text-emerald-400" />
          <h2 class="text-sm font-semibold text-zinc-50">Results overview</h2>
        </div>

        <div class="text-xs text-zinc-400">
          Results will be visible once voting starts or ends.
        </div>
      </section>
    </div>
  </component>
</template>
