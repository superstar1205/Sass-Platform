import { useState, useRef } from 'react'

export default function(props) {

  const { item = {} } = props

  const helpTextEl = useRef(null)
  
  const textClass = item.help ? 'focus-within:not-sr-only' : 'focus-within:not-sr-only sr-only'

  const [helpTextClass, setHelpTextClass] = useState(textClass)
  const onHelpTextBlur = (e) => {
    if (e.target.textContent) {
      setHelpTextClass('focus-within:not-sr-only')
    } else {
      setHelpTextClass('focus-within:not-sr-only sr-only')
    }
    props.onInputChange(e.target.textContent, 'help')
  }

  return (
    <div className="relative">
      <div className='mb-3'>
        <div className="flex">
          <label
            onBlur={(e) => { props.onInputChange(e.target.textContent, 'label') }}
            contentEditable
            suppressContentEditableWarning
            data-placeholder="Enter a question"
            className="text-lg font-semibold text-gray-600 leading-snug tracking-tight cursor-text focus:outline-none"
          >{item.label}</label>
          <span className="inline-block w-1" />
          {
            item.required && (
              <span className="text-gray-500">*</span>
            )
          }
        </div>
        <div className={helpTextClass} ref={helpTextEl}>
          <div>
            <div
              contentEditable
              suppressContentEditableWarning
              tabIndex="0"
              onBlur={onHelpTextBlur}
              className="help-text cursor-text focus:outline-none"
            >
              <p
                data-placeholder="Write a help text"
                className="is-empty"
              >{item.help}</p>
            </div>
          </div>
        </div>
      </div>
      { props.children }
    </div>
  )
}