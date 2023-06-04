import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
  ReferenceField,
} from 'react-admin'

export const SolusiKerusakanList = () => (
  <List>
    <Datagrid rowClick="show">
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <TextField source="deskripsi" />
    </Datagrid>
  </List>
)

export const SolusiKerusakanShow = () => (
  <Show>
    <SimpleShowLayout>
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <TextField source="deskripsi" />
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
