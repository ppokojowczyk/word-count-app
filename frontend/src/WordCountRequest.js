import axios from 'axios';

export default class WordCountRequest {
    send(content, callback) {
        axios.post("http://localhost:4500/count", {
            content: content
        }).then(result => {
            callback(null, result);
        });
    }
}