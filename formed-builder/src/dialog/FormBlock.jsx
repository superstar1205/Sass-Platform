import { useState } from 'react'
import H1Icon from '@/components/SvgIcon/H1Icon'
import H2Icon from '@/components/SvgIcon/H2Icon'
import TextIcon from '@/components/SvgIcon/TextIcon'
import NameIcon from '@/components/SvgIcon/NameIcon'
import EmailIcon from '@/components/SvgIcon/EmailIcon'
import ShortTextIcon from '@/components/SvgIcon/ShortTextIcon'
import LongTextIcon from '@/components/SvgIcon/LongTextIcon'
import NumberIcon from '@/components/SvgIcon/NumberIcon'
import UrlIcon from '@/components/SvgIcon/UrlIcon'
import HiddenIcon from '@/components/SvgIcon/HiddenIcon'
import RadioIcon from '@/components/SvgIcon/RadioIcon'
import CheckboxIcon from '@/components/SvgIcon/CheckboxIcon'
import ScaleIcon from '@/components/SvgIcon/ScaleIcon'
import * as DropdownMenu  from '@radix-ui/react-dropdown-menu'

const iconList = {
  h1: H1Icon,
  h2: H2Icon,
  text: TextIcon,
  name: NameIcon,
  email: EmailIcon,
  shortText: ShortTextIcon,
  longText: LongTextIcon,
  number: NumberIcon,
  url: UrlIcon,
  hidden: HiddenIcon,
  radio: RadioIcon,
  checkbox: CheckboxIcon,
  scale: ScaleIcon
}

const ContentList = [
  {
    name: 'Heading 1',
    icon: 'h1',
    type: 'h1'
  },
  {
    name: 'Heading 2',
    icon: 'h2',
    type: 'h2'
  },
  {
    name: 'Text',
    icon: 'text',
    type: 'rich_text'
  },
]

const InputList = [
  {
    name: 'Name',
    icon: 'name',
    type: 'name'
  },
  {
    name: 'Email',
    icon: 'email',
    type: 'email'
  },
  {
    name: 'Short text',
    icon: 'shortText',
    type: 'text'
  },
  {
    name: 'Long text',
    icon: 'longText',
    type: 'textarea'
  },
  {
    name: 'Number',
    icon: 'number',
    type: 'number'
  },
  {
    name: 'URL',
    icon: 'url',
    type: 'url'
  },
  {
    name: 'Hidden',
    icon: 'hidden',
    type: 'hidden'
  },
  {
    name: 'Select one',
    icon: 'radio',
    type: 'radio'
  },
  {
    name: 'Select multiple',
    icon: 'checkbox',
    type: 'checkbox'
  },
  // {
  //   name: 'Scale',
  //   icon: 'scale',
  //   type: 'scale'
  // }
]

function Icon({ icon }) {
  const Icon = iconList[icon]
  if (!Icon) return null
  return <Icon classList="w-7 h-7 text-gray-700" />  
}


export default function(props) {
  const { nested, type, itemType, showInput = true } = props

  // 选择表单组件
  const onItem = (name) => {
    switch(type) {
      case 'add':
        props.onAddFormItem(name)
        break
      case 'update':
        props.onUpdateFormItem(name)
        break
      case 'add_above':
        props.onAddItemAbove(name)
        break
      case 'add_below':
        props.onAddItemBelow(name)
        break
    }
  }

  return (
    <DropdownMenu.Root>
      {
        nested ? (
          <DropdownMenu.TriggerItem asChild>
            { props.children }
          </DropdownMenu.TriggerItem>
        ) : (
            <DropdownMenu.Trigger asChild>
            { props.children }
          </DropdownMenu.Trigger>
        )
      }
      <DropdownMenu.Content
        sideOffset={nested ? 0 : 15}
        className="w-base rounded bg-white shadow-lg border border-gray-50 focus:outline-none">
        <div className={`p-4 ${showInput ? 'border-gray-100 border-b' : ''}`}>
          <h3 className="text-xs text-gray-500 font-medium mb-2">Content</h3>
          <div className="grid grid-cols-4 gap-4 m-3">
            {
              ContentList.map(item => {
                return (
                  <DropdownMenu.Item asChild key={item.type}>
                    <div
                      tabIndex="-1"
                      onClick={() => { onItem(item.type) }}
                      className={`relative aspect-w-1 aspect-h-1 rounded 
                        cursor-pointer focus:outline-none 
                        focus:bg-gray-100 hover:bg-gray-100 ${itemType === item.type ? 'bg-gray-100' : ''}`}
                    >
                      <div className="flex flex-col justify-center items-center rounded space-y-3">
                        <Icon icon={item.icon} />
                        <div className="text-sm text-center font-medium text-gray-900">{item.name}</div>
                      </div>
                    </div>
                  </DropdownMenu.Item>
                )
              })
            }
          </div>
        </div>
        {
          showInput && (
            <div className="p-4">
              <h3 className="text-xs text-gray-500 font-medium mb-2">Input</h3>
              <div className="grid grid-cols-4 gap-4 m-3">
                {
                  InputList.map(item => {
                    return (
                      <DropdownMenu.Item key={item.name} asChild>
                        <div
                          tabIndex="-1"
                          onClick={() => { onItem(item.type) }}
                          className={`relative aspect-w-1 aspect-h-1 rounded 
                            cursor-pointer focus:outline-none 
                            focus:bg-gray-100 hover:bg-gray-100 ${itemType === item.type ? 'bg-gray-100' : ''}`}
                        >
                          <div className="flex flex-col justify-center items-center rounded space-y-3">
                            <Icon icon={item.icon} />
                            <div className="text-sm text-center font-medium text-gray-900">{item.name}</div>
                          </div>
                        </div>
                      </DropdownMenu.Item>
                    )
                  })
                }
              </div>
            </div>
          )
        }
      </DropdownMenu.Content>
    </DropdownMenu.Root>
  )
}