import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
  Create,
  Edit,
  SimpleForm,
  TextInput,
  RichTextField,
} from 'react-admin'
import { RichTextInput } from 'ra-input-rich-text'

export const KerusakanList = () => (
  <List>
    <Datagrid rowClick="show">
      <TextField source="kode" />
      <TextField source="nama" />
      <RichTextField source="solusi" />
    </Datagrid>
  </List>
)

export const KerusakanShow = () => (
  <Show>
    <SimpleShowLayout>
      <TextField source="kode" />
      <TextField source="nama" />
      <RichTextField source="solusi" />
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

export const KerusakanCreate = () => (
  <Create>
    <SimpleForm>
      <TextInput source="kode" />
      <TextInput source="nama" />
      <RichTextInput source="solusi" />
    </SimpleForm>
  </Create>
)

export const KerusakanEdit = () => (
  <Edit>
    <SimpleForm>
      <TextInput source="kode" />
      <TextInput source="nama" />
      <RichTextInput source="solusi" />
    </SimpleForm>
  </Edit>
)
