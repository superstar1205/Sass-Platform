import HiddenIcon from '../SvgIcon/HiddenIcon'

export default function(props) {

  const { item = {} } = props

  return (
    <div className="relative">
      <div className="relative">
        <input
          style={{'--theme-ring-default': 'transparent'}}
          value={item.label}
          placeholder="Enter a column name"
          onChange={(e) => {  props.onInputChange(e.target.value, 'label') }}
          className="theme-border theme-ring block w-full px-4 py-3 pr-8 md:pr-4 pl-12 font-semibold border rounded transition-colors duration-100 ease-out appearance-none focus:outline-none disabled:bg-gray-50 disabled:cursor-not-allowed text-gray-600 placeholder-gray-600"
        />
      </div>
      <HiddenIcon classList="absolute w-6 h-6 text-gray-500 ml-4 left-0 top-1/2 transform -translate-y-1/2" />
    </div>
  )
}