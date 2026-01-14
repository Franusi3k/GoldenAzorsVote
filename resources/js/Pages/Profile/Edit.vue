<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import AdminLayout from '@/Layouts/AdminLayout.vue'
import ProfileInfoForm from '@/Components/Profile/ProfileInfoForm.vue'
import PasswordForm from '@/Components/Profile/PasswordForm.vue'
import { Head, usePage } from '@inertiajs/vue3'
import HeaderSection from '@/Components/Common/HeaderSection.vue'
import DangerZone from '@/Components/Profile/DangerZone.vue'

const page = usePage()
const user = page.props.auth.user

</script>

<template>
  <component :is="user.roles.some(role => role.name === 'admin') ? AdminLayout : AuthenticatedLayout">

    <Head title="Account Settings – GoldenAzorsVote" />

    <template v-slot:title>
      Account Settings
    </template>

    <div class="space-y-6">
      <HeaderSection subtitle="Account" title="Your profile settings"
        description="Manage your personal information, security settings and account preferences." />

      <ProfileInfoForm />
      <PasswordForm />
      <DangerZone />
    </div>
  </component>
</template>
