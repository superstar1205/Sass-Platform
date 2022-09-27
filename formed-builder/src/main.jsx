import React from 'react'
import ReactDOM from 'react-dom'
import './index.css'
import App from './App'
import axios from 'axios';

console.log(window.editform);
const csrfToken = document.head.querySelector('meta[name="csrf-token"]')
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content


axios.interceptors.response.use(function (response) {
    return response
}, async function (error) {
    window.alert(error?.response?.data?.message)
    return Promise.reject(error)
})

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById('root')
)
