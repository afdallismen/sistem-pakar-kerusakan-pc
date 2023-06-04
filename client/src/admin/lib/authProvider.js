import { instance as axios } from './axios'

const authProvider = {
  login: async ({ username, password }) => {
    try {
      const auth = await axios.post('/login', {
        email: username,
        password
      })
      localStorage.setItem('auth', JSON.stringify(auth.data))
      return Promise.resolve()
    } catch (error) {
      console.error(error)
      return Promise.reject(error)
    }
  },
  checkError: (error) => {
    const { status } = error
    if (status === 401 || status === 403) {
      localStorage.removeItem('auth')
      return Promise.reject()
    }
    return Promise.resolve()
  },
  checkAuth: () => {
    return localStorage.getItem('auth')
      ? Promise.resolve()
      : Promise.reject()
  },
  logout: async () => {
    try {
      await axios.post('/logout')
      localStorage.removeItem('auth')
      return Promise.resolve()
    } catch (error) {
      console.error(error)
      return Promise.reject(error)
    }
  },
  getIdentity: () => {
    const { user } = JSON.parse(localStorage.getItem('auth'))
    return Promise.resolve({ id: user.id, fullname: user.name })
  },
  getPermissions: () => { return Promise.resolve() },
}

export default authProvider
