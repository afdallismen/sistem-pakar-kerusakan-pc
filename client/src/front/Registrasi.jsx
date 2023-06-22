import {
  useState,
  useContext,
} from 'react'
import { useNavigate } from 'react-router-dom'
import Stack from '@mui/material/Stack'
import TextField from '@mui/material/TextField'
import Button from '@mui/material/Button'
import FormLabel from '@mui/material/FormLabel'
import ArrowBackIcon from '@mui/icons-material/ArrowBack';

import UserContext from './UserContext'
import { instance as axios } from '../admin/lib/axios'

const Registrasi = () => {
  const [nama, setNama] = useState('')
  const [alamat, setAlamat] = useState('')
  const [nohp, setNoHp] = useState('')
  const { setUser } = useContext(UserContext)
  const navigate = useNavigate()

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
      const res = await axios.post('/api/pelanggan', {
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

  const handleClickKembali = () => {
    navigate(-1);
  }

  return (
    <Stack
      alignItems="center"
    >
      <div style={{ width: '480px', marginBottom: '16px' }}>
        <Button
          type="link"
          startIcon={<ArrowBackIcon />}
          onClick={handleClickKembali}
          sx={{
            textTransform: 'none',
          }}
        >
          Kembali
        </Button>
      </div>
      <Stack
        gap={3}
        width="480px"
      >
        <FormLabel component="legend">Isi Data Diri</FormLabel>
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
          REGISTRASI
        </Button>
      </Stack>
    </Stack>
  )
}

export default Registrasi
