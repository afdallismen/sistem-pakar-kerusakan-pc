import {
  useEffect,
  useState,
} from 'react'
import Stack from '@mui/material/Stack'
import Typography from '@mui/material/Typography'
import List from '@mui/material/List'
import ListItem from '@mui/material/ListItem'
import ListItemText from '@mui/material/ListItemText'
import Card from '@mui/material/Card'
import CardContent from '@mui/material/CardContent'
import { useParams } from 'react-router-dom'

import { instance as axios } from '../admin/lib/axios'

const DetailKonsultasi = () => {
  const { konsultasi_id } = useParams()
  const [konsultasi, setKonsultasi] = useState(null)
  const [kerusakan, setKerusakan] = useState(null)
  const [dataGejalaKonsultansi, setDataGejalaKonsultansi] = useState([])
  const [dataGejala, setDataGejala] = useState([])
  const [dataSolusiKerusakan, setDataSolusiKerusakan] = useState([])

  useEffect(() => {
    const fetchKonsultasi = async () => {
      const res = await axios.get(`/api/konsultasi/${konsultasi_id}`)
      setKonsultasi(res.data.data)
    }
    if (konsultasi_id) {
      fetchKonsultasi()
    }
  }, [konsultasi_id])

  useEffect(() => {
    const fetchDataGejalaKonsultansi = async () => {
      const res = await axios.get( `/api/gejala-konsultasi?konsultasi_id=${[konsultasi_id]}`)
      setDataGejalaKonsultansi(res.data.data)
    }
    if (konsultasi_id) {
      fetchDataGejalaKonsultansi()
    }
  }, [konsultasi_id])

  useEffect(() => {
    const fetchKerusakan = async () => {
      const res = await axios.get( `/api/kerusakan/${konsultasi.kerusakan_id}`)
      setKerusakan(res.data.data)
    }
    if (konsultasi && konsultasi.kerusakan_id) {
      fetchKerusakan()
    }
  }, [konsultasi])

  useEffect(() => {
    const fetchDataSolusiKerusakan = async () => {
      const res = await axios.get(`/api/solusi-kerusakan?kerusakan_id=${[konsultasi.kerusakan_id]}`)
      setDataSolusiKerusakan(res.data.data)
    }
    if (konsultasi && konsultasi.kerusakan_id) {
      fetchDataSolusiKerusakan()
    }
  }, [konsultasi])

  useEffect(() => {
    const fetchGejala = async () => {
      const ids = dataGejalaKonsultansi.map(({ gejala_id }) => gejala_id)
      const res = await axios.get( `/api/gejala?ids=${ids}`)
      setDataGejala(res.data.data)
    }
    if (dataGejalaKonsultansi.length) {
      fetchGejala()
    }
  }, [dataGejalaKonsultansi])

  return (
    <Stack gap={3} alignItems="flex-start">
      <Card>
        <CardContent>
          <Typography variant="overline" color="#565656" fontWeight={800}>Deskripsi PC</Typography>
          <Typography variant="body2" marginLeft={1}>{konsultasi?.deskripsi || '-'}</Typography>
        </CardContent>
      </Card>
      <Stack direction="row" gap={3} alignItems="flex-start">
        <Card>
          <CardContent>
            <Typography variant="overline" color="#565656" fontWeight={800}>Gejala</Typography>
            <List disablePadding sx={{ marginLeft: 1 }}>
              {dataGejalaKonsultansi.length ?
                dataGejalaKonsultansi.map(({ gejala_id }, i) => {
                  const gejala = dataGejala.find(({ id }) => id === gejala_id)?.nama
                  return (
                    <ListItem disableGutters disablePadding key={`gejala-${gejala_id}`}>
                      <ListItemText primaryTypographyProps={{ variant: 'body2' }} primary={`${i+1}. ${gejala || '-'}`} />
                    </ListItem>
                  )
                }) : '-'
              }
            </List>
          </CardContent>
        </Card>
        <Card>
          <CardContent>
            <Typography variant="overline" color="#565656" fontWeight={800}>Diagnosa Kerusakan</Typography>
            <Typography variant="body2" marginLeft={1}>{kerusakan?.nama || '-'}</Typography>
          </CardContent>
        </Card>
        <Card>
          <CardContent>
            <Typography variant="overline" color="#565656" fontWeight={800}>Kepastian Diagnosa</Typography>
            <Typography variant="body2" marginLeft={1}>{(konsultasi?.cf || 0) * 100}%</Typography>
          </CardContent>
        </Card>
      </Stack>
      <Card>
        <CardContent>
          <Typography variant="overline" color="#565656" fontWeight={800}>Solusi Perbaikan</Typography>
          <List disablePadding sx={{ marginLeft: 1 }}>
            {dataSolusiKerusakan.length ?
              dataSolusiKerusakan.map(({ id, deskripsi }, i) => (
                <ListItem disableGutters disablePadding key={`solusi-${id}`}>
                  <ListItemText primaryTypographyProps={{ variant: 'body2' }} primary={`${i+1}. ${deskripsi || '-'}`} />
                </ListItem>
              )) : '-'
            }
          </List>
        </CardContent>
      </Card>
    </Stack>
  )
}

export default DetailKonsultasi
