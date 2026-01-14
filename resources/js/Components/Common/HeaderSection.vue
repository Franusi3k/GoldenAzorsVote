<template>
  <section
    class="rounded-3xl border border-zinc-800 px-4 py-4 md:px-6 md:py-5">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">

      <div class="space-y-1">
        <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-emerald-400">
          {{ subtitle }}
        </p>
        <h2 class="text-sm md:text-base font-semibold text-zinc-50">
          {{ title }}
        </h2>
        <p class="mt-1 text-[11px] text-zinc-400 max-w-md">
          {{ description }}
        </p>
      </div>
      <slot />
    </div>
  </section>
</template>

<script setup>
defineProps({
  subtitle: { type: String, required: true },
  title: { type: String, required: true },
  description: { type: String, required: true },
})
</script>
