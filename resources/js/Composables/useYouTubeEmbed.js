export const extractYouTubeId = (input) => {
  if (!input) return ''
  const url = String(input).trim()

  return (
    url.match(/[?&]v=([a-zA-Z0-9_-]{6,})/)?.[1] ||
    url.match(/youtu\.be\/([a-zA-Z0-9_-]{6,})/)?.[1] ||
    url.match(/youtube\.com\/embed\/([a-zA-Z0-9_-]{6,})/)?.[1] ||
    url.match(/youtube\.com\/shorts\/([a-zA-Z0-9_-]{6,})/)?.[1] ||
    ''
  )
}

export const toEmbedUrl = (input) => {
  const id = extractYouTubeId(input)
  if (!id) return ''

  const url = new URL(`https://www.youtube.com/embed/${id}`)

  url.searchParams.set('autoplay', '1')
  url.searchParams.set('controls', '0')
  url.searchParams.set('rel', '0')
  url.searchParams.set('modestbranding', '1')
  url.searchParams.set('playsinline', '1')
  url.searchParams.set('fs', '0')
  url.searchParams.set('disablekb', '1')

  return url.toString()
}
