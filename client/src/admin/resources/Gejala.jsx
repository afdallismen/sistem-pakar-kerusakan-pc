import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
  Create,
  SimpleForm,
  TextInput,
  Edit,
} from 'react-admin'

export const GejalaList = () => (
  <List>
    <Datagrid rowClick="show">
      <TextField source="kode" />
      <TextField source="nama" />
    </Datagrid>
  </List>
)

export const GejalaShow = () => (
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

export const GejalaCreate = () => (
  <Create>
    <SimpleForm>
      <TextInput source="kode" />
      <TextInput source="nama" />
    </SimpleForm>
  </Create>
)

export const GejalaEdit = () => (
  <Edit>
    <SimpleForm>
      <TextInput source="kode" />
      <TextInput source="nama" />
    </SimpleForm>
  </Edit>
)
