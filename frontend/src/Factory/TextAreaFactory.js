import { TextArea } from 'devextreme-react';

export default class TextAreaFactory {
    make(onValueChanged, value = null, placeholder = '') {
        return (<TextArea
            className="mb10"
            height="100px"
            value={value}
            placeholder={placeholder}
            onValueChanged={onValueChanged}
        />);
    }
}
