import BaseInput from './BaseInput'

export default function(props) {

  const { item = {} } = props

  return (
    <BaseInput
      item={item}
      onInputChange={props.onInputChange}
    >
      <div className="relative">
        <input
          style={{'--theme-ring-default': 'transparent'}}
          value={item.placeholder}
          onChange={(e) => { props.onInputChange(e.target.value, 'placeholder') }}
          placeholder="Enter a placeholder for this question"
          className="ipt theme-border theme-ring block w-full px-4 py-3 pr-8 md:pr-4 border rounded transition-colors duration-100 ease-out appearance-none focus:outline-none disabled:bg-gray-50 disabled:cursor-not-allowed text-gray-500 placeholder-gray-500"
         />
      </div>
    </BaseInput>
  )
}