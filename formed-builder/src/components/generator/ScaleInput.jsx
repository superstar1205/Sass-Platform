import { useState, useRef, useEffect } from 'react'
import BaseInput from './BaseInput'



function getBtns() {
  const arr = []
  for(let i = 0; i <= 10; i++) {
    arr.push({
      value: i,
      classList: 'bg-white',
      checked: true,
      clicked: false
    })
  }
  return arr
}

export default function(props) {

  const { item: scaleItem = {} } = props

  const [buttonList, setButtonList] = useState(getBtns())

  useEffect(() => {
    buttonList.forEach(btn => {
      if (btn.value < scaleItem.min || btn.value > scaleItem.max) {
        btn.classList = 'bg-white opacity-30 hover:opacity-100'
      }
    })
    setButtonList([...buttonList])
  }, [])

  const outerRef = useRef()
  
  const onButtonClick = (idx) => {
    const hasClicked = buttonList.map(ele => ele.clicked).includes(true)
    if (hasClicked) {
      const checkedList = buttonList.filter(ele => ele.checked).map(ele => ele.value)
      buttonList.forEach(ele => {
        if (ele.checked) {
          ele.classList = 'bg-white'
        } else {
          ele.classList = 'bg-white opacity-30 hover:opacity-100'
        }
        ele.clicked = false
      })
      props.onInputChange(Math.min(...checkedList), 'min')
      props.onInputChange(Math.max(...checkedList), 'max')
    } else {
      buttonList.forEach(ele => {
        if (ele.value === idx) {
          ele.clicked = true
          ele.classList = 'bg-blue-100'
          ele.checked = true
        } else {
          ele.classList = 'opacity-30'
          ele.checked = false
        }
      })
    }
    setButtonList([...buttonList])
  }
  const onButtonBlur = (e) => {
    const nextFocusDom = e.relatedTarget
    if (!(nextFocusDom && outerRef.current.contains(nextFocusDom))) {
      // 组件外部导致失焦
      buttonList.forEach(ele => {
        if (ele.value >= scaleItem.min && ele.value <= scaleItem.max) {
          ele.classList = 'bg-white'
        } else {
          ele.classList = 'bg-white opacity-30 hover:opacity-100'
        }
        ele.clicked = false
      })
      setButtonList([...buttonList])
    }
  }

  const onButtonOver = (idx) => {
    const clickedIdx = buttonList.map(ele => ele.clicked).indexOf(true)
    if (clickedIdx !== -1) {
      buttonList.forEach(ele => {
        if ((idx <= ele.value && ele.value <= clickedIdx) || (ele.value >= clickedIdx && ele.value <= idx)) {
          ele.classList = 'bg-blue-100'
          ele.checked = true
        } else {
          ele.classList = 'opacity-30'
          ele.checked = false
        }
      })
      setButtonList([...buttonList])
    }
  }


  return (
    <div onBlur={onButtonBlur} ref={outerRef}>
      <BaseInput
        item={scaleItem}
        onInputChange={props.onInputChange}
      >
        <div className="grid gap-1 grid-rows-[auto,1fr] md:gap-2 grid-cols-11">
          {
            buttonList.map(btn => {
              return (
                <button value={btn.value} key={btn.value}
                  className={`group aspect-w-1 aspect-h-1 focus:outline-none ${btn.classList}`}
                  onClick={(e) => { onButtonClick(btn.value, e) }}
                  onMouseEnter={() => { onButtonOver(btn.value) }}
                  
                >
                  <div
                    style={{'--theme-ring-default': 'transparent'}}
                    className="flex justify-center items-center theme-border theme-ring rounded cursor-pointer border">
                    <span className="font-medium text-gray-700">{btn.value}</span>
                  </div>
                </button>
              )
            })
          }
          <div className="row-start-2 col-span-11 grid grid-cols-3">
            <div className="flex justify-start">
              <p
                className="text-sm font-semibold text-gray-500 cursor-text focus:outline-none text-left"
                contentEditable
                suppressContentEditableWarning
                onBlur={(e) => { props.onInputChange(e.target.textContent, 'from_label') }}
                data-placeholder="Add label"
              >
                {scaleItem.from_label}
              </p>
            </div>
            <div className="flex justify-center">
              <p
                className="text-sm font-semibold text-gray-500 cursor-text focus:outline-none text-center"
                contentEditable
                suppressContentEditableWarning
                onBlur={(e) => { props.onInputChange(e.target.textContent, 'center_label') }}
                data-placeholder="Add label"
              >
                {scaleItem.center_label}
              </p>
            </div>
            <div className="flex justify-end">
              <p
                className="text-sm font-semibold text-gray-500 cursor-text focus:outline-none text-right"
                contentEditable
                suppressContentEditableWarning
                data-placeholder="Add label"
                onBlur={(e) => { props.onInputChange(e.target.textContent, 'to_label') }}
              >
                {scaleItem.to_label}
              </p>
            </div>
          </div>
        </div>
      </BaseInput>
    </div>
  )
}