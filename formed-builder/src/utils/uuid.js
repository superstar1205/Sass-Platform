export default function() {
  const tempUrl = URL.createObjectURL(new Blob())
  const uuid = tempUrl.toString()
  URL.revokeObjectURL(tempUrl)
  return uuid.substr(uuid.lastIndexOf('/') + 1)
}
