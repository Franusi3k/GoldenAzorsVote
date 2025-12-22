import { ref, onMounted, onBeforeUnmount } from 'vue'

export function useScrollSpy(sectionIds) {
  const activeSection = ref(sectionIds[0] ?? null)

  const onScroll = () => {
    const scrollTop = window.scrollY || window.pageYOffset

    if (scrollTop < 50) {
      activeSection.value = sectionIds[0] || null
      return
    }

    const midpoint = window.innerHeight / 2

    for (const id of sectionIds) {
      const el = document.getElementById(id)
      if (!el) continue

      const rect = el.getBoundingClientRect()

      if (rect.top <= midpoint && rect.bottom >= midpoint) {
        activeSection.value = id
        return
      }
    }
  }

  onMounted(() => {
    onScroll()
    window.addEventListener('scroll', onScroll, { passive: true })
  })

  onBeforeUnmount(() => {
    window.removeEventListener('scroll', onScroll)
  })

  return { activeSection }
}
