import {
  Admin as RaAdmin,
  Resource,
} from 'react-admin'

import dataProvider from './lib/dataProvider'
import { GejalaList, GejalaShow } from './resources/Gejala'
import { KerusakanList, KerusakanShow } from './resources/Kerusakan'
import { SolusiKerusakanList, SolusiKerusakanShow } from './resources/SolusiKerusakan'
import { RuleList, RuleShow } from './resources/Rule'
import { PelangganList, PelangganShow } from './resources/Pelanggan'
import { KonsultasiList, KonsultasiShow } from './resources/Konsultasi'
import { GejalaKonsultasiList, GejalaKonsultasiShow } from './resources/GejalaKonsultasi'

const Admin = () => (
  <RaAdmin
    basename="/admin"
    dataProvider={dataProvider}
  >
    <Resource
      name="gejala"
      list={GejalaList}
      show={GejalaShow}
      recordRepresentation="kode"
    />
    <Resource
      name="kerusakan"
      list={KerusakanList}
      show={KerusakanShow}
      recordRepresentation="kode"
    />
    <Resource
      name="solusi-kerusakan"
      list={SolusiKerusakanList}
      show={SolusiKerusakanShow}
      recordRepresentation="deskripsi"
    />
    <Resource
      name="rule"
      list={RuleList}
      show={RuleShow}
      recordRepresentation="kode"
    />
    <Resource
      name="pelanggan"
      list={PelangganList}
      show={PelangganShow}
      recordRepresentation="nama"
    />
    <Resource
      name="konsultasi"
      list={KonsultasiList}
      show={KonsultasiShow}
      recordRepresentation="deskripsi"
    />
    <Resource
      name="gejala-konsultasi"
      list={GejalaKonsultasiList}
      show={GejalaKonsultasiShow}
    />
  </RaAdmin>
)

export default Admin
