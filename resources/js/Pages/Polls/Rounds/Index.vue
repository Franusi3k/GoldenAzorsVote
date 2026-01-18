<script setup>
import { ref } from "vue";
import { Head, Link, useForm, usePage } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Draggable from "vuedraggable";
import { ArrowBigLeft, Plus, GripVertical } from "lucide-vue-next";
import RoundModal from "@/Components/Rounds/RoundModal.vue";
import OptionsModal from "@/Components/Rounds/OptionsModal.vue";
import AddRoundModal from "@/Components/Rounds/AddRoundModal.vue";

const props = defineProps({
  poll: {
    type: Object,
    required: true,
  },
});

const page = usePage()
const user = page.props.auth.user
const isAdmin = user.roles.some(role => role.name === 'admin')

const roundsLocal = ref([...props.poll.rounds]);

const reorderForm = useForm({ order: [] });

const persistRoundsOrder = () => {
  reorderForm.order = roundsLocal.value.map((c) => c.id);

  reorderForm.put(route("#", props.poll.id), {
    preserveScroll: true,
  });
};

const addRoundOpen = ref(false);
const editRoundOpen = ref(false);
const editOptionsOpen = ref(false);

const selectedRound = ref(null);

const openEditRound = (cat) => {
  selectedRound.value = cat;
  editRoundOpen.value = true;
};

const openEditOptions = (cat) => {
  selectedRound.value = cat;
  editOptionsOpen.value = true;
};
</script>

<template>
  <component :is="user.roles.some(role => role.name === 'admin') ? AdminLayout : AuthenticatedLayout">

    <Head :title="`Manage rounds – ${poll.name} | GoldenAzorsVote`" />

    <template #title>
      Manage Rounds
    </template>

    <section class="mb-6 flex flex-col gap-6">
      <div class="flex items-start justify-between gap-3 flex-wrap">
        <div>
          <Link :href="isAdmin ? route('admin.polls.index') : '#'"
            class="text-[11px] text-zinc-400 hover:text-emerald-400 flex items-center">
            <ArrowBigLeft class="w-3 h-3 inline mr-1" /> Back to edit poll
          </Link>

          <h1 class="mt-1 text-lg font-semibold text-zinc-50">Manage rounds</h1>
          <p class="text-xs text-zinc-400">
            Rounds and options control the structure and presentation order.
          </p>
        </div>

        <div class="flex items-center gap-2">
          <button type="button"
            class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition"
            @click="addRoundOpen = true">
            <Plus class="w-3 h-3 inline mr-1" /> Add round
          </button>
        </div>
      </div>

      <Draggable v-model="roundsLocal" item-key="id" handle=".drag-handle"
        class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3" @end="persistRoundsOrder">
        <template #item="{ element: cat, index }">
          <div class="rounded-3xl border border-zinc-800 bg-zinc-950/80 p-4">
            <div class="flex items-start justify-between gap-3">
              <div class="min-w-0">
                <div class="flex items-center gap-2">
                  <span class="text-[10px] tracking-[0.16em] uppercase text-zinc-500">
                    #{{ index + 1 }}
                  </span>
                  <button type="button" class="drag-handle text-zinc-500 hover:text-zinc-300 transition"
                    title="Drag to reorder">
                    <GripVertical class="w-4 h-4" />
                  </button>
                </div>

                <p class="mt-1 text-sm font-semibold text-zinc-50 truncate">
                  {{ cat.title }}
                </p>
                <p class="mt-1 text-[11px] text-zinc-500 line-clamp-2">
                  {{ cat.description || "No description" }}
                </p>
              </div>

              <div class="text-[11px] text-zinc-400 whitespace-nowrap">
                {{ (cat.options?.length ?? 0) }} options
              </div>
            </div>

            <div class="mt-3 flex items-center justify-end gap-2">
              <button type="button"
                class="rounded-full border border-zinc-700 bg-zinc-900 px-3 py-1 text-[11px] font-medium text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition"
                @click="openEditRound(cat)">
                Edit round
              </button>

              <button type="button" class="text-[11px] text-zinc-400 hover:text-emerald-400 transition"
                @click="openEditOptions(cat)">
                Edit option
              </button>
            </div>
          </div>
        </template>
      </Draggable>

      <div v-if="!roundsLocal.length"
        class="rounded-3xl border border-dashed border-zinc-800 bg-zinc-950/60 px-6 py-12 text-center text-sm text-zinc-400">
        <p class="mb-2 text-zinc-300">No rounds yet.</p>
        <p class="text-[11px] text-zinc-500 mb-6">Create your first round to start adding options.</p>

        <button type="button"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 transition"
          @click="addRoundOpen = true">
          + Add round
        </button>
      </div>

      <AddRoundModal :open="addRoundOpen" :poll-id="poll.id" @close="addRoundOpen = false" />

      <RoundModal :open="editRoundOpen" :poll-id="poll.id" :round="selectedRound" @close="editRoundOpen = false" />

      <OptionsModal :open="editOptionsOpen" :poll-id="poll.id" :round="selectedRound"
        @close="editOptionsOpen = false" />
    </section>
  </component>
</template>
