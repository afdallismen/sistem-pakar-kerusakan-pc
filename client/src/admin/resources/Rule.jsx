import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  SimpleShowLayout,
  ReferenceField,
  NumberField,
  Create,
  SimpleForm,
  TextInput,
  ReferenceInput,
  NumberInput,
  Edit,
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
        options={{ maximumFractionDigits: 2 }}
      />
      <NumberField
        source="md"
        options={{ maximumFractionDigits: 2 }}
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
        options={{ maximumFractionDigits: 2 }}
      />
      <NumberField
        source="md"
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

export const RuleCreate = () => (
  <Create>
    <SimpleForm>
      <TextInput source="kode" />
      <ReferenceInput
        source="kerusakan_id"
        reference="kerusakan"
      />
      <ReferenceInput
        source="gejala_id"
        reference="gejala"
      />
      <NumberInput
        source="mb"
        min={0}
        max={1}
        step={0.2}
      />
      <NumberInput
        source="md"
        min={0}
        max={1}
        step={0.2}
      />
    </SimpleForm>
  </Create>
)

export const RuleEdit = () => (
  <Edit>
    <SimpleForm>
      <TextInput source="kode" />
      <ReferenceInput
        source="kerusakan_id"
        reference="kerusakan"
      />
      <ReferenceInput
        source="gejala_id"
        reference="gejala"
      />
      <NumberInput
        source="mb"
        min={0}
        max={1}
        step={0.2}
      />
      <NumberInput
        source="md"
        min={0}
        max={1}
        step={0.2}
      />
    </SimpleForm>
  </Edit>
)
