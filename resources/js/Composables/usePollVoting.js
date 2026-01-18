import { computed, ref, onMounted, onUnmounted } from "vue";
import { router } from "@inertiajs/vue3";

export function usePollVoting(poll, options = {}) {
  const { hasVoted = false } = options;

  function parseDate(v) {
    if (!v) return null;
    const d = new Date(v);
    return Number.isNaN(d.getTime()) ? null : d;
  }

  const endsAt = computed(() =>
    parseDate(poll.closes_at ?? poll.ends_at ?? null)
  );

  const now = ref(Date.now());
  let timer = null;

  onMounted(() => {
    timer = setInterval(() => (now.value = Date.now()), 1000);
  });

  onUnmounted(() => {
    if (timer) clearInterval(timer);
  });

  const msLeft = computed(() => {
    if (!endsAt.value) return null;
    return Math.max(0, endsAt.value.getTime() - now.value);
  });

  const isEnded = computed(() => msLeft.value !== null && msLeft.value <= 0);

  function formatCountdown(ms) {
    if (ms === null) return null;

    const totalSeconds = Math.floor(ms / 1000);
    const days = Math.floor(totalSeconds / 86400);
    const hours = Math.floor((totalSeconds % 86400) / 3600);
    const minutes = Math.floor((totalSeconds % 3600) / 60);
    const seconds = totalSeconds % 60;

    const pad = (n) => String(n).padStart(2, "0");

    return days > 0
      ? `${days}d ${pad(hours)}:${pad(minutes)}:${pad(seconds)}`
      : `${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
  }

  const topRightLabel = computed(() => {
    if (!endsAt.value) return null;
    return isEnded.value
      ? "Ended"
      : `Ends in ${formatCountdown(msLeft.value)}`;
  });

  const step = ref(hasVoted ? "done" : "intro");

  const rounds = computed(() =>
    (poll.rounds ?? [])
      .slice()
      .sort((a, b) => (a.position ?? 0) - (b.position ?? 0))
  );

  const currentRoundIndex = ref(0);
  const currentRound = computed(
    () => rounds.value[currentRoundIndex.value] ?? null
  );

  const isFirstRound = computed(() => currentRoundIndex.value <= 0);
  const isLastRound = computed(() => {
    if (!rounds.value.length) return true;
    return currentRoundIndex.value >= rounds.value.length - 1;
  });

  const votesByRound = ref({});
  const playingId = ref(null);
  const lastNav = ref("next");

  function roundKey(round) {
    return round?.id != null ? String(round.id) : null;
  }

  const selectedIds = computed({
    get() {
      const key = roundKey(currentRound.value);
      return key ? votesByRound.value[key]?.ids ?? [] : [];
    },
    set(ids) {
      const key = roundKey(currentRound.value);
      if (!key) return;

      votesByRound.value = {
        ...votesByRound.value,
        [key]: { type: "vote", ids: Array.isArray(ids) ? ids : [] },
      };
    },
  });

  function skipCurrentRound() {
    const key = roundKey(currentRound.value);
    if (!key) return;

    votesByRound.value = {
      ...votesByRound.value,
      [key]: { type: "skip", ids: [] },
    };
  }

  function startVoting() {
    if (hasVoted || isEnded.value) return;
    step.value = rounds.value.length ? "vote" : "done";
  }

  function nextRound() {
    playingId.value = null;

    if (isLastRound.value) {
      submitVotes();
      return;
    }

    currentRoundIndex.value++;
  }

  function prevRound() {
    playingId.value = null;
    if (!isFirstRound.value) {
      currentRoundIndex.value--;
    }
  }

  function confirmRound() {
    lastNav.value = "next";
    nextRound();
  }

  function skipRound() {
    lastNav.value = "next";
    skipCurrentRound();
    nextRound();
  }
  const isSubmitting = ref(false);

  function submitVotes() {
    if (isSubmitting.value) return;

    isSubmitting.value = true;

    router.post(
      route("#", poll.id),
      {
        votes: votesByRound.value,
      },
      {
        preserveScroll: true,

        onSuccess: () => {
          step.value = "done";
        },

        onFinish: () => {
          isSubmitting.value = false;
        },
      }
    );
  }


  const transitionName = computed(() => {
    if (step.value !== "vote") return "fadeSlide";
    return lastNav.value === "prev" ? "roundBack" : "round";
  });

  return {
    step,
    rounds,
    currentRound,
    currentRoundIndex,
    selectedIds,
    playingId,

    isEnded,
    isFirstRound,
    isLastRound,
    topRightLabel,

    startVoting,
    confirmRound,
    skipRound,
    prevRound,

    transitionName,

    votesByRound,
  };
}
