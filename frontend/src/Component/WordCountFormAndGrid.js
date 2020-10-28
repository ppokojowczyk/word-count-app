import { Component } from 'react';
import CountForm from '../CountForm.js';
import WordsGrid from '../WordsGrid.js';
import WordsRequest from '../Request/WordsRequest.js';

class WordCountFormAndGrid extends Component {

    constructor(props) {
        super(props);
        this.state = {
            dataSource: []
        };
        this.countFormSubmitCallback = this.countFormSubmitCallback.bind(this);
        this.wordsRequest = new WordsRequest();
        this.fetch();
    }

    fetch() {
        this.wordsRequest.send(1, (error, data) => {
            this.setState({ dataSource: data.words });
        });
    }

    countFormSubmitCallback(error, result) {
        if (!error) {
            this.fetch();
        }
    }

    render() {
        return (
            <div>
                <CountForm submitCallback={this.countFormSubmitCallback} />
                <WordsGrid dataSource={this.state.dataSource} />
            </div>
        )
    }
}

export default WordCountFormAndGrid;