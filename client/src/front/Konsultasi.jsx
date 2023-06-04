import {
  useContext,
  useState,
  useEffect,
} from 'react'
import { Link } from 'react-router-dom'
import Stack from '@mui/material/Stack'
import FormLabel from '@mui/material/FormLabel'
import Card from '@mui/material/Card'
import CardContent from '@mui/material/CardContent'
import CardActions from '@mui/material/CardActions'
import Typography from '@mui/material/Typography'
import Button from '@mui/material/Button'
import Masonry from '@mui/lab/Masonry';

import UserContext from './UserContext'
import { instance as axios } from '../admin/lib/axios'

const Konsultasi = () => {
  const { user } = useContext(UserContext)
  const [dataKonsultasi, setDataKonsultasi] = useState([])
  const [dataKerusakan, setDataKerusakan] = useState([])
  const [dataGejalaKonsultasi, setDataGejalaKonsultasi] = useState([])

  useEffect(() => {
    const fetchDataKonsultasi = async () => {
      const res = await axios.get(`/api/konsultasi?sort=created_at&order=desc&pelanggan_id=${[user.id]}`)
      setDataKonsultasi(res.data.data)
    }
    if (user && user.id) {
      fetchDataKonsultasi()
    }
  }, [user])

  useEffect(() => {
    const fetchDataKerusakan = async () => {
      const ids = dataKonsultasi.map(({ kerusakan_id }) => kerusakan_id)
      const res = await axios.get(`/api/kerusakan?ids=${ids}`)
      setDataKerusakan(res.data.data)
    }
    if (dataKonsultasi.length) {
      fetchDataKerusakan()
    }
  }, [dataKonsultasi])

  useEffect(() => {
    const fetchDataGejalaKonsultasi = async () => {
      const ids = dataKonsultasi.map(({ id }) => id)
      const res = await axios.get(`/api/gejala-konsultasi?konsultasi_id=${ids}`)
      setDataGejalaKonsultasi(res.data.data)
    }
    if (dataKonsultasi.length) {
      fetchDataGejalaKonsultasi()
    }
  }, [dataKonsultasi])

  return (
    <Stack gap={3} alignItems="flex-start">
      <FormLabel component="legend">Konsultasi yang telah dilakukan</FormLabel>
      <Button
        variant="contained"
        component={Link}
        to="/tambah-konsultasi"
      >
        TAMBAH KONSULTASI
      </Button>
      <Masonry columns={3} spacing={2}>
        {dataKonsultasi.map(({ id, deskripsi, kerusakan_id, cf }) => {
          const countGejala = dataGejalaKonsultasi.filter(({ konsultasi_id }) => konsultasi_id === id).length
          const kerusakan = dataKerusakan.find(({ id }) => id === kerusakan_id)?.nama
          return (
            <Card key={`konsultasi-${id}`}>
              <CardContent>
                <Typography variant="overline">Deskripsi PC</Typography>
                <Typography variant="body2" marginLeft={1} gutterBottom>{deskripsi}</Typography>
                <Typography variant="overline">Jumlah Gejala</Typography>
                <Typography variant="body2" marginLeft={1} gutterBottom>{countGejala} Gejala</Typography>
                <Typography variant="overline">Diagnosa Kerusakan</Typography>
                <Typography variant="body2" marginLeft={1} gutterBottom>{kerusakan || '-'}</Typography>
                <Typography variant="overline">Kepastian Diagnosa</Typography>
                <Typography variant="body2" marginLeft={1} gutterBottom>{cf * 100}%</Typography>
              </CardContent>
              <CardActions sx={{ borderTop: '2px solid #EFEFEF'}}>
                <Button
                  to={`/konsultasi/${id}`}
                  component={Link}
                  fullWidth
                >
                  DETAIL
                </Button>
              </CardActions>
            </Card>
          )
        })}
      </Masonry>
    </Stack>
  )
}

export default Konsultasi
