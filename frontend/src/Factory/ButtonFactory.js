import { Button } from 'devextreme-react';

export default class ButtonFactory {
    make(text = null, type = null, onClick = null, icon = null) {
        return (<Button
            type={type}
            text={text}
            icon={icon}
            onClick={onClick}
        />);
    }
}