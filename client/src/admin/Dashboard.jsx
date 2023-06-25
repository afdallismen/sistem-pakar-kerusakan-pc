import Card from '@mui/material/Card'
import CardContent from '@mui/material/CardContent'
import Typography from '@mui/material/Typography'
import { Title } from 'react-admin'

const Dashboard = () => (
  <Card
    sx={{
      marginTop: 2,
      width: '640px',
    }}
  >
    <Title title="Sistem Pakar Kerusakan PC" />
  </Card>
)

export default Dashboard
