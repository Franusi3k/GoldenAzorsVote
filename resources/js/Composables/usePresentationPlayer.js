import { computed, ref, watch, onBeforeUnmount, onMounted } from 'vue'

export function usePresentationPlayer({
  rounds = [],
} = {}) {
  const countdownSeconds = 5

  const slides = computed(() => {
    return (rounds || []).flatMap((round) => {
      const items = []

      items.push({
        type: 'round_intro',
        round,
      })

      for (const option of round.options || []) {
        items.push({
          type: 'option',
          round,
          option,
        })
      }

      items.push({
        type: 'countdown',
        round,
      })

      let winnerOption = null

      if (round.result?.winner_option_id) {
        winnerOption = round.options?.find(
          o => o.id === round.result.winner_option_id
        ) ?? null
      }

      items.push({
        type: 'winner',
        round,
        option: winnerOption,
      })

      return items
    })
  })

  const index = ref(0)

  const currentSlide = computed(
    () => slides.value[index.value] ?? null
  )

  const currentKey = computed(
    () => `${index.value}-${currentSlide.value?.type ?? 'none'}`
  )

  const goTo = (value) => {
    index.value = Math.min(
      slides.value.length - 1,
      Math.max(0, value)
    )
  }

  const next = () => goTo(index.value + 1)
  const prev = () => goTo(index.value - 1)

  const countdownValue = ref(null)
  let interval = null

  const clearTimers = () => {
    clearInterval(interval)
    interval = null
  }

  const startCountdown = (slideKey) => {
    countdownValue.value = countdownSeconds

    interval = setInterval(() => {
      if (currentKey.value !== slideKey) return

      countdownValue.value--

      if (countdownValue.value <= 0) {
        clearTimers()
        next()
      }
    }, 1000)
  }

  const schedule = () => {
    clearTimers()
    countdownValue.value = null

    if (currentSlide.value?.type === 'countdown') {
      startCountdown(currentKey.value)
    }
  }

  watch(currentKey, schedule, { immediate: true })

  const handleKeydown = (event) => {
    if (event.repeat) return

    switch (event.key) {
      case 'ArrowRight':
      case ' ':
        event.preventDefault()
        next()
        break

      case 'ArrowLeft':
        prev()
        break
    }
  }


  onMounted(() => {
    window.addEventListener('keydown', handleKeydown)
  })

  onBeforeUnmount(() => {
    window.removeEventListener('keydown', handleKeydown)
    clearTimers()
  })

  return {
    currentSlide,
    currentKey,
    countdownValue,

    next,
    prev,
    goTo,
  }
}
