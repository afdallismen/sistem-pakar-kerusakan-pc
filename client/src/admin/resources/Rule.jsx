import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
  ReferenceField,
  NumberField,
} from 'react-admin'

export const RuleList = () => (
  <List>
    <Datagrid rowClick="show">
      <TextField source="kode" />
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <ReferenceField
        source="gejala_id"
        reference="gejala"
        link="show"
      />
      <NumberField
        source="mb"
        options={{ maximumFractionDigits: 1 }}
      />
      <NumberField
        source="md"
        options={{ maximumFractionDigits: 1 }}
      />
    </Datagrid>
  </List>
)

export const RuleShow = () => (
  <Show>
    <SimpleShowLayout>
      <TextField source="kode" />
      <ReferenceField
        source="kerusakan_id"
        reference="kerusakan"
        link="show"
      />
      <ReferenceField
        source="gejala_id"
        reference="gejala"
        link="show"
      />
      <NumberField
        source="mb"
        options={{ maximumFractionDigits: 1 }}
      />
      <NumberField
        source="md"
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
