import * as Dialog from '@radix-ui/react-dialog'


export default function(props) {

  return (
    <Dialog.Root
        open={props.open}
        onOpenChange={props.onOpenChange}
      >
      <Dialog.Overlay className="bg-gray-600 opacity-50 fixed inset-0" />
      <Dialog.Content asChild>
        <div className="fixed bg-white w-base top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 rounded p-8">
          <h3 className="text-lg leading-6 font-medium text-gray-900">Are you sure you want to delete '{props.formName}'?</h3>
          <p className="text-gray-700 mt-2">
            Please confirm that you want to delete the form '{props.formName}'. This action can't be undone. All responses will be deleted.
          </p>
          <div className="flex mt-6 item-center justify-between flex-row-reverse">
            <button
              className="flex justify-center items-center text-sm font-semibold rounded 
              transition-colors duration-100 ease-out focus:outline-none focus:ring
              px-8 py-2.5 bg-gray-900 border border-gray-900 text-white hover:bg-gray-800"
              onClick={props.onDeleteForm}
            >
              Delete form
            </button>
            <button
              className="flex justify-center items-center text-sm font-semibold rounded 
              transition-colors duration-100 ease-out focus:outline-none focus:ring disabled:cursor-not-allowed 
              px-8 py-2.5 bg-white border-2 border-gray-400 text-gray-600 hover:border-gray-600 hover:text-gray-800"
              onClick={() => { props.onOpenChange(false) }}
            >
              Cancel
            </button>
          </div>
        </div>
      </Dialog.Content>
    </Dialog.Root>
  )
}