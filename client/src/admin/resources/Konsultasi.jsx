import {
  List,
  Datagrid,
  TextField,
  DateField,
  Show,
  TabbedShowLayout,
  ReferenceField,
  FunctionField,
  ArrayField,
  SingleFieldList,
  ChipField,
  RichTextField,
  NumberField,
} from 'react-admin'

export const KonsultasiList = () => {
  const sortHighestCf = (a, b) => b.cf - a.cf;

  const renderKerusakan = (record) => {
    if (!record.diagnosas.length) {
      return '-';
    }
    const diagnosa = record.diagnosas.sort(sortHighestCf)[0];
    return record.kerusakans.find(({ id }) => id === diagnosa.kerusakan_id).nama;
  }

  const renderCf = (record) => {
    if (!record.diagnosas.length) {
      return '-';
    }
    return record.diagnosas.sort(sortHighestCf)[0].cf;
  }

  return (
    <List>
      <Datagrid rowClick="show">
        <ReferenceField
          source="pelanggan_id"
          reference="pelanggan"
          link="show"
          sx={{
            whiteSpace: 'nowrap'
          }}
        />
        <FunctionField
          label="Gejala"
          render={record => record.gejala_konsultasis.length}
        />
        <FunctionField
          label="Kerusakan"
          render={renderKerusakan}
        />
        <FunctionField
          label="Cf"
          render={renderCf}
        />
        <DateField
          source="created_at"
          showTime
        />
      </Datagrid>
    </List>
  )
}

export const KonsultasiShow = () => (
  <Show>
    <TabbedShowLayout>
      <TabbedShowLayout.Tab label="Pelanggan">
        <TextField
          label="Nama"
          source="pelanggan.nama"
        />
        <TextField
          label="No.Hp"
          source="pelanggan.nohp"
        />
        <TextField
          label="Alamat"
          source="pelanggan.alamat"
        />
      </TabbedShowLayout.Tab>
      <TabbedShowLayout.Tab label="Konsultasi">
        <DateField
          label="Tanggal"
          source="created_at"
        />
        <TextField
          label="Deskripsi PC"
          source="deskripsi"
        />
        <ArrayField
          label="Gejala"
          source="gejalas"
        >
          <SingleFieldList
            resource="gejala"
            linkType="show"
          >
            <ChipField source="nama" />
          </SingleFieldList>
        </ArrayField>
      </TabbedShowLayout.Tab>
      <TabbedShowLayout.Tab label="Diagnosa">
        <ArrayField
          label="Diagnosa"
          source="diagnosas"
        >
          <Datagrid
            hover={false}
            isRowSelectable={false}
            bulkActionButtons={false}
          >
            <ReferenceField
              source="kerusakan_id"
              reference="kerusakan"
              link={false}
            >
              <TextField source="nama"/>
            </ReferenceField>
            <ReferenceField
              label="Solusi"
              source="kerusakan_id"
              reference="kerusakan"
              link={false}
            >
              <RichTextField
                label="Solusi"
                source="solusi"
              />
            </ReferenceField>
            <NumberField
              source="cf"
              options={{ maximumFractionDigits: 2 }}
            />
          </Datagrid>
        </ArrayField>
      </TabbedShowLayout.Tab>
    </TabbedShowLayout>
  </Show>
)
