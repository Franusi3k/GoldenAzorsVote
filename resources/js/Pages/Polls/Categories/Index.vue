<script setup>
import { ref, computed } from "vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import Draggable from "vuedraggable";
import { ArrowBigLeft, Plus, GripVertical } from "lucide-vue-next";
import CategoryModal from "@/Components/Categories/CategoryModal.vue";
import NomineesModal from "@/Components/Categories/NomineesModal.vue";
import AddCategoryModal from "@/Components/Categories/AddCategoryModal.vue";

const props = defineProps({
  poll: {
    type: Object,
    required: true,
  },
  categories: {
    type: Array, default: () => []
  },
  layout: String,
  backRoute: { type: String, required: true },
});

const Layout = computed(() => (props.layout === "admin" ? AdminLayout : AdminLayout));

const categoriesLocal = ref([...props.categories]);

const reorderForm = useForm({ order: [] });

const persistCategoryOrder = () => {
  reorderForm.order = categoriesLocal.value.map((c) => c.id);

  reorderForm.put(route("#", props.poll.id), {
    preserveScroll: true,
  });
};

const addCategoryOpen = ref(false);
const editCategoryOpen = ref(false);
const editNomineesOpen = ref(false);

const selectedCategory = ref(null);

const openEditCategory = (cat) => {
  selectedCategory.value = cat;
  editCategoryOpen.value = true;
};

const openEditNominees = (cat) => {
  selectedCategory.value = cat;
  editNomineesOpen.value = true;
};
</script>

<template>
  <component :is="Layout">

    <Head :title="`Manage categories – ${poll.name} | GoldenAzorsVote`" />

    <section class="mb-6 flex flex-col gap-6">
      <div class="flex items-start justify-between gap-3 flex-wrap">
        <div>
          <Link :href="backRoute" class="text-[11px] text-zinc-400 hover:text-emerald-400 flex items-center">
            <ArrowBigLeft class="w-3 h-3 inline mr-1" /> Back to edit poll
          </Link>

          <h1 class="mt-1 text-lg font-semibold text-zinc-50">Manage categories</h1>
          <p class="text-xs text-zinc-400">
            Categories and nominees control the structure and presentation order.
          </p>
        </div>

        <div class="flex items-center gap-2">
          <button type="button"
            class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 active:scale-[0.98] transition"
            @click="addCategoryOpen = true">
            <Plus class="w-3 h-3 inline mr-1" /> Add category
          </button>
        </div>
      </div>

      <Draggable v-model="categoriesLocal" item-key="id" handle=".drag-handle"
        class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3" @end="persistCategoryOrder">
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
                {{ (cat.options?.length ?? 0) }} nominees
              </div>
            </div>

            <div class="mt-3 flex items-center justify-end gap-2">
              <button type="button"
                class="rounded-full border border-zinc-700 bg-zinc-900 px-3 py-1 text-[11px] font-medium text-zinc-100 hover:border-emerald-400 hover:text-emerald-400 transition"
                @click="openEditCategory(cat)">
                Edit category
              </button>

              <button type="button" class="text-[11px] text-zinc-400 hover:text-emerald-400 transition"
                @click="openEditNominees(cat)">
                Edit nominees
              </button>
            </div>
          </div>
        </template>
      </Draggable>

      <div v-if="!categoriesLocal.length"
        class="rounded-3xl border border-dashed border-zinc-800 bg-zinc-950/60 px-6 py-12 text-center text-sm text-zinc-400">
        <p class="mb-2 text-zinc-300">No categories yet.</p>
        <p class="text-[11px] text-zinc-500 mb-6">Create your first category to start adding nominees.</p>

        <button type="button"
          class="rounded-full bg-gradient-to-r from-amber-400 to-emerald-500 px-4 py-2 text-xs font-semibold text-zinc-950 shadow-lg shadow-amber-500/30 hover:brightness-110 transition"
          @click="addCategoryOpen = true">
          + Add category
        </button>
      </div>

      <AddCategoryModal :open="addCategoryOpen" :poll-id="poll.id" @close="addCategoryOpen = false" />

      <CategoryModal :open="editCategoryOpen" :poll-id="poll.id" :category="selectedCategory"
        @close="editCategoryOpen = false" />

      <NomineesModal :open="editNomineesOpen" :poll-id="poll.id" :category="selectedCategory"
        @close="editNomineesOpen = false" />
    </section>
  </component>
</template>
