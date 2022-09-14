import DraggerIcon from '@/Components/SvgIcon/DragIcon'
import SettingIcon from '@/Components/SvgIcon/SettingIcon'
import { useState, useRef } from 'react'
import ItemSetting from '@/dialog/ItemSetting'
import { Draggable } from 'react-beautiful-dnd'

export default function(props) {

  const { index, formItem = {}, length, showInput = true, dragging } = props

  const [settingOpen, setSettingOpen] = useState(false)

  const rootRef = useRef()

  const onHelpTextFocus = () => {
    const helpText = rootRef.current.querySelector('.help-text')
    if (helpText) {
      helpText.focus()
    }
  }

  const onOpenChange = (e) => {
    setSettingOpen(e)
  }


  return (
    <Draggable draggableId={`item-${formItem.id}`} index={index}>
      {
        (provided, snapshot) => (
          <div
            className={`relative group isolate ${formItem.type} ${snapshot.isDragging ? 'dragging' : ''} ${settingOpen ? 'settings-open' : ''}`}
            {...provided.draggableProps}
            ref={provided.innerRef}
          >
            <div className='relative' ref={rootRef}>
              <div
                className={`bg-box absolute rounded-md group-dragging:bg-gray-100 -top-4 -right-4 -bottom-4
                  -left-20 -z-1 ${dragging ? '' : 'group-hover:bg-gray-100'} group-focus-within:bg-gray-100
                  group-settings-open:bg-gray-100`}
              ></div>
              <nav
                className={`hidden absolute space-x-1 -ml-6 sm:-ml-15 left-0 top-1/2 transform -translate-y-1/2 flex-col
                  sm:flex-row
                  group-dragging:flex group-focus-within:flex ${dragging ? '' : 'group-hover:flex'}
                  group-settings-open:flex`}
              >
                <button
                  {...provided.dragHandleProps}
                  className="flex justify-center w-6 h-6 rounded foucs:ring-2 focus:outline-none">
                  <DraggerIcon classList="block h-6 text-gray-400" />
                </button>
                {/* setting */}
                <ItemSetting
                  formItem={formItem}
                  length={length}
                  index={index}
                  showInput={showInput}
                  onInputChange={(value, prop) => { props.onInputChange(value, prop) }}
                  onUpdateOrAddItem={(name, oType) => { props.onAddFormItem(name, oType, index) }}
                  onDeleteItem={() => props.onDeleteItem(index)}
                  onHelpTextFocus={onHelpTextFocus}
                  onItemMove={(step) => { props.onItemMove(index, step) }}
                  onOpenChange={onOpenChange}
                >
                  <button
                    className="flex justify-center w-6 h-6 rounded focus:ring-2 focus:outline-none"
                  >
                    <SettingIcon classList="block h-6 text-gray-400" />
                  </button>
                </ItemSetting>
              </nav>
              { props.children }
            </div>
          </div>
        )
      }
    </Draggable>
  )
}
