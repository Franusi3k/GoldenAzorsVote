<script setup>
import { computed } from 'vue'

const props = defineProps({
  round: { type: Object, required: true },
  value: { type: Number, default: null },
})

const display = computed(() => String(props.value ?? ''))
</script>

<template>
  <div class="w-full h-full flex items-center justify-center">
    <div class="text-center">
      <div class="text-[11px] uppercase tracking-[0.3em] text-zinc-500">
        {{ round.title }}
      </div>
      <div class="mt-4 text-2xl md:text-3xl font-semibold text-zinc-200">
        And the winner is…
      </div>

      <div class="mt-6">
        <div class="text-7xl md:text-9xl font-extrabold tracking-tight"
          style="text-shadow: 0 0 30px rgba(16,185,129,0.18);">
          <Transition name="count" mode="out-in">
            <span :key="display">{{ display }}</span>
          </Transition>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.count-enter-active,
.count-leave-active {
  transition: opacity 220ms ease, transform 220ms ease, filter 220ms ease;
}

.count-enter-from {
  opacity: 0;
  transform: scale(1.08);
  filter: blur(8px);
}

.count-leave-to {
  opacity: 0;
  transform: scale(0.92);
  filter: blur(8px);
}
</style>
