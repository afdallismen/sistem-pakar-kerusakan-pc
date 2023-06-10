import {
  useState,
  useEffect,
} from 'react'
import {
  useParams,
} from 'react-router-dom'
import Typography from '@mui/material/Typography'
import Paper from '@mui/material/Paper'
import Stack from '@mui/material/Stack'
import Box from '@mui/material/Box'
import List from '@mui/material/List'
import ListItem from '@mui/material/ListItem'
import ListItemText from '@mui/material/ListItemText'
import Button from '@mui/material/Button'
import { PDFDownloadLink } from '@react-pdf/renderer'

import { instance as axios } from '../admin/lib/axios'
import PrintDiagnosa from './PrintDiagnosa'

const DetailDiagnosa = () => {
  const { konsultasi_id, diagnosa_id } = useParams()
  const [konsultasi, setKonsultasi] = useState(null)
  const [diagnosa, setDiagnosa] = useState(null)
  const [kerusakan, setKerusakan] = useState(null)
  const [dataRule, setDataRule] = useState(null)
  const [rules, setRules] = useState([])

  useEffect(() => {
    const fetchRule = async () => {
      const res = await axios.get('/api/rule?perPage=100')
      setDataRule(res.data.data)
    }
    if (kerusakan) {
      fetchRule()
    }
  }, [kerusakan])

  useEffect(() => {
    if (dataRule && konsultasi && diagnosa) {
      setRules(dataRule
        .filter(rule =>
          rule.kerusakan_id === diagnosa.kerusakan_id &&
          konsultasi.gejalas.find(({ id }) => id === rule.gejala_id)
        )
      )
    }
  }, [dataRule, konsultasi, diagnosa])

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
    if (konsultasi && diagnosa_id) {
      setDiagnosa(konsultasi.diagnosas.find(({ id }) => id === Number(diagnosa_id)))
    }
  }, [konsultasi, diagnosa_id])

  useEffect(() => {
    if (konsultasi && diagnosa) {
      setKerusakan(konsultasi.kerusakans.find(({ id }) => id === diagnosa.kerusakan_id))
    }
  }, [konsultasi, diagnosa])

  return (
    <Paper
      sx={{
        padding: 3,
      }}
    >
      <Stack gap={3}>
        <Stack
          direction="row"
          justifyContent="flex-end"
        >
          <Button
            variant="contained"
            color="success"
            document={
              <PrintDiagnosa
                konsultasi={konsultasi}
                diagnosa={diagnosa}
                kerusakan={kerusakan}
                rules={rules}
              />
            }
            disabled={!(konsultasi && diagnosa && kerusakan && rules)}
            component={PDFDownloadLink}
            target="__blank"
          >
            Download PDF
          </Button>
        </Stack>
        <Box>
          <Typography variant="overline">Deskripsi PC</Typography>
          <Typography variant="body2" marginLeft={1}>{konsultasi?.deskripsi}</Typography>
        </Box>
        <Box>
          <Typography variant="overline">Gejala</Typography>
          <List
            sx={{
              marginLeft: 1,
            }}
            disablePadding
          >
            {konsultasi?.gejalas.map(({ id, kode, nama }, i) => (
              <ListItem
                key={`gejala-${id}`}
                disablePadding
                >
                <ListItemText
                  primary={`${i+1}. ${kode} / ${nama}`}
                  primaryTypographyProps={{
                    variant: 'body2'
                  }}
                />
              </ListItem>
            ))}
          </List>
        </Box>
        <Box>
          <Typography variant="overline">Kerusakan</Typography>
          <Typography variant="body2" marginLeft={1}>{kerusakan?.nama}</Typography>
        </Box>
        <Box>
          <Typography variant="overline">Kepastian Diagnosa</Typography>
          <Typography variant="body2" marginLeft={1}>{diagnosa?.cf * 100} %</Typography>
        </Box>
        <Box>
          <Typography variant="overline">Solusi</Typography>
          <Typography variant="body2" marginLeft={1} dangerouslySetInnerHTML={{ __html: kerusakan?.solusi }} sx={{ '> p': { margin: 0 }, marginLeft: 1 }}/>
        </Box>
      </Stack>
    </Paper>
  )
}

export default DetailDiagnosa
