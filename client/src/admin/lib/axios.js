import axios from 'axios'
import { HttpError } from 'react-admin'

const instance = axios.create({
  baseURL: 'http://localhost:8000',
  withCredentials: true,
  headers: {
    common: {
      Accept: 'application/json',
      "Content-Type": 'application/json'
    }
  }
})

const wrapHttpError = async (promise) => {
  try {
    const res = await promise
    return res.data
  } catch (error) {
    if (error.response) {
      throw new HttpError(
        error.response.statusText,
        error.response.status,
        error.response.data
      )
    } else if (error.request) {
      throw new Error(error.request)
    } else {
      throw new Error(error.message)
    }
  }
}

export { instance, wrapHttpError }