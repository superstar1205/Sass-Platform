import {useEffect, useState} from 'react'
import AddIcon from '@/components/SvgIcon/AddIcon'
import SeetingIcon from '@/components/SvgIcon/SettingIcon'
import FormSetting from '@/components/FormSetting'
import FormBlock from '@/dialog/FormBlock'
import FormItem from '@/components/generator'
import FormItemBase from '@/components/generator/Base'
import PageSetting from '@/dialog/PageSetting'
import ThanksPageSetting from '@/dialog/ThanksPageSetting'
import getUUID from '@/utils/uuid'
import {getDefaultItemParams } from '@/utils'
import { DragDropContext, Droppable } from 'react-beautiful-dnd'
import './Builder.css'
import axios from 'axios';

function getDefaultPage() {
  return {
    id: getUUID(),
    button: 'Submit',
    blocks: [
      {
        id: getUUID(),
        type: 'h1',
        content: ''
      }
    ]
  }
}

function getDefaultThanksPage() {
  return {
    blocks: [
      { id: getUUID(), content: 'All done. Thank you!', type: 'h1' },
      { id: getUUID(), content: 'Thank you for taking the time to complete the form!', type: 'rich_text' },
      { id: getUUID(), content: 'Your submission has been recorded successfully.', type: 'rich_text' },
    ],
    redirect: false
  }
}

function  getDefaultBuildJson() {
  return window?.editform?.meta_data ? JSON.stringify(window?.editform?.meta_data) :  '';
}

export default function() {

  const [form, setForm] = useState({
    id: getUUID(),
    name: 'Untitled form',
    slug: 'untitled-form',
    redirect: '',
    branding: {
      primary_color: '#212129',
      button: '#FFFFFF',
      logo: '',
      logoSize: 'small'
    }
  })

  useEffect(
      function (){
            build(buildJson);
      },
      [buildJson]
  )

  const [pageList, setPageList] = useState([getDefaultPage()])

  const [thanksPage, setThanksPage] = useState(getDefaultThanksPage())

  const [dragging, setDragging] = useState(false)

  const [buildJson, setBuildJson] = useState(getDefaultBuildJson())

  const [settingShow, setSettingShow] = useState(false)

  // 添加、复制、替换一个表单组件
  const onUpdateOrAddItem = (name, type, idx, pIdx, isThanks = false) => {
    const params = { ...getDefaultItemParams(name) }
    if (name === 'radio' || name === 'checkbox') {
      params.options.push({
        id: getUUID(),
        value: ''
      })
    }
    const pItem = isThanks ? thanksPage : pageList[pIdx]
    if (type === 'update') {
      // 替换
      const formItem = pItem.blocks[idx]
      if (formItem.type !== name) {
        for (const key in formItem) {
          if (Object.hasOwnProperty.call(formItem, key) && Object.hasOwnProperty.call(params, key) && key !== 'type') {
            params[key] = formItem[key]
          }
        }
        params.id = formItem.id
        pItem.blocks[idx] = params
      }
    } else {
      // 添加
      params.id = getUUID()
      switch(type) {
        case 'add_above':
          pItem.blocks.splice(idx, 0, params)
          break
        case 'add_below':
        case 'copy':
          pItem.blocks.splice(idx + 1, 0, params)
          break
        default:
          pItem.blocks.push(params)
          break
      }
    }
    if (isThanks) {
      setThanksPage({ ...thanksPage })
    } else {
      setPageList([...pageList])
    }
  }

  // 删除一个表单组件
  const onDeleteFormItem = (idx, pIdx, isThanks = false) => {
    if (isThanks) {
      thanksPage.blocks.splice(idx, 1)
      setThanksPage({ ...thanksPage })
    } else {
      pageList[pIdx].blocks.splice(idx, 1)
      setPageList([...pageList])
    }
  }

  // 修改表单元素值
  const onValueChange = (value, prop, idx, pIdx, isThanks = false) => {
    const pItem = isThanks ? thanksPage : pageList[pIdx]
    const formItem = pItem.blocks[idx]
    formItem[prop] = value
    if (isThanks) {
      setThanksPage({ ...thanksPage })
    } else {
      setPageList([...pageList])
    }
  }

  // radio、checkbox 增加一个选项
  const onItemOption = (idx, oIdx, type, pIdx) => {
    if (type === 'add') {
      const option = {
        id: getUUID(),
        value: ''
      }
      pageList[pIdx].blocks[idx].options.splice(oIdx + 1, 0, option)
    } else if (type === 'delete') {
      pageList[pIdx].blocks[idx].options.splice(oIdx, 1)
    }
    setPageList([...pageList])
  }

  // radio checkbox value
  const onItemOptionValue = (idx, oIdx, pIdx, e) => {
    const option = pageList[pIdx].blocks[idx].options[oIdx]
    option.value = e.target.textContent
    setPageList([...pageList])
  }

  // 点击移动元素
  const onItemMove = (idx, step, pIdx, isThanks = false) => {
    const pItem = isThanks ? thanksPage : pageList[pIdx]
    const item = pItem.blocks.splice(idx, 1)[0]
    pItem.blocks.splice(idx + step, 0, item)
    if (isThanks) {
      setThanksPage({ ...thanksPage })
    } else {
      setPageList([...pageList])
    }
  }

  // Add or delete page
  const onUpdatePages = (type, idx) => {
    if (type === 'add') {
      const params = getDefaultPage()
      pageList.push(params)
      setPageList([...pageList])
    } else if (type === 'delete') {
      pageList.splice(idx, 1)
      setPageList([...pageList])
    }
  }

  // 拖拽排序
  const onDragEnd = (e) => {
    const {source, destination} = e
    if (source && destination) {
      let sPage = 0
      let dPage = 0
      if (source.droppableId !== 'thank_you_page' && destination.droppableId !== 'thank_you_page') {
        pageList.forEach((page, idx) => {
          if (page.id === source.droppableId) {
            sPage = idx
          } else if (page.id === destination.droppableId) {
            dPage = idx
          }
        })
        const item = pageList[sPage].blocks.splice(source.index, 1)[0]
        pageList[dPage].blocks.splice(destination.index, 0, item)
        setPageList([...pageList])
      } else if (source.droppableId === 'thank_you_page' && destination.droppableId === 'thank_you_page') {
        const item = thanksPage.blocks.splice(source.index, 1)[0]
        thanksPage.blocks.splice(destination.index, 0, item)
        setThanksPage({ ...thanksPage })
      } else if (source.droppableId === 'thank_you_page') {
        pageList.forEach((page, idx) => {
          if (page.id === destination.droppableId) {
            sPage = idx
          }
        })
        const item =  thanksPage.blocks.splice(source.index, 1)[0]
        pageList[sPage].blocks.splice(destination.index, 0, item)
        setThanksPage({ ...thanksPage })
        setPageList([...pageList])
      } else if (destination.droppableId === 'thank_you_page') {
        pageList.forEach((page, idx) => {
          if (page.id === destination.droppableId) {
            dPage = idx
          }
        })
        const item = pageList[dPage].blocks.splice(source.index, 1)[0]
        thanksPage.blocks.splice(destination.index, 0, item)
        setThanksPage({ ...thanksPage })
        setPageList([...pageList])
      }
    }
    setDragging(false)
  }

  // 修改 button 文字
  const onBtnValueChange = (idx, e) => {
    const page = pageList[idx]
    page.button = e.target.textContent
    setPageList([...pageList])
  }

  // 导入表单 json 数据
  const build = () => {
    if(!buildJson) return
    const data = JSON.parse(buildJson)
    for (const key in data) {
      if (Object.hasOwnProperty.call(data, key) && Object.hasOwnProperty.call(form, key)) {
        form[key] = data[key]
      }
    }
    setForm({ ...form })
    if (data.thank_you_page) {
      setThanksPage(data.thank_you_page)
    }
    if (data.pages) {
      setPageList(data.pages)
    }
  }

  // 导出表单 json 数据
  const getJson = () => {
    const params = {
      ...form,
      pages: pageList,
      thank_you_page: thanksPage
    }

    if (window?.editform?.meta_data) {
      axios.put('/admin/forms/' + window?.editform?.id, params).then(resp => {
        window.alert('Saved successfully, redirecting ...')
        window.location.href = "/admin/forms";
      })
    } else {
      axios.post('/admin/forms', params).then(resp => {
        window.alert('Saved successfully, redirecting ...')
        window.location.href = "/admin/forms";
      })
    }
    // console.log(JSON.stringify(params))
    // window.alert('获取成功，前往控制查看')
  }

  // 设置表单 name, slug
  const setFormValue = (value, prop) => {
    form[prop] = value
    setForm({ ...form })
  }

  // 设置表单 branding
  const setFormBrandValue = (value, prop) => {
    form.branding[prop] = value
    setForm({ ...form })
  }

  const setRedirect = (checked) => {
    thanksPage.redirect = checked
    setThanksPage({ ...thanksPage })
  }

  // 自定义跳转
  const onCustomRedirect = () => {
    thanksPage.redirect = true
    setThanksPage({ ...thanksPage })
    if (!settingShow) {
      setSettingShow(true)
    }
    setTimeout(() => {
      const ipt = document.getElementById('redirect')
      if (ipt) {
        ipt.focus()
      }
    }, 0)
  }

  return (
    <main className="flex-1 flex flex-col min-h-screen overflow-x-hidden relative">
      <div className="flex-1 flex">
        <div className="relative flex-1 flex flex-col h-screen overflow-y-hidden">
          <div className="flex-1 flex overflow-y-hidden">
            <DragDropContext onDragEnd={onDragEnd} onDragStart={() => { setDragging(true) }}>
              <div className="flex-1 overflow-y-auto">
                <div className='px-16 py-6 hidden'>
                  <textarea
                    rows="5"
                    value={buildJson}
                    onChange={(e) => { setBuildJson(e.target.value) }}
                    className="theme-border theme-ring block w-1/2 border-gray-300 border focus:ring rounded focus:outline-none p-2"
                  ></textarea>
                </div>
                <div className='py-6 px-16 flex sticky z-50 top-0 space-x-4 bg-gray-100 border-b'>
                  <button className="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded text-gray-700 bg-white hover:bg-gray-50"
                            onClick={getJson}>Save</button>
                    {
                        !settingShow && (
                            <div className="">
                                <button
                                    className="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded text-gray-700 bg-white hover:bg-gray-50"
                                    onClick={() => { setSettingShow(true) }}
                                >
                                    <span>Settings</span>
                                </button>
                            </div>
                        )
                    }
                  <button className="py-2 px-4 bg-blue-400 rounded focus:ring text-white hidden" onClick={build}>Build</button>
                </div>
                {
                  pageList.map((page, pIdx) => {
                    return (
                      <div key={page.id}>
                        <Droppable droppableId={page.id}>
                          {(provided) => (
                            <div
                              ref={provided.innerRef}
                              {...provided.droppableProps}
                              className="relative"
                            >
                              {
                                (pIdx > 0) && (
                                  <>
                                    <PageSetting
                                      onDeletePage={() => { onUpdatePages('delete', pIdx) }}
                                    >
                                      <div className="absolute top-0 right-0 mt-8 mr-8 z-50">
                                        <button className="group h-12 w-12 flex items-center justify-center rounded-md focus:outline-none focus:ring-2 focus:ring-inset">
                                          <SeetingIcon classList="h-6 w-6 text-gray-500 group-hover:text-gray-900" />
                                        </button>
                                      </div>
                                    </PageSetting>
                                    <div className="absolute top-0 left-0 ml-12 -mt-8">
                                      <span className="text-xs font-bold text-gray-400">Page {pIdx + 1}</span>
                                    </div>
                                  </>
                                )
                              }
                              <div className="form-container w-full max-w-base mx-auto px-4 py-16">
                                {
                                  (form.branding.logo && pIdx === 0) && (
                                      <div
                                          className={`logo 
                                        ${form.branding.logoSize === 'small' ? 'h-8' :
                                              (form.branding.logoSize === 'medium' ? 'h-10' : 'h-12')}`}
                                      >
                                        <img
                                            src={form.branding.logo}
                                            className="block w-auto h-full"
                                        />
                                      </div>
                                  )
                                }
                                {
                                  page.blocks.map((item, idx) => {
                                    return (
                                      <FormItemBase
                                        draggableId={`item-${item.id}`}
                                        index={idx}
                                        length={page.blocks.length}
                                        key={item.id}
                                        formItem={item}
                                        dragging={dragging}
                                        onAddFormItem={(name, type, idx) => { onUpdateOrAddItem(name, type, idx, pIdx) }}
                                        onDeleteItem={(idx) => { onDeleteFormItem(idx, pIdx) }}
                                        onItemMove={(idx, step) => { onItemMove(idx, step, pIdx) }}
                                        onInputChange={(value, prop) => { onValueChange(value, prop, idx, pIdx) }}
                                      >
                                        <FormItem
                                          item={item}
                                          onItemOption={(oIdx, type) => { onItemOption(idx, oIdx, type, pIdx) }}
                                          onItemOptionValue={(oIdx, e) => { onItemOptionValue(idx, oIdx, pIdx, e) }}
                                          onInputChange={(value, prop) => { onValueChange(value, prop, idx, pIdx) }}
                                        />
                                      </FormItemBase>
                                    )
                                  })
                                }
                                { provided.placeholder }
                                {/* add block */}
                                <div className='flex justify-center my-16'>
                                  <FormBlock
                                    onAddFormItem={(name, type, idx) => { onUpdateOrAddItem(name, type, idx, pIdx) }}
                                    type="add"
                                  >
                                    <button
                                      className="flex justify-center items-center font-semibold bg-gray-200 text-gray-600 hover:bg-gray-300 px-4 py-2 rounded text-sm focus:outline-none focus:ring"
                                    >
                                      <AddIcon classList="text-gray-500 w-4 h-4 mr-2" />
                                      Add form block
                                    </button>
                                  </FormBlock>
                                </div>
                                <div className="group relative submit isolate">
                                  <div className="relative">
                                    <div className="absolute -z-1 rounded-md -top-4 -right-4 -bottom-4 -left-4 group-focus-within:bg-gray-100 group-hover:bg-gray-100 group-settings-open:bg-gray-100"
                                    ></div>
                                    <div
                                      contentEditable
                                      suppressContentEditableWarning
                                      onBlur={(e) => { onBtnValueChange(pIdx, e) }}
                                      style={{
                                        '--theme-primary': form.branding.primary_color,
                                        '--theme-button-text': form.branding.button,
                                        '--theme-ring-default': 'rgba(96, 165, 250, 0.4)',
                                        '--theme-border-active':' var(--theme-primary)',
                                        '--theme-button-default': 'var(--theme-primary)',
                                        '--theme-button-hover': 'var(--theme-primary)',
                                      }}
                                      className="theme-button theme-ring block w-full text-center font-semibold tracking-tight rounded py-4 transition-colors duration-100 ease-out remove-outline focus:outline-none focus-visible:outline-none cursor-text focus:outline-none prevent-collapse"
                                    >
                                      {page.button}
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          )}
                        </Droppable>
                        <div className="flex justify-center bg-gray-50 py-8">
                          <button
                            onClick={() => { onUpdatePages('add') }}
                            className="flex justify-center items-center font-semibold bg-gray-200 text-gray-600 hover:bg-gray-300 px-4 py-2 rounded text-sm"
                          >
                            <AddIcon classList="text-gray-500 w-4 h-4 mr-2" />
                            Add page
                          </button>
                        </div>
                      </div>
                    )
                  })
                }
                {
                  (thanksPage && thanksPage.blocks.length > 0 && !thanksPage.redirect) && (
                    <Droppable droppableId="thank_you_page">
                      {(provided, snapshot) => (
                        <div
                          ref={provided.innerRef}
                          {...provided.droppableProps}
                          className="relative"
                        >
                          <ThanksPageSetting
                            onCustomRedirect={onCustomRedirect}
                          >
                            <div className="absolute top-0 right-0 mt-8 mr-8 z-50">
                              <button className="group h-12 w-12 flex items-center justify-center rounded-md focus:outline-none focus:ring-2 focus:ring-inset">
                                <SeetingIcon classList="h-6 w-6 text-gray-500 group-hover:text-gray-900" />
                              </button>
                            </div>
                          </ThanksPageSetting>
                          <div className="absolute top-0 left-0 ml-12 -mt-8">
                            <span className="text-xs font-bold text-gray-400">Thank you page</span>
                          </div>
                          <div className="form-container w-full max-w-base mx-auto px-4 py-16">
                            {
                              thanksPage.blocks.map((item, idx) => {
                                return (
                                  <FormItemBase
                                    draggableId={`item-${item.id}`}
                                    index={idx}
                                    length={thanksPage.blocks.length}
                                    key={item.id}
                                    formItem={item}
                                    showInput={false}
                                    dragging={dragging}
                                    onAddFormItem={(name, type, idx) => { onUpdateOrAddItem(name, type, idx, 0, true) }}
                                    onDeleteItem={(idx) => { onDeleteFormItem(idx, 0, true) }}
                                    onItemMove={(idx, step) => { onItemMove(idx, step, 0, true) }}
                                    onInputChange={(value, prop) => { onValueChange(value, prop, idx, 0, true) }}
                                  >
                                    <FormItem
                                      item={item}
                                      onInputChange={(value, prop) => { onValueChange(value, prop, idx, 0, true) }}
                                    />
                                  </FormItemBase>
                                )
                              })
                            }
                            { provided.placeholder }
                            {/* add block */}
                            <div className='flex justify-center my-16'>
                              <FormBlock
                                onAddFormItem={(name, type, idx) => { onUpdateOrAddItem(name, type, idx, 0, true) }}
                                type="add"
                                showInput={false}
                              >
                                <button
                                  className="flex justify-center items-center font-semibold bg-gray-200 text-gray-600 hover:bg-gray-300 px-4 py-2 rounded text-sm focus:outline-none focus:ring"
                                >
                                  <AddIcon classList="text-gray-500 w-4 h-4 mr-2" />
                                  Add form block
                                </button>
                              </FormBlock>
                            </div>
                          </div>
                        </div>
                      )}
                    </Droppable>
                  )
                }
              </div>
            </DragDropContext>
            {
              settingShow && (
                <FormSetting
                  form={form}
                  redirect={thanksPage.redirect}
                  setFormValue={setFormValue}
                  setFormBrandValue={setFormBrandValue}
                  setRedirect={setRedirect}
                  onClose={() => { setSettingShow(false) }}
                />
              )
            }
          </div>
          {/* <div className="px-6 bg-white z-50 border-t border-gray-100 flex items-center justify-end md:justify-between py-4 md:px-12">
            <a
              href="#"
              className="rounded focus:ring-2 focus:ring-blue-300 focus:outline-none text-sm font-semibold transition-colors duration-100 ease-out focus:ring disabled:cursor-not-allowed px-8 py-2 bg-white border-2 border-gray-400 text-gray-600 hover:border-gray-600 hover:text-gray-800 mr-4">
              Preview
            </a>
          </div> */}
        </div>
      </div>
    </main>
  )
}
