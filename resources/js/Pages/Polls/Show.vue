<script setup>
import { Head } from "@inertiajs/vue3";
import { computed } from "vue";
import PollLayout from "@/Layouts/PollLayout.vue";
import VoteIntro from "@/Components/Polls/VoteIntro.vue";
import VoteRound from "@/Components/Polls/VoteRound.vue";
import VoteComplete from "@/Components/Polls/VoteComplete.vue";
import { usePollVoting } from "@/Composables/usePollVoting";

const props = defineProps({
  poll: {
    type: Object,
    required: true,
  },
  hasVoted: {
    type: Boolean,
    required: true,
    default: false
  },
});

const voting = usePollVoting(props.poll, {
  hasVoted: props.hasVoted,
});

const currentComponent = computed(() => {
  if (voting.step.value === "intro") return VoteIntro;
  if (voting.step.value === "vote") return VoteRound;
  return VoteComplete;
});

const componentKey = computed(() => {
  if (voting.step.value === "intro") return "intro";
  if (voting.step.value === "vote")
    return `round-${voting.currentRound.value?.id}`;
  return "done";
});

const componentProps = computed(() => {
  if (voting.step.value === "intro") {
    return {
      name: props.poll.name,
      description: props.poll.description,
      disabled: voting.isEnded.value,
    };
  }

  if (voting.step.value === "vote") {
    return {
      round: voting.currentRound.value,
      isFirst: voting.isFirstRound.value,
      isLast: voting.isLastRound.value,
      selectedIds: voting.selectedIds.value,
      playingId: voting.playingId.value,
    };
  }

  return {};
});

const componentListeners = computed(() => {
  if (voting.step.value === "intro") {
    return {
      start: voting.startVoting,
    };
  }

  if (voting.step.value === "vote") {
    return {
      "update:selectedIds": (v) => (voting.selectedIds.value = v),
      "update:playingId": (v) => (voting.playingId.value = v),
      confirm: voting.confirmRound,
      skip: voting.skipRound,
      prev: voting.prevRound,
    };
  }

  return {};
});
</script>

<template>
  <PollLayout>

    <Head :title="poll.name" />

    <div class="flex justify-end mb-4">
      <div v-if="voting.topRightLabel" class="rounded-full border border-zinc-800 bg-zinc-950/60 px-3 py-1.5
               text-[11px] font-semibold text-zinc-200 backdrop-blur">
        {{ voting.topRightLabel }}
      </div>
    </div>

    <div class="flex items-center justify-center min-h-[62vh]">
      <div class="w-full max-w-6xl">
        <Transition :name="voting.transitionName.value" mode="out-in">
          <component :is="currentComponent" :key="componentKey" v-bind="componentProps" v-on="componentListeners" />
        </Transition>
      </div>
    </div>
  </PollLayout>
</template>


<style scoped>
.fadeSlide-enter-active,
.fadeSlide-leave-active {
  transition: opacity 220ms ease, transform 220ms ease;
}

.fadeSlide-enter-from {
  opacity: 0;
  transform: translateY(10px);
}

.fadeSlide-leave-to {
  opacity: 0;
  transform: translateY(-8px);
}

.round-enter-active,
.round-leave-active,
.roundBack-enter-active,
.roundBack-leave-active {
  transition: opacity 260ms ease, transform 260ms ease;
}

.round-enter-from {
  opacity: 0;
  transform: translateY(12px);
}

.round-leave-to {
  opacity: 0;
  transform: translateY(-12px);
}

.roundBack-enter-from {
  opacity: 0;
  transform: translateY(-12px);
}

.roundBack-leave-to {
  opacity: 0;
  transform: translateY(12px);
}
</style>
