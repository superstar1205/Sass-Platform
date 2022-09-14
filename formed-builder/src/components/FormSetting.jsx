import DeleteIcon from '@/components/SvgIcon/DeleteIcon'
import UploadIcon from '@/components/SvgIcon/ImgIcon'
import * as Switch from '@radix-ui/react-switch'
import DeleteFormDialog from '@/dialog/DeleteForm'
import { useState } from 'react'
import axios from 'axios';


const sizeList = [
  { value: 'small', name: 'Small', size: 'text-xs' },
  { value: 'medium', name: 'Medium', size: 'text-sm' },
  { value: 'large', name: 'Large', size: 'text-base' }
]

export default function(props) {

  const { form, redirect } = props

  const [open, setOpen] = useState(false)
  const [uploading, setUploading] = useState(false)

  const onChooseLogo = () => {
    if (uploading) return
    document.getElementById('logo').click()
  }

  const onLogoChange = (e) => {
    const file = e.target.files[0]
    if (file) {
      const formData = new FormData()
      formData.append('images', file)
      setUploading(true)

      axios.post('/admin/upload', formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      }).then(res => {
        props.setFormBrandValue(res.data.url, 'logo')
      }).catch(err => {
        window.alert('上传图片失败')
      }).finally(() => {
        setUploading(false)
      })
    }
  }

  const onOpenChange = (o) => {
    setOpen(o)
  }

  // delete form
  const onDeleteForm = () => {
    setOpen(false)
    const formId = window?.editform?.id;
    if (formId) {
      axios.delete('/admin/forms/' + formId).then(resp => {
        window.alert('Delete successfully, redirecting ...')
        window.location.href = "/admin/forms";
      });
    } else {
      window.alert('Delete successfully, redirecting ...')
      window.location.href = "/admin/forms";
    }

  }

  return (
    <aside className="w-full border-l sm:w-96 fixed z-50 top-0 right-0 h-full overflow-y-auto bg-gray-50 pt-8 pb-8 lg:sticky lg:z-auto scroll-gradient-bottom">
      <div className="absolute top-0 right-0 mr-2 mt-2">
        <button
          className="group h-12 w-12 flex items-center justify-center
          rounded-md focus:outline-none focus:ring-2 focus:ring-inset"
          onClick={props.onClose}
        >
          <DeleteIcon classList="h-6 w-6 text-gray-500 group-hover:text-gray-900" />
        </button>
      </div>
      <div className="space-y-12">
        <div className="px-6">
          <span className="block text-xs font-medium tracking-wide text-gray-400 uppercase mb-2">Form</span>
          <div className="spance-y-2">
            <div className="space-y-6">
              <div className="relative">
                <div className="flex">
                  <label htmlFor="name" className="font-semibold text-gray-500 leading-snug tracking-tight mb-2">Title</label>
                </div>
                <div className="relative">
                  <input
                    type="text"
                    id="name"
                    name="name"
                    value={form.name}
                    onChange={(e) => { props.setFormValue(e.target.value, 'name') }}
                    className="theme-border theme-ring block w-full px-4 py-2 pr-8 md:pr-4 border rounded text-gray-900 transition-colors duration-100 ease-out appearance-none focus:outline-none" />
                </div>
              </div>
              <div className="relative">
                <div className="flex">
                  <label htmlFor="slug" className="font-semibold text-gray-500 leading-snug tracking-tight mb-2">Slug</label>
                </div>
                <div className="relative">
                  <input
                    type="text"
                    id="slug"
                    name="slug"
                    value={form.slug}
                    onChange={(e) => { props.setFormValue(e.target.value, 'slug') }}
                    className="theme-border theme-ring block w-full px-4 py-2 pr-8 md:pr-4 border rounded text-gray-900 transition-colors duration-100 ease-out appearance-none focus:outline-none" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="px-6">
          <div className="text-xs font-medium tracking-wide text-gray-400 uppercase mb-2">After completion</div>
          <div className="space-y-6">
            <div className="flex items-center">
              <Switch.Root
                id="redirect-switch"
                checked={redirect}
                onCheckedChange={(checked) => { props.setRedirect(checked) }}
                className={`relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out
                  duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 ${redirect ? 'bg-black' : 'bg-gray-200'}`}>
                <Switch.Thumb className={`pointer-events-none inline-block h-5 w-5 rounded-full
                  bg-white shadow transform ring-0 transition ease-in-out duration-200 ${redirect ? 'translate-x-5' : 'translate-x-0'}`} />
              </Switch.Root>
              <div className="flex">
                <label className="font-semibold text-gray-600 leading-snug tracking-tight ml-2" htmlFor="redirect-switch">Redirect after submission</label>
              </div>
            </div>
            {
              redirect && (
                <div className="relative">
                  <div className="flex">
                    <label htmlFor="redirect" className="font-semibold text-gray-500 leading-snug tracking-tight mb-2">Redirect URL</label>
                  </div>
                  <div className="relative">
                    <input
                      type="text"
                      id="redirect"
                      name="redirect"
                      value={form.redirect}
                      onChange={(e) => { props.setFormValue(e.target.value, 'redirect') }}
                      className="theme-border theme-ring block w-full px-4 py-2 pr-8 md:pr-4 border rounded text-gray-900 transition-colors duration-100 ease-out appearance-none focus:outline-none" />
                  </div>
                </div>
              )
            }
          </div>
        </div>
        <div className="px-6">
          <div className="text-xs font-medium tracking-wide text-gray-400 uppercase mb-2">Branding</div>
          <div className="space-y-6">
            <div className="relative">
              <div className="flex">
                <label htmlFor="logo" className="font-semibold text-gray-500 leading-snug tracking-tight mb-2">Logo</label>
              </div>
              <div className="relative cursor-pointer bg-white border rounded px-4 py-8 focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-400 focus:border-solid border-gray-400 border-dashed"
                   tabIndex="0"
                   onClick={onChooseLogo}>
                <input
                    type="file"
                    id="logo"
                    name="logo"
                    className="sr-only"
                    accept="image/*"
                    autoComplete="off"
                    tabIndex="-1"
                    style={{display: 'none'}}
                    onChange={onLogoChange}
                />
                {
                  form.branding.logo ? (
                      <div className="h-8 flex flex-col items-center">
                        <img
                            src={form.branding.logo}
                            className="block w-auto h-full"
                        />
                      </div>
                  ) : (
                      uploading ? (
                          <div className="space-y-3 flex flex-col items-center">
                            <p className="text-sm leading-none  text-gray-600">Uploading</p>
                          </div>
                      ) : (
                          <div className="space-y-3 flex flex-col items-center">
                            <UploadIcon classList="w-10 h-10 text-gray-400" />
                            <p className="text-sm leading-none  text-gray-600">Select a file or drag and drop</p>
                          </div>
                      )
                  )
                }
              </div>
              {
                form.branding.logo ? (
                    <button
                        className="flex justify-center items-center text-sm font-semibold rounded py-3 transition-colors duration-100 ease-out focus:outline-none focus:ring px-8 bg-white border-2 border-gray-400 text-gray-600 hover:border-gray-600 hover:text-gray-800 w-full mt-4"
                        onClick={() => { props.setFormBrandValue('', 'logo') }}
                    >
                      Remove logo
                    </button>
                ) : null
              }
            </div>
            {
              form.branding.logo ? (
                  <div className="relative">
                    <div className="flex">
                      <label className="font-semibold text-gray-500 leading-snug tracking-tight mb-2">Logo size</label>
                    </div>
                    <div className="flex just space-x-4">
                      {
                        sizeList.map(item => {
                          return (
                              <button
                                  key={item.value}
                                  onClick={() => { props.setFormBrandValue(item.value, 'logoSize') }}
                                  className={`flex flex-1 justify-center items-center px-2 py-1 bg-white border-2
                            duration-100 ease-out focus:outline-none focus:ring  font-semibold rounded transition-colors
                            ${item.value === form.branding.logoSize ? 'border-gray-600 text-gray-800' : 'border-gray-400 text-gray-600 hover:border-gray-600 hover:text-gray-800'} ${item.size}`}
                              >
                                {item.name}
                              </button>
                          )
                        })
                      }
                    </div>
                  </div>
              ) : null
            }
            <div className="relative">
              <div className="flex">
                <label htmlFor="primary_color" className="font-semibold text-gray-500 leading-snug tracking-tight mb-2">Primary color</label>
              </div>
              <div className="flex items-center space-x-4">
                <div className="relative flex-1">
                  <input
                    type="text"
                    id="primary_color"
                    name="primary_color"
                    value={form.branding.primary_color}
                    onChange={(e) => { props.setFormBrandValue(e.target.value, 'primary_color') }}
                    className="theme-border theme-ring block w-full px-4 py-2 pr-8 md:pr-4 border rounded text-gray-900 transition-colors duration-100 ease-out appearance-none focus:outline-none" />
                </div>
                <div
                  className="rounded border border-gray-300 w-10 h-10"
                  style={{ backgroundColor: form.branding.primary_color }}
                />
              </div>
            </div>
            <div className="relative">
              <div className="flex">
                <label htmlFor="button_text_color" className="font-semibold text-gray-500 leading-snug tracking-tight mb-2">Button text color</label>
              </div>
              <div className="flex items-center space-x-4">
                <div className="relative flex-1">
                  <input
                    type="text"
                    id="button_text_color"
                    name="button_text_color"
                    value={form.branding.button}
                    onChange={(e) => { props.setFormBrandValue(e.target.value, 'button') }}
                    className="theme-border theme-ring block w-full px-4 py-2 pr-8 md:pr-4 border rounded text-gray-900 transition-colors duration-100 ease-out appearance-none focus:outline-none" />
                </div>
                <div
                  className="rounded border border-gray-300 w-10 h-10"
                  style={{ backgroundColor: form.branding.button }}
                />
              </div>
            </div>
            {/* <div className="flex items-center">
              <Switch.Root
                id="hide-branding"
                checked={form.branding.hideBranding}
                onCheckedChange={(checked) => { props.setFormBrandValue(checked, 'hideBranding') }}
                className={`relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out
                  duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-300 ${form.branding.hideBranding ? 'bg-black' : 'bg-gray-200'}`}>
                <Switch.Thumb className={`pointer-events-none inline-block h-5 w-5 rounded-full
                  bg-white shadow transform ring-0 transition ease-in-out duration-200 ${form.branding.hideBranding ? 'translate-x-5' : 'translate-x-0'}`} />
              </Switch.Root>
              <div className="flex">
                <label className="font-semibold text-gray-600 leading-snug tracking-tight ml-2" htmlFor="hide-branding">Hide Reform logo</label>
              </div>
            </div> */}
          </div>
        </div>
        <div className="px-6">
          <div className="text-xs font-medium tracking-wide text-gray-400 uppercase mb-2">Danger zone</div>
          <div className="space-y-6">
            <button
              className="flex justify-center items-center text-sm font-semibold rounded
              transition-colors duration-100 ease-out focus:outline-none focus:ring px-4
              py-3 bg-gray-200 hover:bg-gray-300 w-full text-red-400"
              onClick={() => { setOpen(true) }}
            >
              Delete form
            </button>
          </div>
        </div>
      </div>
      {/* Delete form dialog */}
      <DeleteFormDialog
        formName={form.name}
        open={open}
        onOpenChange={onOpenChange}
        onDeleteForm={onDeleteForm}
      />
    </aside>
  )
}
