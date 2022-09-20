
export default function(props) {

  const onContentBlur = (e) => {
    props.onInputChange(e.target.textContent, 'content')
  }

  return (
    <div
      onBlur={onContentBlur}
      contentEditable
      suppressContentEditableWarning
      className="text-lg cursor-text tracking-tight focus:outline-none leading-snug"
    >
      <p
        data-placeholder="This is a Text block where you can add text paragraphs, bullet lists, and links."
        className={props.item.content ? '' : 'is-editor-empty'}
      >{props.item.content}</p>
    </div>
  )
}