import H1 from '@/components/generator/H1'
import H2 from '@/components/generator/H2'
import Text from '@/components/generator/Text'
import LongTextInput from '@/components/generator/LongTextInput'
import HiddenInput from '@/components/generator/HiddenInput'
import RadioInput from '@/components/generator/RadioInput'
import CheckboxInput from '@/components/generator/CheckboxInput'
import ScaleInput from '@/components/generator/ScaleInput'
import NormalInput from '@/components/generator/NormalInput'

const formItem = {
  h1: H1,
  h2: H2,
  rich_text: Text,
  name: NormalInput,
  email: NormalInput,
  text: NormalInput,
  textarea: LongTextInput,
  number: NormalInput,
  url: NormalInput,
  hidden: HiddenInput,
  radio: RadioInput,
  checkbox: CheckboxInput,
  scale: ScaleInput
}

export default function(props) {
  const FormItem = formItem[props.item.type]
  if (!FormItem) return null
  return <FormItem {...props} />
}