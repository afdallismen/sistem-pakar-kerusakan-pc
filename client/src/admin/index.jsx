import {
  Admin as RaAdmin,
  Resource,
} from 'react-admin'
import indonesianMessages from 'ra-language-indonesian-new'
import polyglotI18nProvider from 'ra-i18n-polyglot'

import dataProvider from './lib/dataProvider'
import { GejalaCreate, GejalaEdit, GejalaList, GejalaShow } from './resources/Gejala'
import { KerusakanCreate, KerusakanEdit, KerusakanList, KerusakanShow } from './resources/Kerusakan'
import { RuleCreate, RuleEdit, RuleList, RuleShow } from './resources/Rule'
import { PelangganList, PelangganShow } from './resources/Pelanggan'
import { KonsultasiList, KonsultasiShow } from './resources/Konsultasi'
import { DiagnosaList, DiagnosaShow } from './resources/Diagnosa'
import authProvider from './lib/authProvider'
import { Login } from './login'
import Dashboard from './Dashboard'
import Layout from './Layout'

const i18nProvider = polyglotI18nProvider(() => indonesianMessages, 'id')

const Admin = () => (
  <RaAdmin
    layout={Layout}
    dashboard={Dashboard}
    basename="/admin"
    loginPage={<Login />}
    authProvider={authProvider}
    dataProvider={dataProvider}
    i18nProvider={i18nProvider}
  >
    <Resource
      name="gejala"
      list={GejalaList}
      show={GejalaShow}
      create={GejalaCreate}
      edit={GejalaEdit}
      options={{
        label: 'Gejala',
      }}
      recordRepresentation="kode"
    />
    <Resource
      name="kerusakan"
      list={KerusakanList}
      show={KerusakanShow}
      create={KerusakanCreate}
      edit={KerusakanEdit}
      options={{
        label: 'Kerusakan',
      }}
      recordRepresentation="kode"
    />
    <Resource
      name="rule"
      list={RuleList}
      show={RuleShow}
      create={RuleCreate}
      edit={RuleEdit}
      options={{
        label: 'Rule',
      }}
      recordRepresentation="kode"
    />
    <Resource
      name="diagnosa"
      list={DiagnosaList}
      show={DiagnosaShow}
      options={{
        label: 'Diagnosa',
      }}
    />
    <Resource
      name="pelanggan"
      list={PelangganList}
      show={PelangganShow}
      options={{
        label: 'Laporan Pelanggan',
      }}
      recordRepresentation="nama"
    />
    <Resource
      name="konsultasi"
      list={KonsultasiList}
      show={KonsultasiShow}
      options={{
        label: 'Laporan Konsultasi',
      }}
    />
  </RaAdmin>
)

export default Admin
