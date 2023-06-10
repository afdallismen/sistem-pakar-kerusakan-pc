import {
  Document,
  Page,
  View,
  Text,
  StyleSheet,
} from '@react-pdf/renderer'
import PropTypes from 'prop-types'

import './print.css'

const styles = StyleSheet.create({
  page: {
    display: 'block',
    fontSize: 12,
    fontFamily: 'Times-Roman',
    paddingVertical: 16,
    paddingHorizontal: 40,
  },
  row: {
    flexDirection: 'row',
  },
  text: {
    display: 'block',
  },
})

const PrintDiagnosa = ({ konsultasi, diagnosa, kerusakan, rules }) => {
  return (
    <Document>
      <Page
        size="A4"
        style={styles.page}
      >
        <View style={{ textAlign: 'center', display: 'block', marginBottom: 40 }}>
          <Text style={{ display: 'block', fontFamily: 'Times-Bold', fontSize: 22 }}>DIAGNOSA KERUSAKAN PC</Text>
        </View>
        <View style={{ marginBottom: 32, display: 'flex', flexDirection: 'column' }}>
          <Text style={{ marginBottom: 4, fontFamily: 'Times-Bold', fontWeight: 800, borderBottom: '2px solid #AEAEAE' }}>PELANGGAN</Text>
          <View style={{ display: 'flex', flexDirection: 'row', gap: 4 }}>
            <View style={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
              <Text>Nama</Text>
              <Text>No.Hp</Text>
              <Text>Alamat</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
              <Text>:</Text>
              <Text>:</Text>
              <Text>:</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'column', gap: 2, flex: 1 }}>
              <Text>{konsultasi?.pelanggan.nama}</Text>
              <Text>{konsultasi?.pelanggan.nohp}</Text>
              <Text style={{ textAlign: 'justify' }}>{konsultasi?.pelanggan.alamat}</Text>
            </View>
          </View>
        </View>
        <View style={{ marginBottom: 32, display: 'flex', flexDirection: 'column' }}>
          <Text style={{ marginBottom: 4, fontFamily: 'Times-Bold', fontWeight: 800, borderBottom: '2px solid #AEAEAE' }}>KONSULTASI</Text>
          <View style={{ display: 'flex', flexDirection: 'row', gap: 4, marginBottom: 4 }}>
            <Text style={{ width: 64 }}>Tanggal</Text>
            <Text>:</Text>
            <Text style={{ textAlign: 'justify', flex: 1 }}>{konsultasi && new Intl.DateTimeFormat('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }).format(new Date(konsultasi?.created_at))}</Text>
          </View>
          <View style={{ display: 'flex', flexDirection: 'row', gap: 4, marginBottom: 4 }}>
            <Text>Deskripsi PC</Text>
            <Text>:</Text>
            <Text style={{ textAlign: 'justify', flex: 1 }}>{konsultasi?.deskripsi}</Text>
          </View>
          <View style={{ display: 'flex', flexDirection: 'row', gap: 4 }}>
            <Text style={{ width: 64 }}>Gejala</Text>
            <Text>:</Text>
            <View style={{ display: 'flex', flexDirection: 'column' }}>
              {konsultasi?.gejalas.map(({ id, kode, nama }, i) => (
                <Text
                  key={`gejala-${id}`}
                >
                  {`${i+1}. ${kode} / ${nama}`}
                </Text>
              ))}
            </View>
          </View>
        </View>
        <View style={{ marginBottom: 32, display: 'flex', flexDirection: 'column' }}>
          <Text style={{ marginBottom: 4, fontFamily: 'Times-Bold', fontWeight: 800, borderBottom: '2px solid #AEAEAE' }}>DIAGNOSA</Text>
          <View style={{ display: 'flex', flexDirection: 'row', gap: 4 }}>
            <View style={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
              <Text>Kerusakan</Text>
              <Text>Gejala yang diukur</Text>
              <Text>Kepastian Diagnosa</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
              <Text>:</Text>
              <Text>:</Text>
              <Text>:</Text>
            </View>
            <View style={{ display: 'flex', flexDirection: 'column', gap: 2 }}>
              <Text>{kerusakan?.nama}</Text>
              <Text>{rules.map(({ gejala_id }) => konsultasi?.gejalas.find(({ id }) => id === gejala_id).kode).join(', ')}</Text>
              <Text>{diagnosa?.cf * 100} %</Text>
            </View>
          </View>
        </View>
        <View style={{ marginBottom: 32, display: 'flex', flexDirection: 'column' }}>
          <Text style={{ marginBottom: 4, fontFamily: 'Times-Bold', fontWeight: 800, borderBottom: '2px solid #AEAEAE' }}>SOLUSI</Text>
          <Text style={{ textAlign: 'justify' }}>{kerusakan?.solusi.replace(/(<([^>]+)>)/gi, "")}</Text>
        </View>
        <View style={{ display: 'flex', flexDirection: 'row', justifyContent: 'flex-end' }}>
          <View style={{ display: 'flex', flexDirection: 'column', gap: 50 }}>
            <Text>Padang, {new Intl.DateTimeFormat('id-ID', { year: 'numeric', month: 'long', day: 'numeric' }).format(new Date())}</Text>
            <Text>{konsultasi?.pelanggan.nama}</Text>
          </View>
        </View>
      </Page>
    </Document>
  )
}

PrintDiagnosa.propTypes = {
  konsultasi: PropTypes.any,
  diagnosa: PropTypes.any,
  kerusakan: PropTypes.any,
  rules: PropTypes.any
}

export default PrintDiagnosa
