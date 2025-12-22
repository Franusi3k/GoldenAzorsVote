<template>
  <div class="min-h-screen bg-zinc-950 text-zinc-50">
    <LandingNavbar />

    <main>
      <slot />
    </main>

    <LandingFooter />
  </div>
</template>

<script setup>
import LandingNavbar from '@/Components/Landing/LandingNavbar.vue'
import LandingFooter from '@/Components/Landing/LandingFooter.vue'
</script>
