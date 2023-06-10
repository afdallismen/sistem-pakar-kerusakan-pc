import {
  useState,
  useEffect,
  useContext,
} from 'react'
import { useNavigate } from 'react-router-dom'
import Box from '@mui/material/Box'
import TextField from '@mui/material/TextField'
import FormControl from '@mui/material/FormControl'
import FormControlLabel from '@mui/material/FormControlLabel'
import Checkbox from '@mui/material/Checkbox'
import Button from '@mui/material/Button'
import FormLabel from '@mui/material/FormLabel'
import CircularProgress from '@mui/material/CircularProgress'
import Stack from '@mui/material/Stack'
import List from '@mui/material/List'
import ListItem from '@mui/material/ListItem'
import ListItemButton from '@mui/material/ListItemButton'

import {
  instance as axios,
  wrapHttpError
} from '../admin/lib/axios'
import UserContext from './UserContext'

const TambahKonsultasi = () => {
  const navigate = useNavigate()
  const { user } = useContext(UserContext)
  const [dataGejala, setDataGejala] = useState([])
  const [isLoading, setIsLoading] = useState(false)
  const [deskripsi, setDeskripsi] = useState('')
  const [selectedGejalaIds, setSelectedGejalaIds] = useState([])

  useEffect(() => {
    const fetchDataGejala = async () => {
      setIsLoading(true);
      const { data } = await wrapHttpError(
        axios.get(`/api/gejala?perPage=100`)
      )
      setIsLoading(false)
      setDataGejala(data)
    }
    fetchDataGejala()
  }, [])

  const handleChangeDeskripsi = (evt) => {
    setDeskripsi(evt.target.value)
  }

  const handleCheckedGejala = (evt, id) =>  {
    evt.preventDefault()
    if (!selectedGejalaIds.includes(id)) {
      setSelectedGejalaIds([ ...selectedGejalaIds, id])
    } else {
      setSelectedGejalaIds([
        ...selectedGejalaIds.filter((selectedId) => id !== selectedId)
      ])
    }
  }

  const handleSubmit = async (evt) => {
    evt.preventDefault()
    try {
      await axios.post('/api/konsultasi', {
        deskripsi,
        gejala_ids: selectedGejalaIds,
        pelanggan_id: user?.id
      })
      navigate('/konsultasi')
    } catch (error) {
      console.error(error)
    }
  }

  return (
    <Stack
      gap={2}
    >
      <FormLabel component="legend">Input Deskripsi PC dan Gejala</FormLabel>
      <TextField
        label="Deskripsi PC"
        variant="filled"
        minRows={5}
        value={deskripsi}
        onChange={handleChangeDeskripsi}
        sx={{
          width: "480px",
        }}
        multiline
        required
      />
      <Box flex={1}>
        <FormControl
          component="fieldset"
          sx={{
            width: "100%"
          }}
        >
          <FormLabel component="legend">Pilih gejala</FormLabel>
          {isLoading && <CircularProgress />}
          <Stack
            direction="row"
            flexWrap="wrap"
            gap={1}
          >
            <List sx={{ flex: 1 }}>
              {dataGejala.slice(0, dataGejala.length / 2).map(({ id, nama }) => (
                <ListItem
                  key={`gejala-${id}`}
                  dense
                  disableGutters
                  disablePadding
                  divider
                >
                  <ListItemButton onClick={(evt) => handleCheckedGejala(evt, id)}>
                    <FormControlLabel
                      value={id}
                      checked={selectedGejalaIds.includes(id)}
                      name="gejala"
                      control={<Checkbox />}
                      label={nama}
                    />
                  </ListItemButton>
                </ListItem>
              ))}
            </List>
            <List sx={{ flex: 1 }}>
              {dataGejala.slice(dataGejala.length / 2).map(({ id, nama }) => (
                <ListItem
                  key={`gejala-${id}`}
                  dense
                  disableGutters
                  disablePadding
                  divider
                >
                  <ListItemButton onClick={(evt) => handleCheckedGejala(evt, id)}>
                    <FormControlLabel
                      value={id}
                      checked={selectedGejalaIds.includes(id)}
                      name="gejala"
                      control={<Checkbox />}
                      label={nama}
                    />
                  </ListItemButton>
                </ListItem>
              ))}
            </List>
          </Stack>
        </FormControl>
      </Box>
      <Button
        type="submit"
        variant="contained"
        onClick={handleSubmit}
      >
        DIAGNOSA
      </Button>
    </Stack>
  )
}

export default TambahKonsultasi
