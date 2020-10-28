import { Component } from 'react';
import GridFactory from './Factory/GridFactory';

class WordsGrids extends Component {

    constructor(props) {
        super(props);
    }

    columns = [
        {
            caption: "ID",
            dataField: "id",
            dataType: "number"
        },
        {
            caption: "Word",
            dataField: "word",
            dataType: "string"
        },
        {
            caption: "Count",
            dataField: "count",
            dataType: "number"
        },
        {
            caption: "Stars",
            dataField: "stars",
            cellTemplate: function (c, o) {
                if (o.value > 0) {
                    for (let i = 0; i < parseInt(o.value); i++) {
                        c.innerHTML += "&#x2605";
                    }
                } else {
                    c.innerHTML = "&mdash;";
                }
            }
        }
    ]

    render() {
        return new GridFactory().make(this.columns, this.props.dataSource);
    }
}

export default WordsGrids;