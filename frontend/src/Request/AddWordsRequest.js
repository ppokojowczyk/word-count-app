import axios from 'axios';

export default class AddWordsRequest {
    send(content, callback) {
        axios.post("http://localhost:4500/add", {
            content: content
        }).then(result => {
            callback(null, result);
        });
    }
}