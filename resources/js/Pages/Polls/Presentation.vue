<script setup>
import { Head, Link } from '@inertiajs/vue3'

import SlideRoundIntro from '@/Components/Presentation/SlideRoundIntro.vue'
import SlideCountdown from '@/Components/Presentation/SlideCountdown.vue'
import SlideOption from '@/Components/Presentation/SlideOption.vue'
import SlideWinner from '@/Components/Presentation/SlideWinner.vue'

import { usePresentationPlayer } from '@/Composables/usePresentationPlayer'

const props = defineProps({
  poll: {
    type: Object,
    required: true,
  },
})
const {
  currentSlide,
  currentKey,
  countdownValue,
} = usePresentationPlayer({
  rounds: props.poll.rounds,
})

</script>

<template>

  <Head :title="`${poll.name} – Presentation | GoldenAzorsVote`" />

  <div class="fixed inset-0 bg-zinc-950 text-zinc-50 overflow-hidden">
    <div class="pointer-events-none fixed inset-0">
      <div class="absolute -top-40 left-20 h-80 w-80 rounded-full bg-emerald-500/10 blur-3xl" />
      <div class="absolute -bottom-40 right-20 h-96 w-96 rounded-full bg-amber-500/10 blur-3xl" />
    </div>

    <div class="absolute top-4 left-4 z-30">
      <Link href="#"
        class="rounded-full border border-zinc-700 bg-zinc-900/80 px-3 py-1 text-[11px] text-zinc-200 transition hover:border-emerald-400 hover:text-emerald-300">
        Exit
      </Link>
    </div>

    <div class="relative z-10 flex h-full w-full items-center justify-center px-6 py-8">
      <Transition name="slidefade" mode="out-in">
        <div :key="currentKey" class="flex h-full w-full items-center justify-center">
          <SlideRoundIntro v-if="currentSlide?.type === 'round_intro'" :poll="poll" :round="currentSlide.round" />

          <SlideCountdown v-else-if="currentSlide?.type === 'countdown'" :round="currentSlide.round"
            :value="countdownValue" />

          <SlideOption v-else-if="currentSlide?.type === 'option'" :round="currentSlide.round"
            :option="currentSlide.option" />

          <SlideWinner v-else-if="currentSlide?.type === 'winner'" :round="currentSlide.round"
            :option="currentSlide.option" />

          <div v-else class="text-center">
            <p class="text-2xl font-semibold text-zinc-400">No slides available</p>
          </div>
        </div>
      </Transition>
    </div>
  </div>
</template>

<style>
.slidefade-enter-active,
.slidefade-leave-active {
  transition: opacity 350ms ease, transform 350ms ease, filter 350ms ease;
}

.slidefade-enter-from {
  opacity: 0;
  transform: translateY(10px) scale(0.99);
  filter: blur(6px);
}

.slidefade-leave-to {
  opacity: 0;
  transform: translateY(-10px) scale(0.99);
  filter: blur(6px);
}
</style>
