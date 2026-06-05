export function formatDate(value) {
  if (!value) {
    return 'Еще не проверялся'
  }

  return new Intl.DateTimeFormat('ru-RU', {
    dateStyle: 'short',
    timeStyle: 'medium',
  }).format(new Date(value))
}
