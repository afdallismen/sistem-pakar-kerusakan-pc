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
    <Title title="Dasbor" />
    <CardContent>
      <Typography
        variant="h5"
        gutterBottom
      >
        Diagnosa Kerusakan PC
      </Typography>
      <Typography
        textAlign="justify"
      >
        Sistem pakar kerusakan PC adalah sebuah sistem komputer yang dirancang untuk memberikan solusi dan rekomendasi dalam memperbaiki masalah yang terkait dengan PC atau komputer.
      </Typography>
    </CardContent>
  </Card>
)

export default Dashboard
