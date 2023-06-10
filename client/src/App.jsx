import {
  BrowserRouter,
  Routes,
  Route,
} from 'react-router-dom'
import { useEffect } from 'react'

import Front from './front'
import Admin from './admin'
import Konsultasi from './front/Konsultasi'
import Registrasi from './front/Registrasi'
import Home from './front/Home'
import Profil from './front/Profil'
import TambahKonsultasi from './front/TambahKonsultasi'
import DetailDiagnosa from './front/DetailDiagnosa'
import { instance as axios } from './admin/lib/axios'
import PrintDiagnosa from './front/PrintDiagnosa'


const App = () => {
  useEffect(() => {
    const fetchCSRF = async () => {
      await axios.get('/sanctum/csrf-cookie')
    }

    fetchCSRF()
  }, [])

  return (
    <BrowserRouter>
      <Routes>
        <Route path="/konsultasi/:konsultasi_id/diagnosa/:diagnosa_id/print" element={<PrintDiagnosa />} />
        <Route exact path="/" element={<Front />}>
          <Route index element={<Home />} />
          <Route path="konsultasi" element={<Konsultasi />} />
          <Route path="konsultasi/:konsultasi_id/diagnosa/:diagnosa_id" element={<DetailDiagnosa />} />
          <Route path="tambah-konsultasi" element={<TambahKonsultasi />} />
          <Route path="registrasi" element={<Registrasi />} />
          <Route path="profil" element={<Profil />} />
        </Route>
        <Route path="/admin/*" element={<Admin />} />
      </Routes>
    </BrowserRouter>
  )
}

export default App
