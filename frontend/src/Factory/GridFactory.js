import { DataGrid } from 'devextreme-react';

export default class GridFactory {
    make(columns = [], dataSource = []) {
        return (<DataGrid
            columns={columns}
            dataSource={dataSource}
        />);
    }
}