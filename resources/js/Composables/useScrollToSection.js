export function useScrollToSection(defaultOffset = 0) {
  const scrollToSection = (id, customOffset = null) => {
    const el = document.getElementById(id)
    if (!el) return

    const rect = el.getBoundingClientRect()
    const scrollTop = window.scrollY || window.pageYOffset

    const elementCenter = rect.top + scrollTop + rect.height / 2

    const viewportCenter = window.innerHeight / 2

    const offset = customOffset ?? defaultOffset

    const targetScroll = elementCenter - viewportCenter + offset

    window.scrollTo({
      top: targetScroll,
      behavior: 'smooth',
    })
  }
  return { scrollToSection }
}
