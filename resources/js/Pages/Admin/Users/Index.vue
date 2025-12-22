<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import UsersTable from "@/Components/Admin/Users/UsersTable.vue";
import UsersListMobile from "@/Components/Admin/Users/UsersListMobile.vue";
import EditUserModal from "@/Components/Admin/Users/EditUserModal.vue";
import { Head } from "@inertiajs/vue3";
import { Search } from "lucide-vue-next";
import { ref } from "vue";

const props = defineProps({
  users: {
    type: Array,
    default: () => [{}],
  },
});

const editOpen = ref(false);
const selectedUser = ref(null);

const openEdit = (user) => {
  selectedUser.value = user;
  editOpen.value = true;
};

const closeEdit = () => {
  editOpen.value = false;
  selectedUser.value = null;
};
</script>

<template>
  <AdminLayout>
    <Head title="Users – GoldenAzorsVote" />

    <template #title>Users</template>

    <div class="mb-4 flex items-center justify-end flex-wrap">
      <div
        class="flex items-center gap-1 rounded-full border border-zinc-800 bg-zinc-950 px-3 py-1.5 text-xs text-zinc-400"
      >
        <span class="text-zinc-500">
          <Search class="w-3 h-3" />
        </span>
        <input
          type="text"
          placeholder="Search users..."
          class="bg-transparent outline-none border-none text-xs text-zinc-200 placeholder:text-zinc-500 rounded-full"
        />
      </div>
    </div>

    <div v-if="users.length">
      <UsersListMobile class="md:hidden" :users="users" @edit="openEdit" />
      <UsersTable class="hidden md:block" :users="users" @edit="openEdit" />
    </div>

    <div
      v-else
      class="rounded-3xl border border-dashed border-zinc-800 bg-zinc-950/60 px-6 py-12 text-center text-sm text-zinc-400"
    >
      <p class="mb-2 text-zinc-300">No users found.</p>
      <p class="text-[11px] text-zinc-500 mb-6">
        Try again later.
      </p>
    </div>

    <EditUserModal
      :open="editOpen"
      :user="selectedUser"
      @close="closeEdit"
    />
  </AdminLayout>
</template>
