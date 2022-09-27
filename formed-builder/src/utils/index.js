
const contentItemParams = { content: '' }
const normalInputParams = { label: '', placeholder: '', help: '', required: true }
const checkParams = { label: '', required: true, help: '', options: [] }
const scaleParams = { label: '', help: '', required: true, min: 0, max: 10, from_label: '', center_label: '', to_label: '' }

export const getDefaultItemParams = (type) => {
  let params = {}
  switch(type) {
    case 'h1':
    case 'h2':
    case 'rich_text':
      params = contentItemParams
      break
    case 'name':
      params = { ...normalInputParams, label: "What's your name?", placeholder: "Jane Doe" }
      break
    case 'email':
      params = { ...normalInputParams, label: "What's your email?", placeholder: "jane@example.com" }
      break
    case 'text':
    case 'textarea':
    case 'url':
      params = normalInputParams
      break
    case 'number':
      params = { ...normalInputParams, min: '', max: '' }
      break
    case 'hidden':
      params = { label: '', required: true }
      break
    case 'radio':
    case 'checkbox':
      params = JSON.parse(JSON.stringify(checkParams))
      break
    case 'scale':
      params = { ...scaleParams }
  }
  params.type = type
  return params
}

export function copyToClip(content) {
  if (navigator.clipboard) {
    navigator.clipboard.writeText(content)
  } else {
    const ipt = document.createElement('input')
    ipt.setAttribute('value', content)
    document.body.appendChild(ipt)
    ipt.select()
    document.execCommand('copy')
    document.body.removeChild(ipt)
  }
}
