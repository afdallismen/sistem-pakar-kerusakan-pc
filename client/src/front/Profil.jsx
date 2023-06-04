import {
  useState,
  useContext,
  useEffect,
} from 'react'
import { useNavigate } from 'react-router-dom'
import Stack from '@mui/material/Stack'
import TextField from '@mui/material/TextField'
import Button from '@mui/material/Button'
import FormLabel from '@mui/material/FormLabel'

import UserContext from './UserContext'
import { instance as axios } from '../admin/lib/axios'

const Profil = () => {
  const { user, setUser } = useContext(UserContext)
  const [hasFetchUser, setHasFetchUser] = useState(false)
  const [nama, setNama] = useState(user?.nama)
  const [alamat, setAlamat] = useState(user?.alamat)
  const [nohp, setNoHp] = useState(user?.nohp)

  const navigate = useNavigate()

  useEffect(() => {
    const fetchPelanggan = async () => {
      const res = await axios.get(`/api/pelanggan/${user.id}`)
      setUser(res.data.data)
      setHasFetchUser(true)
    }
    if (!hasFetchUser && user && user.id) {
      fetchPelanggan()
    }
  }, [user, setUser, hasFetchUser])

  const handleChangeNama = (evt) => {
    setNama(evt.target.value)
  }

  const handleChangeAlamat = (evt) => {
    setAlamat(evt.target.value)
  }

  const handleChangeNoHp = (evt) => {
    setNoHp(evt.target.value)
  }

  const handleClickSubmit = async (evt) => {
    evt.preventDefault()
    try {
      const res = await axios.put(`/api/pelanggan/${user?.id}`, {
        nama,
        alamat,
        nohp
      })
      setUser(res.data.data)
      navigate('/')
    } catch (error) {
      console.error(error)
    }
  }

  return (
    <Stack alignItems="center">
      <Stack
        gap={3}
        width="480px"
      >
        <FormLabel component="legend">Profil Anda</FormLabel>
        <TextField
          label="Nama"
          variant="filled"
          value={nama}
          onChange={handleChangeNama}
          sx={{
            width: "320px"
          }}
          required
        />
        <TextField
          label="No Hp"
          variant="filled"
          value={nohp}
          onChange={handleChangeNoHp}
          sx={{
            width: "320px"
          }}
          required
        />
        <TextField
          label="Alamat"
          variant="filled"
          minRows={5}
          value={alamat}
          onChange={handleChangeAlamat}
          sx={{
            width: "480px",
          }}
          multiline
          required
        />
        <Button
          type="submit"
          variant="contained"
          onClick={handleClickSubmit}
        >
          SIMPAN
        </Button>
      </Stack>
    </Stack>
  )
}

export default Profil
