import { useContext } from 'react'
import Button from '@mui/material/Button'
import { Link } from 'react-router-dom'
import Typography from '@mui/material/Typography'
import Stack from '@mui/material/Stack'

import UserContext from './UserContext'

const Home = () => {
  const { user } = useContext(UserContext)

  return (
    <Stack
      alignItems="center"
      gap={5}
    >
      <Typography
        width="560px"
        textAlign="center"
        variant="h6"
        letterSpacing="0.05em"
      >
        Sistem pakar perbaikan PC adalah sebuah sistem komputer yang dirancang untuk memberikan solusi dan rekomendasi dalam memperbaiki masalah yang terkait dengan PC atau komputer.
      </Typography>
      {!user && (
        <Stack
          direction="row"
          justifyContent="center"
          alignItems="center"
        >
          <Button
            type="link"
            variant="contained"
            to="/registrasi"
            component={Link}
            sx={{
              fontWeight: 700,
              marginRight: 1,
            }}
          >
            PELANGGAN
          </Button>
          <Button
            type="link"
            variant="contained"
            to="/admin/login"
            component={Link}
            sx={{
              fontWeight: 700
            }}
          >
            ADMIN
          </Button>
        </Stack>
      )}
    </Stack>
  )
}

export default Home
