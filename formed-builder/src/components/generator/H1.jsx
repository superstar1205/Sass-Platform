import { useRef } from 'react'

export default function(props) {

  const onContentBlur = (e) => {
    props.onInputChange(e.target.textContent, 'content')
  }

  return (
    <h1
      onBlur={onContentBlur}
      contentEditable
      suppressContentEditableWarning
      data-placeholder="Enter a form heading"
      className="font-bold text-3xl cursor-text tracking-tight text-gray-900 focus:outline-none"
    >{props.item.content}</h1>
  )
}