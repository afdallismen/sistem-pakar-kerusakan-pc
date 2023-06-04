import { useState } from 'react'
import {
  Link as RouterLink,
  Outlet,
  useNavigate,
} from 'react-router-dom'
import Container from '@mui/material/Container'
import Typography from '@mui/material/Typography'
import Link from '@mui/material/Link'
import Paper from '@mui/material/Paper'
import Stack from '@mui/material/Stack'

import UserContext from './UserContext'
import './index.css'

const Front = () => {
  const [user, setUser] = useState(JSON.parse(localStorage.getItem('user')))
  const navigate = useNavigate();

  const handleClickLogout = (evt) => {
    evt.preventDefault()
    localStorage.removeItem('user')
    setUser(null)
    navigate('/')
  }

  const saveToStorage = (user) => {
    localStorage.setItem('user', JSON.stringify(user))
    setUser(user)
  }

  return (
    <UserContext.Provider value={{ user, setUser: saveToStorage }}>
      <Paper
        sx={{
          borderRadius: 0,
          paddingTop: 5,
          paddingBottom: 2,
        }}
      >
        <Link
          to="/"
          underline="none"
          component={RouterLink}
          color="black"
        >
          <Typography
            variant="h3"
            textAlign="center"
            fontWeight={700}
            marginBottom={user ? 5 : 0}
            color="#5A5A5A"
            letterSpacing="-0.04em"
          >
            Diagnosa Kerusakan PC
          </Typography>
        </Link>
        {user && (
          <Stack
            direction="row"
            justifyContent="center"
            gap={3}
          >
            <Link
              to="/"
              underline="hover"
              component={RouterLink}
            >
              <Typography fontWeight={700}>Home</Typography>
            </Link>
            <Typography color="grey">/</Typography>
            <Link
              to="/konsultasi"
              underline="hover"
              component={RouterLink}
            >
              <Typography fontWeight={700}>Konsultasi</Typography>
            </Link>
            <Typography color="grey">/</Typography>
            <Link
              to="/profil"
              underline="hover"
              component={RouterLink}
            >
              <Typography fontWeight={700}>Profil</Typography>
            </Link>
            <Typography color="grey">/</Typography>
            <Link
              underline="none"
              component={RouterLink}
              onClick={handleClickLogout}
            >
              <Typography fontWeight={700}>Logout</Typography>
            </Link>
          </Stack>
        )}
      </Paper>
      <Container
        sx={{
          padding: 5
        }}
      >
        <Outlet />
      </Container>
    </UserContext.Provider>
  )
}

export default Front
