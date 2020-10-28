import axios from 'axios';

export default class WordsRequest {
    send(userId, callback) {
        axios.get("http://localhost:4500/words").then(result => {
            callback(null, result.data);
        });
    }
}