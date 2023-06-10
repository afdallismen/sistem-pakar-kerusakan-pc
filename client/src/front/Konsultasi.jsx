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
  const [dataRule, setDataRule] = useState([])

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
    const fetchDataRule = async () => {
      const res = await axios.get(`/api/rule?perPage=100&kerusakan_id=${dataKonsultasi[0].kerusakans.map(({ id }) => id)}`)
      setDataRule(res.data.data)
    }
    if (dataKonsultasi[0]) {
      fetchDataRule()
    }
  }, [dataKonsultasi])

  return (
    <Stack gap={3}>
      <Stack
        direction="row"
        justifyContent="space-between"
      >
        <FormLabel component="legend">Diagnosa dari konsultasi yang telah dilakukan</FormLabel>
        <Button
          variant="contained"
          color="success"
          component={Link}
          to="/tambah-konsultasi"
        >
          KONSULTASI BARU
        </Button>
      </Stack>
      {dataKonsultasi[0] && (
        <Masonry columns={3} spacing={2}>
          {dataKonsultasi[0].diagnosas.sort((a, b) => b.cf - a.cf).map(({ id, kerusakan_id, cf }) => {
            const kerusakan = dataKonsultasi[0].kerusakans.find(({ id }) => id === kerusakan_id).nama
            const rules = dataRule.filter(rule => rule.kerusakan_id === kerusakan_id)
            const totalGejala = rules.filter(
              ({ gejala_id }) => dataKonsultasi[0].gejalas.find(({ id }) => id === gejala_id)
            ).length;

            return (
              <Card key={`konsultasi-${id}`}>
                <CardContent>
                  <Typography variant="overline">Kerusakan</Typography>
                  <Typography variant="body2" marginLeft={1} gutterBottom>{kerusakan}</Typography>
                  <Typography variant="overline">Gejala yang diukur</Typography>
                  <Typography variant="body2" marginLeft={1} gutterBottom>{`${totalGejala}/${rules.length}`}</Typography>
                  <Typography variant="overline">Tingkat Kepastian</Typography>
                  <Typography variant="body2" marginLeft={1}>{`${cf * 100} %`}</Typography>
                </CardContent>
                <CardActions>
                  <Button
                    variant="contained"
                    to={`/konsultasi/${dataKonsultasi[0].id}/diagnosa/${id}`}
                    component={Link}
                    fullWidth
                  >
                    LIHAT DETAIL
                  </Button>
                </CardActions>
              </Card>
            )
          })}
        </Masonry>
      )}
    </Stack>
  )
}

export default Konsultasi
