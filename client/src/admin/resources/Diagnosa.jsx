import {
  List,
  Datagrid,
  DateField,
  Show,
  SimpleShowLayout,
  ReferenceField,
  NumberField,
} from 'react-admin'

export const DiagnosaList = () => (
  <List>
    <Datagrid rowClick="show">
      <ReferenceField
        source="konsultasi_id"
        reference="konsultasi"
        link="show"
      />
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <NumberField
        source="cf"
        options={{ maximumFractionDigits: 2 }}
      />
    </Datagrid>
  </List>
)

export const DiagnosaShow = () => (
  <Show>
    <SimpleShowLayout>
      <ReferenceField
        source="konsultasi_id"
        reference="konsultasi"
        link="show"
      />
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <NumberField
        source="cf"
        options={{ maximumFractionDigits: 2 }}
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
