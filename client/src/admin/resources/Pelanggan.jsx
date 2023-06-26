import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
  Button,
  TopToolbar,
} from 'react-admin'
import FileDownloadIcon from '@mui/icons-material/FileDownload'

const ListActions = () => (
  <TopToolbar>
    <Button
      href="http://localhost:8000/laporan/laporan-pelanggan"
      label="Ekspor"
    >
      <FileDownloadIcon />
    </Button>
  </TopToolbar>
)

export const PelangganList = () => (
  <List actions={<ListActions />}>
    <Datagrid rowClick="show">
      <TextField source="nama" />
      <TextField source="nohp" />
      <TextField source="alamat" />
    </Datagrid>
  </List>
)

export const PelangganShow = () => (
  <Show>
    <SimpleShowLayout>
      <TextField source="nama" />
      <TextField source="nohp" />
      <TextField source="alamat" />
      <DateField
        source="created_at"
        showTime
      />
      <DateField
        source="updated_at"
        showTime
      />
    </SimpleShowLayout>
  </Show>
)
