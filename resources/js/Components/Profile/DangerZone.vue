<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import ConfirmModal from '@/Components/ConfirmModal.vue'

const open = ref(false)

const form = useForm({})

const confirmDelete = () => {
  form.delete(route('profile.destroy'), {
    onFinish: () => {
      open.value = false
    },
  })
}
</script>

<template>
  <div class="rounded-2xl border border-red-500/30 bg-red-500/5 p-4">
    <h2 class="text-lg font-medium text-red-400">
      Danger zone
    </h2>

    <p class="mt-1 text-sm text-zinc-400">
      Permanently delete your account and all associated data.
    </p>

    <button @click="open = true"
      class="rounded-full mt-4 px-4 py-2 text-xs font-semibold transition disabled:opacity-60 disabled:cursor-not-allowed border border-red-500/50 bg-red-500/5 text-red-300 hover:bg-red-500/15 hover:border-red-400">
      Delete account
    </button>

    <ConfirmModal :open="open" title="Delete account" description="This action is permanent and cannot be undone."
      confirmText="Delete account" cancelText="Cancel" :danger="true" :loading="form.processing" @close="open = false"
      @confirm="confirmDelete">
      <p>
        All your polls, votes and personal data will be permanently removed.
      </p>
    </ConfirmModal>
  </div>
</template>
