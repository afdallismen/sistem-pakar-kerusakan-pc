import { Menu as RaMenu } from 'react-admin';

const Menu = () => (
    <RaMenu>
        <RaMenu.ResourceItem name="gejala" />
        <RaMenu.ResourceItem name="kerusakan" />
        <RaMenu.ResourceItem name="rule" />
        <RaMenu.ResourceItem name="diagnosa" />
        <RaMenu.ResourceItem name="pelanggan" />
        <RaMenu.ResourceItem name="konsultasi" />
    </RaMenu>
)

export default Menu
