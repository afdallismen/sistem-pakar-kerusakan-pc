import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
} from 'react-admin'

export const PelangganList = () => (
  <List>
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
