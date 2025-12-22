<template>
  <GuestLayout>
    <LandingHero />
    <LandingHowItWorks />
    <LandingRoles />
    <LandingDemo />
    <LandingTech />
    <LandingCta />
  </GuestLayout>
</template>

<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import LandingHero from "@/Components/Landing/LandingHero.vue";
import LandingHowItWorks from "@/Components/Landing/LandingHowItWorks.vue";
import LandingRoles from "@/Components/Landing/LandingRoles.vue";
import LandingDemo from "@/Components/Landing/LandingDemo.vue";
import LandingTech from "@/Components/Landing/LandingTech.vue";
import LandingCta from "@/Components/Landing/LandingCta.vue";
</script>
