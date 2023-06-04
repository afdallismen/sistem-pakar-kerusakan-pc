import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
} from 'react-admin'

export const KerusakanList = () => (
  <List>
    <Datagrid rowClick="show">
      <TextField source="kode" />
      <TextField source="nama" />
    </Datagrid>
  </List>
)

export const KerusakanShow = () => (
  <Show>
    <SimpleShowLayout>
      <TextField source="kode" />
      <TextField source="nama" />
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
