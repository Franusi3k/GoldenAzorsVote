import { computed, unref } from 'vue'

export function useDateTime(value) {
  const dateObject = computed(() => {
    const raw = unref(value)
    if (!raw) return null

    const d = raw instanceof Date ? raw : new Date(raw)
    return isNaN(d.getTime()) ? null : d
  })

  const date = computed(() =>
    dateObject.value
      ? new Intl.DateTimeFormat('pl-PL', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
      }).format(dateObject.value)
      : ''
  )

  const dateLong = computed(() =>
    dateObject.value
      ? new Intl.DateTimeFormat('pl-PL', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
      }).format(dateObject.value)
      : ''
  )

  const time = computed(() =>
    dateObject.value
      ? new Intl.DateTimeFormat('pl-PL', {
        hour: '2-digit',
        minute: '2-digit',
      }).format(dateObject.value)
      : ''
  )

  const dateTime = computed(() =>
    dateObject.value
      ? new Intl.DateTimeFormat('pl-PL', {
        dateStyle: 'short',
        timeStyle: 'short',
      }).format(dateObject.value)
      : ''
  )

  const dateTimeLong = computed(() =>
    dateObject.value
      ? new Intl.DateTimeFormat('pl-PL', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
      }).format(dateObject.value)
      : ''
  )

  const relative = computed(() => {
    if (!dateObject.value) return ''

    const diff = dateObject.value - new Date()
    const rtf = new Intl.RelativeTimeFormat('pl', { numeric: 'auto' })

    const minutes = Math.round(diff / 60000)
    const hours = Math.round(diff / 3600000)
    const days = Math.round(diff / 86400000)

    if (Math.abs(minutes) < 60) return rtf.format(minutes, 'minute')
    if (Math.abs(hours) < 24) return rtf.format(hours, 'hour')
    return rtf.format(days, 'day')
  })

  return {
    dateObject,
    date,
    dateLong,
    time,
    dateTime,
    dateTimeLong,
    relative,
  }
}
