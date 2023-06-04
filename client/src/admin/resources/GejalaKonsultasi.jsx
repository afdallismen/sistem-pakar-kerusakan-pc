import {
  List,
  Datagrid,
  DateField,
  Show,
  SimpleShowLayout,
  ReferenceField,
} from 'react-admin'

export const GejalaKonsultasiList = () => (
  <List>
    <Datagrid rowClick="show">
      <ReferenceField
        source="konsultasi_id"
        reference="konsultasi"
        link="show"
      />
      <ReferenceField
        source="gejala_id"
        reference="gejala"
        link="show"
      />
    </Datagrid>
  </List>
)

export const GejalaKonsultasiShow = () => (
  <Show>
    <SimpleShowLayout>
      <ReferenceField
        source="konsultasi_id"
        reference="konsultasi"
        link="show"
      />
      <ReferenceField
        source="gejala_id"
        reference="gejala"
        link="show"
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
