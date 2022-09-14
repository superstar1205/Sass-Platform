
export default function(props) {

  const onContentBlur = (e) => {
    props.onInputChange(e.target.textContent, 'content')
  }

  return (
    <h2
      onBlur={onContentBlur}
      contentEditable
      suppressContentEditableWarning
      data-placeholder="Enter a subheading"
      className="font-bold text-2xl cursor-text tracking-tight text-gray-900 focus:outline-none"
    >{props.item.content}</h2>
  )
}