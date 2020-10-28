import React, { Component } from 'react';
import ButtonFactory from './Factory/ButtonFactory';
import TextAreaFactory from './Factory/TextAreaFactory';
import AddWordsRequest from './Request/AddWordsRequest';

class CountForm extends Component {

    constructor(props) {
        super(props);
        this.ButtonFactory = new ButtonFactory();
        this.TextAreaFactory = new TextAreaFactory();
        this.AddWordsRequest = new AddWordsRequest();
        this.state = {
            text: "",
            response: ""
        };
        this.submit = this.submit.bind(this);
        this.onTextAreaChange = this.onTextAreaChange.bind(this);
        this.test = this.test.bind(this);
        this.submitCallback = props.submitCallback;
    }

    submit() {
        this.AddWordsRequest.send(this.state.text, (error, result) => {
            this.setState({ response: JSON.stringify(result, null, 4) });
            this.submitCallback(error, result);
        });
    }

    onTextAreaChange(e) {
        this.setState({ text: e.value });
    }

    test() {
        let string = "Hello World!\nHello, All!\nhello europe world!";
        this.setState({ text: string });
        this.submit();
    }

    render() {
        return (
            <div>
                <div>
                    {this.TextAreaFactory.make(this.onTextAreaChange, this.state.text, "Type text...")}
                    {this.ButtonFactory.make("Submit", "success", this.submit, "save")}
                    {/* {this.ButtonFactory.make("Test", "default", this.test, "warning")} */}
                </div>
            </div>
        )
    }

}

export default CountForm;