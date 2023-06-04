import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
  NumberField,
  ReferenceField
} from 'react-admin'

export const KonsultasiList = () => (
  <List>
    <Datagrid rowClick="show">
      <ReferenceField
        source="pelanggan_id"
        reference="pelanggan"
        link="show"
      />
      <TextField source="deskripsi" />
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <NumberField
        source="cf"
        options={{ maximumFractionDigits: 1 }}
      />
      <DateField
        source="created_at"
        showTime
      />
    </Datagrid>
  </List>
)

export const KonsultasiShow = () => (
  <Show>
    <SimpleShowLayout>
      <ReferenceField
        source="pelanggan_id"
        reference="pelanggan"
        link="show"
      />
      <TextField source="deskripsi" />
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <NumberField
        source="cf"
        options={{ maximumFractionDigits: 1 }}
      />
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
