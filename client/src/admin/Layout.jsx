import { Layout as RaLayout } from 'react-admin'

import Menu from './Menu'

const Layout = props => <RaLayout {...props} menu={Menu} />;

export default Layout
